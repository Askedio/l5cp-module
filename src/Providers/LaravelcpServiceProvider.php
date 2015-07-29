<?php

namespace Askedio\Laravelcp\Module\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class LaravelcpServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {

  }

  /**
   * Register routes, translations, views and publishers.
   *
   * @return void
   */
  public function boot()
  {



    if (! $this->app->routesAreCached()) {
      require realpath(__DIR__.'/../Http/routes.php');
    }

    $this->loadTranslationsFrom(realpath(__DIR__.'/../Resources/Lang'), 'lcp');

    $this->loadViewsFrom(realpath(__DIR__.'/../Resources/Views'), 'lcp');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Views') => base_path('resources/views/vendor/askedio/laravelcp'),
    ], 'views');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Assets') => public_path('assets'),
    ], 'public');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Config') => config_path('')
    ], 'config');

    $this->publishes([
      realpath(__DIR__.'/../Database/Migrations') => database_path('migrations')
    ], 'migrations');

    $this->publishes([
      realpath(__DIR__.'/../Database/Seeds') => database_path('seeds')
    ], 'seeds');

  }
}