<?php

declare(strict_types=1);

namespace TypiCMS\Modules\News\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Override;
use TypiCMS\Modules\News\Composers\SidebarViewComposer;

class ModuleServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/news.php', 'typicms.modules.news');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/news.php');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_news_table.php.stub' => getMigrationFileName(
                'create_news_table',
            ),
        ], 'typicms-migrations');
        $this->publishes([
            __DIR__.'/../../resources/views/admin/news' => resource_path('views/admin/news'),
        ], ['typicms-views', 'typicms-admin-views', 'typicms-admin-news-views']);
        $this->publishes([
            __DIR__.'/../../resources/views/public/news' => resource_path('views/public/news'),
        ], ['typicms-views', 'typicms-public-views', 'typicms-public-news-views']);
        $this->publishes([__DIR__.'/../../resources/scss' => resource_path('scss')], 'typicms-resources');

        View::composer('admin::core._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('public::news.*', function ($view): void {
            $view->page = getPageLinkedToModule('news');
        });
    }
}
