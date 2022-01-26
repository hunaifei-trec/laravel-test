<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\CouponRepository;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use App\Repositories\CouponProductRepository;
use App\Repositories\Interfaces\CouponProductRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            CouponRepositoryInterface::class,
            CouponRepository::class
        );
        $this->app->bind(
            CouponProductRepositoryInterface::class,
            CouponProductRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
