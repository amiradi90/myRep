<?php

namespace App\Providers;

use App\Grids\ProductsGrid;
use App\Grids\ProductsGridInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Grids\UsersGrid;
use App\Grids\UsersGridInterface;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    public function register()
    {
        $this->app->bind(UsersGridInterface::class, UsersGrid::class);
        $this->app->bind(ProductsGridInterface::class, ProductsGrid::class);
//        dd('a');
    }

}
