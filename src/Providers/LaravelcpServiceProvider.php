<?php

namespace Askedio\Laravelcp\Module\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

use Askedio\Laravelcp\Helpers\NavigationHelper;
use Askedio\Laravelcp\Helpers\HookHelper;

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

    NavigationHelper::Add(['nav' => 'main', 'sort' => '1', 'link' => url('/module'), 'title' => 'Module', 'icon' => 'fa-cubes']);
    HookHelper::Add(['hook' => 'dashboard', 'template' => 'l5cp-module::dashboard.welcome', 'sort' => '1']);

    if (! $this->app->routesAreCached()) {
      require realpath(__DIR__.'/../Http/routes.php');
    }

    $this->loadTranslationsFrom(realpath(__DIR__.'/../Resources/Lang'), 'l5cp-module');

    $this->loadViewsFrom(realpath(__DIR__.'/../Resources/Views'), 'l5cp-module');

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