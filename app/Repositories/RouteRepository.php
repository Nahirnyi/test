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
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

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
     * @return string
     */
    public function makeGpx(Route $route)
    {
        $tracks = $route->tracks()->get();
        $gpxData = '<gpx>';
        foreach ($tracks as $track)
        {
            $gpxData = $gpxData."<wpt lat=\"{$track->latitude}\" lon=\"{$track->longitude}\"></wpt>";
        }
        $path = public_path() . "\maded\\route{$route->id}.gpx";
        $gpxData = $gpxData . '</gpx>';
        File::put($path, $gpxData);

        return $path;
    }

    /**
     * @param $first
     * @param $last
     * @return float|int
     */
    public function calculateDistance ($first, $last)
    {
        $lat1 = $first->latitude;
        $lon1 = $first->longitude;
        $lat2 = $last->latitude;
        $lon2 = $last->longitude;

        $distanceEarth = 2 * 3.14 * 6372795;
        $distance = sqrt(($lat1 - $lat2) * ($lat1 - $lat2) + ($lon1 - $lon2) * ($lon1 - $lon2)) * $distanceEarth / 360;
        return $distance;
    }

    /**
     * @param $first
     * @param $last
     * @return mixed
     */
    public function calculateTime ($first, $last)
    {
        $time1 = $first->created_at;
        $time2 = $last->created_at;

        $time = $time1->diffInSeconds($time2);
        return $time;
    }

    /**
     * @param $distance
     * @param $time
     * @return float|int
     */
    public function calculateSpeed($distance, $time)
    {
        $speed = $distance / $time;

        return $speed;
    }

    /**
     * @param Route $route
     * @param $distance
     * @param $time
     * @param $speed
     * @return Route
     */
    public function update(Route $route, $distance, $time, $speed) : Route
    {
        $route->total_time = $time;
        $route->total_distance = $distance;
        $route->average_speed = $speed;
        $route->save();

        return $route;
    }
}