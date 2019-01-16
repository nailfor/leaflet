<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

class Marker extends geoObject
{
    /**
     * Size of the icon
     * @var array [x, y]
     */
    protected $iconSize;
    
    /**
     * Size of the shadow
     * @var array [x, y]
     */
    protected $shadowSize;
    
    /**
     * Point of the icon which will correspond to marker's location
     * @var array [x, y]
     */
    protected $iconAnchor;
    
    /**
     * The same for the shadow
     * @var array [x, y]
     */
    protected $shadowAnchor;

    /**
     * Point from which the popup should open relative to the iconAnchor
     * @var array [x, y]
     */
    protected $popupAnchor;
    
    protected $ajax;
    protected $ajaxDelay;
    
    protected $iconName;
    protected $icon;
    protected $shadow;

    /**
     * {@inheritdoc}
     */
    protected function getMethod() : string
    {
        return 'marker';
    }

    /**
     * {@inheritdoc}
     */
    protected function setDefault() : void
    {
        $this->iconSize     = config('leaflet.marker.iconSize', [38, 40]);
        $this->shadowSize   = config('leaflet.marker.shadowSize', [50, 24]);
        $this->iconAnchor   = config('leaflet.marker.iconAnchor', [22, 39]);
        $this->shadowAnchor = config('leaflet.marker.shadowAnchor', [4, 22]);
        $this->popupAnchor  = config('leaflet.marker.popupAnchor', [0, 0]);
        $this->var          = 'marker';
        $this->ajaxDelay    = 30;
    }

    /**
     * {@inheritdoc}
     */
    protected function afterConstruct() : void
    {
        $this->jsonize([
            'iconSize', 
            'shadowSize',
            'iconAnchor',
            'shadowAnchor',
            'popupAnchor',
        ]);
        parent::afterConstruct();
    }
    
    /**
     * {@inheritdoc}
     */
    protected function beforeJs() : string
    {
        if ($this->icon) {
            return <<<EOF
var $this->iconName = L.icon({
    iconUrl: '$this->icon',
    shadowUrl: '$this->shadow',

    iconSize:     $this->iconSize,
    shadowSize:   $this->shadowSize,
    iconAnchor:   $this->iconAnchor,
    shadowAnchor: $this->shadowAnchor,
    popupAnchor:  $this->popupAnchor
});
EOF;
        }
    }

    protected function afterJs() : string
    {
        if ($this->ajax) {
            return <<<EOF
setInterval(function()
    {
        jQuery.ajax({url: "$this->ajax",
            dataType: 'json',
            success: function(coord){
                $this->var.setLatLng(coord);
            }
        });
    },
    $this->ajaxDelay*1000);
EOF;
        }
        return '';
    }    

    
    /**
     * {@inheritdoc}
     */
    protected function getOptions() : string
    {
        if ($this->icon) {
            return "'icon': $this->iconName";
        }
    }
}