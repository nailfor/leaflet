<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

use Illuminate\Contracts\Support\Htmlable;

class Leaflet extends baseModel implements Htmlable{
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
     * Create the Map
     *
     * @param array $params
     * @return Map
     * @throws \Exception
     */
    public function __construct(array $params = [])
    {
        //default settings
        $this->view     = config('leaflet.view', 'map');
        $this->baseDir  = config('leaflet.basedir','/vendor/leaflet/'); 

        //Must be set in config file
        $this->height    = config('leaflet.height');
        $this->mapId    = config('leaflet.map.id');
        $this->mapVar   = config('leaflet.map.var');
        $this->Lat      = config('leaflet.center.lat');
        $this->Lon      = config('leaflet.center.lon');
        $this->options  = config('leaflet.options');
        $this->zoom     = config('leaflet.zoom');
        $this->tileServer = config('leaflet.tileserver');

        foreach ($params as $k => $v) {
            $this->__set($k, $v);
        }
        $this->options  = json_encode($this->options);
        $this->zoom     = json_encode($this->zoom);

        return $this;
    }    
    
    /**
     * Render the map as HTML on the user defined view
     *
     * @return string
     * @throws \Throwable
     */
    public function render()
    {
        $js[] = "<script src='$this->baseDir/leaflet.js' type='text/javascript'></script>";
        $js[] = <<<EOF
<script type='text/javascript'>
    var $this->mapVar = L.map('$this->mapId', $this->options).setView([$this->Lat,$this->Lon], 13);
    L.control.zoom($this->zoom).addTo($this->mapVar);
    L.tileLayer('$this->tileServer', {}).addTo($this->mapVar);

   
</script>script
EOF;

        $js[] = "<link rel='stylesheet' href='$this->baseDir/leaflet.css' />";
        
        if (is_array($this->objects)) {
            foreach($this->objects as $object) {
                $js[] = $object->getJs();
            }
        }
        

        $head = implode("\n", $js);
        
        return view($this->view, 
            [$this->mapId =>
                [
                    'head' => $head,
                    'html'  => "<div id='$this->mapId' style='height: {$this->height}px; width: {$this->height}px;'></div>",
                ]
            ]
        )->render();
    }
}