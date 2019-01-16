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
     * Dynamically get an attribute
     *
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
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