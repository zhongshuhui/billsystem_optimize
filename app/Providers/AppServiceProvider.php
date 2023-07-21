<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
     * 注册应用程序服务。
     * @return void
     */
    public function boot()
    {
//        RateLimiter::for('backups', function ($job) {
//            /* return $job->user->vipCustomer()
//                 ? Limit::none()
//                 : Limit::perHour(1)->by($job->user->id);*/
//        });
    }
}
