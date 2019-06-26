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
     * @return array options
     */
    abstract protected function getOptions() : array;

    /**
     * Set options
     * @param type $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
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
     * Return key='val' pairs
     * @param type $array
     * @return string
     */
    protected function getKeyVal($array) : string
    {
        $res = '';
        foreach($array as $key=>$val) {
            $res.= "$key='$val' ";
        }
        return $res;
    }
    
    
    /**
     * Create js for object
     *
     * @return string
     */    
    public function getJs() : string
    {
        $method     = $this->getMethod();
        $options    = $this->getKeyVal(array_merge($this->getOptions(), $this->options));
        $before     = $this->beforeJs();
        $after      = $this->afterJs();
        $popup      = $this->getPopup();
        $inner      = $this->getInner($this->inner);
        
        $result = <<<EOF
$before
<$method $options>
    $inner
    $popup
</$method>
$after
EOF;
        return $result;
    }

}