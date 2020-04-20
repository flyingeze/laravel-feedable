<?php
declare(strict_types=1);

namespace FlyingEze\LaravelFeed\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Feedable
{
    public function feeds(): MorphMany;

    public function primaryId(): string;
}
