<?php

namespace App\Providers;
use App\Models\AirlinePage;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('dashboard', function ($view) {
            $contactCount = DB::table('contact')->count();

            $view->with([
                'contactCount' => $contactCount,
            ]);
        });

        View::composer(['layouts.guest', 'layouts.airline'], function ($view) {
            try {
                $footerAirlinePages = AirlinePage::query()
                    ->where('status', true)
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get(['name', 'slug']);
            } catch (QueryException) {
                $footerAirlinePages = collect();
            }

            $view->with('footerAirlinePages', $footerAirlinePages);
        });
    }
}
