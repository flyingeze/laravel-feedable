<?php
declare(strict_types=1);

namespace FlyingEze\LaravelFeedable;

use FlyingEze\LaravelFeedable\Contracts\Feedable;
use FlyingEze\LaravelFeedable\Models\Feed;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanComment
{
    public function feed(Feedable $feedable, string $feedText = ''): Feed
    {
        $feedModel = config('feed.model');

        $feed = new $feedModel([
            'body'        => $feedText,
            'feeded_id'   => $this->primaryId(),
            'feeded_type' => get_class(),
        ]);

        $feedable->feeds()->save($feed);

        return $feed;
    }

    public function feeds(): MorphMany
    {
        return $this->morphMany(config('feed.model'), 'feeded');
    }

    public function hasFeedsOn(Feedable $feedable): bool
    {
        return $this->feeds()
            ->where([
                'feedable_id'   => $feedable->primaryId(),
                'feedable_type' => get_class($feedable),
            ])
            ->exists();
    }

    private function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }
}
