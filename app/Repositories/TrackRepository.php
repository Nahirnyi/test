<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 19.04.2018
 * Time: 16:13
 */

namespace App\Repositories;

use App\Route;
use App\Track;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use function MongoDB\BSON\toJSON;

class TrackRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        if (Redis::get($data['route_id']))
        {
            $oldData = json_decode(Redis::get($data['route_id']));
            array_push($oldData, $data);
            Redis::set($data['route_id'], json_encode($oldData));
        } else {
            $arr['0'] = $data;
            Redis::set($data['route_id'], json_encode($arr));
        }
        $result = json_decode(Redis::get($data['route_id']));
        return $result;
    }

    /**
     * @param Route $route
     * @return Route
     */
    public function saveToDB(Route $route) : Route
    {
        $tracks = json_decode(Redis::get($route->id));
        foreach ($tracks as $tr)
        {
            $track = new Track();
            $track->latitude = $tr->latitude;
            $track->longitude = $tr->longitude;
            $track->speed = $tr->speed;
            $track->route_id = $tr->route_id;
            $track->save();
        }

        return $route;
    }

    /**
     * @param Route $route
     * @return Collection
     */
    public function all(Route $route) : Collection
    {
        $tracks = $route->tracks()->with('route')->get();

        return $tracks;
    }
}