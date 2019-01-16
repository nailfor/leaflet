<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

class Polygon extends geoObject
{
    protected $color;
    
    /**
     * {@inheritdoc}
     */
    protected function getMethod() : string
    {
        return 'polygon';
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions() : string
    {
        return "color: '$this->color'";
        
    }
    
    protected function setDefault() : void
    {
        $this->var          = 'polygon';
        $this->color        = 'blue';
    }
    
}