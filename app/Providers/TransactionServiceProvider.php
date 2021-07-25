<?php


namespace App\Providers;


use App\Repositories\Transaction\ITransactionRepository;
use App\Repositories\Transaction\TransactionRepository;
use Carbon\Laravel\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
    }
}
