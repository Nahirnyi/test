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

class TrackRepository
{
    /**
     * @param Route $route
     * @param array $data
     * @return Track
     */
    public function add(Route $route, array $data) : Track
    {
        $track = new Track($data);

        Redis::set($data['route_id'], $data);

        $track->route()->associate($route);
        $track->save();

        return $track;
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