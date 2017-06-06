<?php

namespace Sandbox\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Sandbox\Events\Widget\WidgetWasAdded;
use Sandbox\Events\Widget\WidgetWasDeleted;
use Sandbox\Events\Widget\WidgetWasEdited;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        WidgetWasAdded::class => [

        ],

        WidgetWasEdited::class => [

        ],

        WidgetWasDeleted::class => [

        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */

    public function boot()
    {
        parent::boot();

        //
    }
}
