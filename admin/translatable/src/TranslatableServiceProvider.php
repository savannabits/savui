<?php

namespace Savannabits\Translatable;

use Savannabits\Translatable\Facades\Translatable;
use Savannabits\Translatable\Providers\TranslatableProvider;
use Savannabits\Translatable\Providers\ViewComposerProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TranslatableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../install-stubs/config/translatable.php' => config_path('translatable.php'),
            ], 'config');
        }

        $this->app->register(ViewComposerProvider::class);
        $this->app->register(TranslatableProvider::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../install-stubs/config/translatable.php',
            'translatable'
        );

        $loader = AliasLoader::getInstance();
        $loader->alias('Translatable', Translatable::class);
    }
}
