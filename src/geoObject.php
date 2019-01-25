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
     * Coordinate of object
     * 
     * @var array
     */
    protected $coord;
    
    
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
     * Return method name Leaflet L.{method}()
     * @return string name
     */
    abstract protected function getMethod() : string;
    
    /**
     * Return options of Leaflet L.xxxx([], {options})
     * @return string options
     */
    abstract protected function getOptions() : string;

    /**
     * Called before Object is created
     * 
     * @return string Applied JS 
     */
    protected function beforeJs() : string
    {
        return '';
    }    
    
    /**
     * Called after Object is created
     * 
     * @return string Applied JS 
     */
    protected function afterJs() : string
    {
        return '';
    }

    /**
     * Insert inner code
     * 
     * @return string Code for inner section
     */
    protected function getInner() : string
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
        $popup      = $this->getPopup();
        $inner      = $this->getInner();
        
        $result = <<<EOF
$before
<$method $options>
    $inner $popup
</$method>
$after
EOF;
        return $result;
    }

}