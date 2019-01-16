<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

abstract class geoObject extends baseModel
{
    use Popup;

    /**
     * Name js variable
     * 
     * @var string
     */
    protected $mapVar;
    
    
    /**
     * Name js variable
     * 
     * @var string
     */
    protected $var;
    
    protected $coord;
    
    
    /**
     * Set default variables
     * 
     * @return void
     */
    protected function setDefault() : void
    {
    }

    /**
     * Configure model after construct
     * 
     * @return void
     */
    protected function afterConstruct() : void
    {
        $this->jsonize([
            'coord',
        ]);
    }
    
    /**
     * Convert array to json
     * 
     * @param array $vars Array with text variables to jsonize
     * @return void
     */
    protected function jsonize(array $vars) : void
    {
        foreach($vars as $var){
            $this->$var = json_encode($this->$var);
        }
    }
    
    /**
     * Create the Marker
     *
     * @param array $params
     * @return this
     */
    public function __construct(array $params = [])
    {
        //default settings
        $this->mapVar       = config('leaflet.map.var');
        $this->setDefault();

        foreach ($params as $k => $v) {
            $this->__set($k, $v);
        }
        $this->afterConstruct();
        
        return $this;
    }
    
    abstract protected function getMethod() : string;
    abstract protected function getOptions() : string;

    protected function beforeJs() : string
    {
        return '';
    }    
    
    protected function afterJs() : string
    {
        return '';
    }    
    
    /**
     * Create js for object
     *
     * @return string
     */    
    public function getJs() : string
    {
        $method     = $this->getMethod();
        $options    = $this->getOptions();
        $before     = $this->beforeJs();
        $after      = $this->afterJs();
        $popup      = $this->getPopup($this->var);
        
        $js = <<<EOF
<script type='text/javascript'>
    $before
    var $this->var = L.$method($this->coord, { $options }).addTo($this->mapVar);
    $popup
    $after
</script>
EOF;
        return $js;
    }

}