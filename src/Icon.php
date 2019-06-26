<?php
/**
 * Copyright (c) 2019.
 * @author nailfor
 */

namespace nailfor\leaflet;

trait Icon
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
     * variable Name in js
     * @var string 
     */
    protected $iconName;
    
    /**
     * Path to icon
     * @var string 
     */
    protected $icon;
    
    /**
     * Path to shadow
     * @var string 
     */
    protected $shadow;

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
    protected function setDefault() : void
    {
        $this->iconSize     = config('leaflet.marker.iconSize', [38, 40]);
        $this->iconAnchor   = config('leaflet.marker.iconAnchor', [22, 39]);
        $this->shadowSize   = config('leaflet.marker.shadowSize', [50, 24]);
        $this->shadowAnchor = config('leaflet.marker.shadowAnchor', [4, 22]);
        $this->popupAnchor  = config('leaflet.marker.popupAnchor', [0, 0]);
        $this->ajaxDelay    = 30;
    }    

    /**
     * Create Icon
     * 
     * @return string Code for icon
     */
    protected function getIconOptions() : array
    {
        return [
            'icon-url'      => $this->icon,
            ':icon-size'    => $this->iconSize,
            ':icon-anchor'  => $this->iconAnchor,
            ':popup-anchor' => $this->popupAnchor,
        ];
    }


    /**
     * Create shadow Icon
     * 
     * @return string Code for shadow
     */
    protected function getShadowOptions() : array
    {
        $options = [];
        if ($this->shadow) {
            $options = [
                'shadow-url'    => $this->shadow,
                ':shadow-size'  => $this->shadowSize,
                ':shadow-anchor'=> $this->shadowAnchor,
            ];
        }
        return $options;
    }
   
    /**
     * Create ICON HTML code
     * 
     *@return string Code for HTML injection
     */
    protected function getIcon() : string
    {
        $code = '';
        if ($this->icon) {
            $options= $this->getKeyVal(array_merge(
                    $this->getIconOptions(), 
                    $this->getShadowOptions()
            ));
            $code   = "<v-icon $options></v-icon>";
        }
        return $code;
    }
    
}