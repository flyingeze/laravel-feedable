<?php
declare(strict_types=1);

namespace Flyingeze\LaravelFeedable;

use Illuminate\Support\ServiceProvider;

class LaravelFeedableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $configFile = __DIR__ . '/../config/feed.php';

        $this->publishes([
            $configFile => config_path('feed.php'),
        ], 'config');

        $this->mergeConfigFrom($configFile, 'feed');

        if (!class_exists('CreateFeedsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/database/migrations/create_feeds_table.php.stub' =>
                    database_path("migrations/{$timestamp}_create_feeds_table.php")
            ], 'migrations');
        }
    }
}
