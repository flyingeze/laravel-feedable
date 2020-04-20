<?php
declare(strict_types=1);

namespace FlyingEze\LaravelFeedable;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * @property Collection $comments
 */
trait HasFeeds
{
    public function feeds(): MorphMany
    {
        return $this->morphMany(config('feed.model'), 'feedable');
    }

    public function primaryId(): string
    {
        return (string)$this->getAttribute($this->primaryKey);
    }

    public function totalFeedsCount(): int
    {
        return $this->feeds()->count();
    }
}
