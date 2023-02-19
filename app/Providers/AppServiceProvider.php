<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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
        Inertia::share([
            'errors' => function () {
                // logger('errors : ');
                // logger(Session::get('errors') ? Session::get('errors')->getBag('default')->getMessage(): (object) []);
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessage()
                    : (object) [];
            },
        ]);
        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
            ];
        });
        Inertia::share([
            'urlPrev'    => function () {
                if (url()->previous() !== route('login') && url()->previous() !== '' && url()->previous() !== url()->current()) {
                    return url()->previous();
                } else {
                    return 'empty'; // used in javascript to disable back button behavior
                }
            },
        ]);
    }
}
