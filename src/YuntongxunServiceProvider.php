<?php

namespace Sjzlai\Yuntongxun;

use Illuminate\Support\ServiceProvider;

class YuntongxunServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true; // 延迟加载服务
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([__DIR__ . '/../config/yuntongxun.php' =>config_path('yuntongxun.php')]);
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('yuntongxun', function ($app) {
            return new Yuntongxun($app['config']);
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['yuntongxun'];
    }
}
