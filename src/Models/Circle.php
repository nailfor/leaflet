<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

class Circle extends geoObject
{
    protected $radius;
    protected $color;
    
    /**
     * {@inheritdoc}
     */
    protected function getMethod() : string
    {
        return 'circle';
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions() : string
    {
        return "radius: $this->radius, color: $this->color";
        
    }
    
    protected function setDefault() : void
    {
        $this->var          = 'circle';
        $this->color        = '"red"';
    }
    
}