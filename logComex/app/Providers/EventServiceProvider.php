<?php

namespace App\Providers;

use App\Entities\Product;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        $this->afterCreatedModels();
    }

    /**
     * afterCreatedModels
     */
    private function afterCreatedModels()
    {
        Product::created(function () {
            Cache::store('redis')->tags('products')->flush();
        });
        Product::updated(function () {
            Cache::store('redis')->tags('products')->flush();
        });
        Product::deleted(function () {
            Cache::store('redis')->tags('products')->flush();
        });

    }
    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
