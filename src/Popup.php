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
     * @return string|void
     */
    protected function getPopup() : string
    {
        if ($this->popup){
            return "<v-popup>$this->popup</v-popup>";
        }
        
        return '';
    }
    
}