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
        return 'v-polygon';
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions() : array
    {
        return [
            ':lat-lngs' => $this->coord,
            'color'    => $this->color,
        ];
        
    }

    /**
     * {@inheritdoc}
     */
    protected function afterConstruct() : void
    {
        if (is_a($this->coord, 'Grimzy\LaravelMysqlSpatial\Types\Polygon')) {
            $geoms = $this->coord->getGeometries();

            $coords = [];
            foreach($geoms as $geo) {
                $points = $geo->getPoints();
                foreach ($points as $point) {
                    $coords[] = [
                        $point->getLat(),
                        $point->getLng(),
                    ];
                }

            }
            $this->coord = $coords;
        }
        
        parent::afterConstruct();
    }
    
    /**
     * {@inheritdoc}
     */
    protected function setDefault() : void
    {
        $this->color        = 'blue';
    }
    
}