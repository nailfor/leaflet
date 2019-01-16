LeafLet Extension for Laravel
==========================

Leaflet plugin for Laravel freamwork

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require nailfor/leaflet
```
or add

```json
"nailfor/leaflet" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

Publish js classes

```
php artisan vendor:publish --provider="nailfor\leaflet\Providers\MapServiceProvider"
```

```

use nailfor\leaflet\Leaflet;
use nailfor\leaflet\Circle;
use nailfor\leaflet\Marker;
use nailfor\leaflet\Polygon;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersGridInterface $usersGrid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $marker = new Marker([
            'coord'     => ['55.75222', '37.61556'],
            'iconName'  => 'checkIcon',
            'icon'      => 'icon/leaf-green.png',
            'shadow'    => 'icon/leaf-shadow.png',
            'popup'     => 'Москва',
            'ajax'      => '/map/ajax',     //for dynamic updadate coordinates
            'ajaxDelay' => 1,               //delay call /map/ajax in seconds
        ]);
        
        $circle = new Circle([
            'coord'     => ['55.75222', '37.61556'],
            'radius'    => 500
            //'popup' => 'cirle',
        ]);
        
        $polygon = new Polygon([
            'coord'    => [
                 ['55.75222', '37.61556'],
                 ['55.75222', '37.62556'],
                 ['55.76222', '37.62556']
            ]
            //'color' => 'yellow',
            //'popup' => 'triangle',
        ]);
        
        $map = new Leaflet([
            'objects' => [
                $marker,
                $circle,
                $polygon,
            ]
        ]);
        return $map->render();
    }
    
    /**
    * route for /map/ajax
    * return random coords
    */
    public function ajax() {
        $dx = rand();
        $dy = rand();
        $x  = floatval("55.7$dx");
        $y  = floatval("37.7$dy");
        $res = [$x, $y];
        return json_encode($res);
    }    
}

```


Credits
-------

- [nailfor](https://github.com/nailfor)

License
-------

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.
