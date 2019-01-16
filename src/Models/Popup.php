<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

trait Popup
{
    protected $popup;
    
    /**
     * Create js for popup
     * 
     * @param string $var JS name of variable
     * @return string|void
     */
    protected function getPopup(string $var) : string
    {
        if ($this->popup){
            return "$var.bindPopup('$this->popup');";
        }
        
        return '';
    }
    
}