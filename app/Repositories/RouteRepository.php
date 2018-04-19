<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 19.04.2018
 * Time: 15:55
 */

namespace App\Repositories;

use App\Route;
use App\Ship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\String_;

class RouteRepository
{
    /**
     * @param array $data
     * @param Ship $ship
     * @return Route
     */
    public function add(array $data, Ship $ship) : Route
    {
        $route = new Route($data);
        $route->ship()->associate($ship);
        $route->save();

        return $route;
    }

    /**
     * @param Ship $ship
     * @return Collection
     */
    public function all(Ship $ship) : Collection
    {
        if ($ship)
        {
            $routes = $ship->routes()->get();
        } else {
            $routes = Route::all();
        }


        return $routes;
    }

    /**
     * @param $route
     */
    public function delete($route)
    {
        $route->delete();
    }

    /**
     * @param Route $route
     * @return String_
     */
    public function makeGpx(Route $route) : String_
    {
        $tracks = $route->tracks()->get();
        $gpxData = '<gpx>';
        foreach ($tracks as $track)
        {
            $gpxData = $gpxData."<wpt lat=\"{$track->latitude}\" lon=\"{$track->longitude}\"></wpt>";
        }
        $path = public_path() . "/route{$route->id}.gpx";
        $gpxData = $gpxData . '</gpx>';
        File::put($path, $gpxData);

        return $path;
    }
}