<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

class Marker extends geoObject
{
    use Icon;
    
    /**
     * Point from which the popup should open relative to the iconAnchor
     * @var array [x, y]
     */
    protected $popupAnchor;
    
    /**
     * URL to method, that return json [lat, lon]
     * @var string URL 
     */
    protected $ajax;
    
    /**
     * Delay in seconds
     * @var int 
     */
    protected $ajaxDelay;
    
    /**
     * Set marker is draggable
     * @var bool 
     */
    protected $draggable;
    
    /**
     * {@inheritdoc}
     */
    protected function getMethod() : string
    {
        return 'v-marker';
    }

    /**
     * {@inheritdoc}
     */
    protected function getInner($array) : string
    {
        return $this->getIcon();
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getOptions() : array
    {
        $options = [
            ':lat-lng' => $this->coord,
        ];
        if ($this->draggable) {
            $options[':draggable'] = true;
        }
        
        return $options;
    }
}