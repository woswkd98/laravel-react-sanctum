<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Models\User;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
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
        // 모델들 옵저버 등록
        Task::observe(TaskObserver::class);
        User::observe(UserObserver::class);
    }
}
