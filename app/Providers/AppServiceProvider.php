<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ShipperRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\SalesOrderRepository;
use App\Services\CustomerService;
use App\Services\UserService;
use App\Services\ShipperService;
use App\Services\SupplierService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\SalesOrderService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // app/Providers/AppServiceProvider.php
    public function register()
    {
        $this->app->when(CustomerService::class)
            ->needs(RepositoryInterface::class)
            ->give(CustomerRepository::class);

        $this->app->when(UserService::class)
            ->needs(RepositoryInterface::class)
            ->give(UserRepository::class);

        $this->app->when(ShipperService::class)
            ->needs(RepositoryInterface::class)
            ->give(ShipperRepository::class);

        $this->app->when(SupplierService::class)
            ->needs(RepositoryInterface::class)
            ->give(SupplierRepository::class);

        $this->app->when(ProductService::class)
            ->needs(RepositoryInterface::class)
            ->give(ProductRepository::class);

        $this->app->when(CategoryService::class)
            ->needs(RepositoryInterface::class)
            ->give(CategoryRepository::class);

        $this->app->when(OrderService::class)
            ->needs(RepositoryInterface::class)
            ->give(OrderRepository::class);

        $this->app->when(SalesOrderService::class)
            ->needs(RepositoryInterface::class)
            ->give(SalesOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
