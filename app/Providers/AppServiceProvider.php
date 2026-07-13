<?php

namespace App\Providers;
use App\Models\AirlinePage;
use App\Models\FlightRouteDestination;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
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
        Event::listen(Login::class, function (Login $event): void {
            $event->user->forceFill([
                'last_login_at' => Carbon::now(User::INDIA_TIMEZONE)->format('Y-m-d H:i:s'),
            ])->save();
        });

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

                $footerRoutes = FlightRouteDestination::query()
                    ->where('type', FlightRouteDestination::TYPE_ROUTE)
                    ->where('is_published', true)
                    ->whereNotNull('flight_category_id')
                    ->orderByDesc('created_at')
                    ->limit(6)
                    ->get(['id', 'flight_category_id', 'route_text', 'slug']);

                $footerDestinations = FlightRouteDestination::query()
                    ->where('type', FlightRouteDestination::TYPE_DESTINATION)
                    ->where('is_published', true)
                    ->whereNotNull('flight_category_id')
                    ->orderByDesc('created_at')
                    ->limit(6)
                    ->get(['id', 'flight_category_id', 'route_text', 'slug']);
            } catch (QueryException) {
                $footerAirlinePages = collect();
                $footerRoutes = collect();
                $footerDestinations = collect();
            }

            $view->with([
                'footerAirlinePages' => $footerAirlinePages,
                'footerRoutes' => $footerRoutes,
                'footerDestinations' => $footerDestinations,
            ]);
        });
    }
}
