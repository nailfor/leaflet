LeafLet Extension for Laravel
==========================

Leaflet plugin for Laravel freamwork

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require nailfor/laravel
```
or add

```json
"nailfor/leaflet" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

```

use nailfor\leaflet;

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
        $map = new leaflet;
        return $map->render();
    }

```

Credits
-------

- [nailfor](https://github.com/nailfor)

License
-------

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.