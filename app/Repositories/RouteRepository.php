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
use Illuminate\Support\Facades\File;

class RouteRepository
{
    /**
     * @param $data
     * @param $ship
     * @return Route
     */
    public function add($data, $ship) : Route
    {
        $route = new Route();
        $route->total_time = $data['total_time'];
        if ($data['ship_id'])
        {
            $route->ship_id = $data['ship_id'];
        } elseif($ship)
        {
            $route->ship()->associate($ship);
        }

        $route->total_distance = $data['total_distance'];
        $route->average_speed = $data['average_speed'];
        $route->save();

        return $route;
    }

    /**
     * @param $ship
     * @return Route
     */
    public function all($ship): Route
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
     * @param $route
     * @return string
     */
    public function makeGpx($route)
    {
        $tracks = $route->tracks()->get();
        $gpxData = "<gpx>";
        foreach ($tracks as $track)
        {
            $gpxData = $gpxData."<wpt lat=\"{$track->latitude}\" lon=\"{$track->longitude}\"></wpt>";
        }
        $path = public_path()."/gpxFiles/route{$route->id}.gpx";
        $gpxData = $gpxData."</gpx>";
        File::put($path, $gpxData);

        return $path;
    }
}