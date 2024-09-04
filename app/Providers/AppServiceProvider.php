<?php

namespace App\Providers;

use App\Contracts\Dao\Todo\TodoDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\Todo\TodoServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Todo\TodoDao;
use App\Dao\User\UserDao;
use App\Services\Auth\AuthService;
use App\Services\Todo\TodoService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //User
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserDaoInterface::class, UserDao::class);

        //Todo
        $this->app->bind(TodoServiceInterface::class, TodoService::class);
        $this->app->bind(TodoDaoInterface::class, TodoDao::class);

        //Auth
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
