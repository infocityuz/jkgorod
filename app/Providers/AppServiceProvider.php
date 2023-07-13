<?php

namespace App\Providers;

use App\Models\ActionLogs;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Modules\ForTheBuilder\Entities\ActionLogs as EntitiesActionLogs;
use Illuminate\Support\Collection;
// use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate', 
                function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                    ->withPath('');
            });
        }

        // ActionLogs::whereDate( 'record_datetime', '<=', now()->subDays(30))->delete();
        // EntitiesActionLogs::whereDate( 'record_datetime', '<=', now()->subDays(30))->delete();
    }

    protected function registerCommands()
    {
        $this->commands([
            \Modules\ForTheBuilder\Console\Commands\CrudGenerator2::class
        ]);
    }






}
