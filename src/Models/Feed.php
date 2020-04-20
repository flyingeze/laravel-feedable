<?php
declare(strict_types=1);

namespace Flyingeze\LaravelFeedable\Models;

use Flyingeze\LaravelFeedable\Contracts\Feedable;
use Flyingeze\LaravelFeedable\HasFeeds;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $slug
 * @property text $body
 * @property text $link
 * @property integer $view
 * @property integer $status
 * @property string $feedable_id
 * @property string $feedable_type
 * @property Model $feedable
 * @property string $feeded_id
 * @property string $feeded_type
 * @property Model $feeded
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Feed extends Model implements Feedable
{
    use HasFeeds;

    protected $guarded = [];

    public function feedable(): MorphTo
    {
        return $this->morphTo();
    }

    public function feeded(): MorphTo
    {
        return $this->morphTo();
    }
}
