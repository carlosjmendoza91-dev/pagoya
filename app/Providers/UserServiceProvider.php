<?php


namespace App\Providers;


use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use Carbon\Laravel\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
