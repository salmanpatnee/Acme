<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        $settings = \Cache::rememberForever('settings', function () {
            return  Setting::first();
        });

        View::share('settings',  $settings);

        $notifications = User::find(1)->unreadNotifications;
        View::share('notifications',  $notifications);
    }
}
