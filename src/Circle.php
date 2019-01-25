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
        return 'v-circle';
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions() : string
    {
        return ":lat-lng=$this->coord :radius=$this->radius :color='\"$this->color\"'";
    }
    
    /**
     * {@inheritdoc}
     */
    protected function setDefault() : void
    {
        $this->color    = 'red';
    }
 
    
}