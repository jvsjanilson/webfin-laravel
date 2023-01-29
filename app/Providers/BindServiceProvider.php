<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('App\Contracts\IEstado','App\Repositories\EstadoImpl');
        App::bind('App\Contracts\ICidade','App\Repositories\CidadeImpl');
        App::bind('App\Contracts\IConta','App\Repositories\ContaImpl');
        App::bind('App\Contracts\ICliente','App\Repositories\ClienteImpl');
        App::bind('App\Contracts\IFornecedor','App\Repositories\FornecedorImpl');
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
