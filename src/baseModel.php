<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

use InvalidArgumentException;

class baseModel
{
    /**
     * Client options of Leaflet plugin
     * 
     * @var array
     */
    protected $options = [];
    protected $inner = [];
    
    /**
     * Insert inner code
     * 
     * @return string Code for inner section
     */
    protected function getInner($array) : string
    {
        $js = [];        
        foreach($array as $item) {
            $js[] = $item->getJs();
        }
        
        return implode("\n", $js);
    }
    
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
     * Create the Model
     *
     * @param array $params
     * @return this
     */
    public function __construct(array $params = [])
    {
        //default settings
        $this->setDefault();

        foreach ($params as $k => $v) {
            $this->__set($k, $v);
        }
        $this->afterConstruct();
        
        return $this;
    }

    /**
     * Dynamically get an attribute
     *
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if (method_exists($this, 'get'.$name)) {
            $name = 'get'.$name;
            return $this->$name();
        }
        
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
        throw new InvalidArgumentException("Property " . $name . " does not exit on this class");
    }
    
    /**
     * Dynamically set an attribute
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    
}    