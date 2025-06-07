<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('cpf',function($attribute,$value,$parameters,$validator){
            return (new Cpf())->isValid($value);
        });

        //Diretiva personalizada. Retorna true caso o usuário esteja logado e o role seja 2 (ADMIN)
        Blade::if('roleadmin', function () {
            return auth()->check() && auth()->user()->role == 2;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });

    }
}