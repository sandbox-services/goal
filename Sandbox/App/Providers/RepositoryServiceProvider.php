<?php

namespace Sandbox\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(
            'Sandbox\Repositories\Widget\WidgetRepository',
            'Sandbox\Repositories\Widget\EloquentWidgetRepository'
        );

        $this->app->bind(
            'Sandbox\Repositories\User\UserRepository',
            'Sandbox\Repositories\User\EloquentUserRepository'
        );

    }

}
