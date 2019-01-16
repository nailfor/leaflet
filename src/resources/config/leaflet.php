<?php
/**
 * Copyright (c) 2018.
 * @author nailfor
 */

/**
 * Config file for the map
 */
return [
    'height'    => 500,
    'view'      => 'map',
    'basedir'   => '/vendor/leaflet/',
    
    'center'    => [
        'lat'   => '55.75222',
        'lon'   => '37.61556',
    ],
    
    'map'       => [
        'id'    => 'map',
        'var'   => 'lmap',
    ],
    
    //disable zoom, because his added by L.control.zoom() js script and options from next sections
    'options'   => [
        'zoomControl' => false,
    ],
    
    //localization zoom + and -
    'zoom'      => [
        'zoomInTitle'   => 'Приблизить',
        'zoomOutTitle'  => 'Отдалить',
        'position'      => 'topleft',
    ],
    
    //URL to tile server
    'tileserver'=> 'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',

];