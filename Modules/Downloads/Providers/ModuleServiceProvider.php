<?php

namespace TypiCMS\Modules\Downloads\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Downloads\Composers\SidebarViewComposer;
use TypiCMS\Modules\Downloads\Facades\Downloads;
use TypiCMS\Modules\Downloads\Models\Download;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.downloads');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['downloads' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'downloads');

        $this->publishes([
            __DIR__.'/../database/migrations/create_downloads_table.php.stub' => getMigrationFileName('create_downloads_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Downloads', Downloads::class);

        // Observers
        Download::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('downloads::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('downloads');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Downloads', Download::class);
    }
}
