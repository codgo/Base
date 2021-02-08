<?php

namespace TypiCMS\Modules\Cats\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Cats\Composers\SidebarViewComposer;
use TypiCMS\Modules\Cats\Facades\Cats;
use TypiCMS\Modules\Cats\Models\Cat;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.cats');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['cats' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'cats');

        $this->publishes([
            __DIR__.'/../database/migrations/create_cats_table.php.stub' => getMigrationFileName('create_cats_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Cats', Cats::class);

        // Observers
        Cat::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('cats::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('cats');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Cats', Cat::class);
    }
}
