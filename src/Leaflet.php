<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

use Illuminate\Contracts\Support\Htmlable;

class Leaflet extends baseModel implements Htmlable
{
    use htmlClass;
    
    /**
     * Latitude of start position
     *
     * @var float
     */
    protected $Lat;

    /**
     * Longitude of start position
     *
     * @var float
     */
    protected $Lon;
    
    
    /**
     * Directory of leaflet js and css files
     * Default '/vendor/leaflet/' from 'public' directory
     * 
     * @var string
     */
    protected $baseDir;
    
    /**
     * ID tag on html element
     * 
     * @var string 
     */
    protected $mapId;
    
    /**
     * Name js variable
     * 
     * @var string
     */
    protected $mapVar;
    
    /**
     * View template
     * Default map (map.blade.php file)
     * 
     * @var string 
     */
    protected $view;
    
    /**
     * Client options of Leaflet plugin
     * 
     * @var array
     */
    protected $options;
    
    /**
     * Zoom options(localizations)
     * 
     * @var array 
     */
    protected $zoom;
    
    /**
     * URL to tile server
     * 
     * @var string
     */
    protected $tileServer;
    
    /**
     * Height map in px
     * 
     * @var integer
     */
    protected $height;
    
    /**
     * Objects
     * @var array
     */
    protected $objects;

    /**
     * Plugins Leafleat
     * @var array; 
     */
    protected $plugins = [];


    /**
     * {@inheritdoc}
     */
    protected function setDefault() : void
    {
        //default settings
        $this->view     = config('leaflet.view', 'map');

        //Must be set in config file
        $this->height    = config('leaflet.height');
        $this->mapId    = config('leaflet.map.id');
        $this->Lat      = config('leaflet.center.lat');
        $this->Lon      = config('leaflet.center.lon');
        $this->options  = config('leaflet.options');
        $this->zoom     = config('leaflet.zoom');
        $this->tileServer = config('leaflet.tileserver');
    }
    
    /**
     * {@inheritdoc}
     */
    protected function afterConstruct() : void
    {
        $this->options  = json_encode($this->options);
        $this->zoom     = $this->zoom;
    }    
    
    /**
     * Call getJs for all elements of collection
     * @param array $array
     * @return string
     */
    protected function getJs(array $array) : string
    {
        $js = [];        
        foreach($array as $object) {
            $js[] = $object->getJs();
        }
        return implode("\n", $js);
        
    }
    
    /**
     * Return map objects
     * 
     * @return string
     */
    protected function getObjects() : string
    {
        if (is_array($this->objects)) {
            return $this->getJs($this->objects);
        }
        return '';
    }
    
    /**
     * Return map control
     * 
     * @return string
     */
    protected function getControl() : string
    {
        $control = '';
        if ($this->zoom) {
            $zoomIn     = $this->zoom['zoomInTitle'];
            $zoomOut    = $this->zoom['zoomOutTitle'];
            $position   = $this->zoom['position'];
            
            $control = "<v-control zoom-in-title='$zoomIn' zoom-out-title='$zoomOut' position='$position'></v-control>";
        }
        return $control;
    }
    
    /**
     * Return rendered plugin separated by \n 
     * @return string
     */
    protected function getPlugins() : string
    {
        return $this->getJs($this->plugins);
    }
    
    /**
     * Install plugin into lefleat
     * @param LeafletPlugin $plugin
     * @throws \Exception
     */
    public function installPlugin($plugin)
    {
        if (!($plugin instanceof geoObject))
        {
            throw new \Exception('Install may be instance of LeafletPlugin');
        }
        $this->plugins[] = $plugin;
    }
    
    /**
     * Render the map as HTML on the user defined view
     *
     * @return string
     * @throws \Throwable
     */
    public function render()
    {
        $control = $this->getControl();
        $objects = $this->getObjects();
        $plugins = $this->getPlugins();
        
        $body   = <<<EOF
<div style='height: {$this->height}px; '>
    <v-map :zoom=13 :center="[$this->Lat,$this->Lon]" :options='$this->options'>
        <v-tilelayer url="$this->tileServer"></v-tilelayer>
        $control
        $plugins
        $objects
    </v-map>
</div>
EOF;
//echo $body;exit;

        return view($this->view, 
            [
                $this->mapId => $body,
            ]
        )->render();
    }
}