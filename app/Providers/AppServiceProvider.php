<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;
use App\Observers\CategoriaObserver;
use App\Models\Usuario;
use App\Observers\UsuarioObserver;
use App\Models\Producto;
use App\Observers\ProductoObserver;

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
        Categoria::observe(CategoriaObserver::class);
        Usuario::observe(UsuarioObserver::class);
        Producto::observe(ProductoObserver::class);
    }
}
