<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 19.04.2018
 * Time: 16:13
 */

namespace App\Repositories;

use App\Track;

class TrackRepository
{
    /**
     * @param $data
     * @return Track
     */
    public function add($data) : Track
    {
        $track = new Track();
        $track->latitude = $data['latitude'];
        $track->longitude = $data['longitude'];
        $track->speed = $data['speed'];
        $track->route_id = $data['route_id'];
        $track->save();

        return $track;
    }

    /**
     * @param $route
     * @return Track
     */
    public function all($route): Track
    {
        $tracks = $route->tracks()->get();

        return $tracks;
    }
}