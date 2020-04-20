<?php
declare(strict_types=1);

namespace Flyingeze\LaravelFeedable;

use Flyingeze\LaravelFeedable\Contracts\Feedable;
use Flyingeze\LaravelFeedable\Models\Feed;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanFeed
{
    public function feed(Feedable $feedable, string $feedText = ''): Feed
    {
        $feedModel = config('feed.model');

        $feed = new $feedModel([
            'body'        => $feedText,
            'slug'        => $feedText,
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
