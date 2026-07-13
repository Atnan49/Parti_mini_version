<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share sub-events for the active year dynamically to the public layout footer
        \Illuminate\Support\Facades\View::composer('layouts.public', function ($view) {
            $year = session('active_year', config('parti.active_year', 2026));
            $subEvents = \App\Models\SubEvent::forYear($year)->published()->notDeleted()->orderBy('order')->take(4)->get();
            $view->with('footerSubEvents', $subEvents);
        });
    }
}
