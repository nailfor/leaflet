<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet\Providers;

use Illuminate\Support\ServiceProvider;

class MapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHelpers();
        $this->loadPackageConfig();
        $this->loadPackageAssets();
    }

    /**
     * Load helper function files
     *
     * @return void
     */
    protected function loadHelpers(): void
    {
        $files = glob(__DIR__ . '/../Helpers/*.php');
        foreach ($files as $file) {
            require_once($file);
        }
    }
    
    /**
     * Load package config
     *
     * @return void
     */
    protected function loadPackageConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/config/leaflet.php' => config_path('leaflet.php')
        ], 'config');
    }
    
    /**
     * Load package assets
     *
     * @return void
     */
    protected function loadPackageAssets(): void
    {
        // only publish compiled assets
        //$this->publishes([
        //    __DIR__ . '/../../../../bower-asset/leaflet/dist' => base_path('public/vendor/leaflet')
        //], 'assets');
    }    
}
