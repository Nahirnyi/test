<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 20.04.2018
 * Time: 20:12
 */

namespace App\Repositories;


use App\Gpx;
use App\Route;
use App\Track;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GpxRepository
{
    /**
     * @param String $fileName
     * @return mixed
     */
    public function store(String $fileName)
    {
        $gpx = new Gpx();
        $gpx->name = $fileName;
        $gpx->status = 'stated';
        $gpx->save();

        return $gpx;
    }

    /**
     * @return Collection
     */
    public function all() : Collection
    {
        $gpxes = Gpx::all();

        return $gpxes;
    }

    /**
     * @param Gpx $gpx
     * @throws \Exception
     */
    public function delete(Gpx $gpx)
    {
        $gpx->delete();
    }

    /**
     * @param $gpxFile
     * @return String
     */
    public function uploadFile($gpxFile) : String
    {
        if ($gpxFile == null) {
            return 'Файл не вибраний';
        }
        if ($gpxFile->extension() != ('txt' || 'kml' || 'gpx')) {
            return 'Файл не розширення txt gpx kml';
        }

        $date = Carbon::now()->toDateTimeString();
        $r = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y_m_d_H_i_s');
        $filename = $r . '.gpx';
        $gpxFile->storeAs('gpx', $filename);

        return $filename;
    }

    /**
     * @param Route $route
     * @param Gpx $gpx
     * @return int
     */
    public function parseGpxFile(Route $route, Gpx $gpx)
    {
        $f = fopen('gpx/'.$gpx->name, "r");
        while(!feof($f)) {
            $str = substr(fgets($f), 5, strlen(fgets($f)) - 11);
            $pieces = explode("</wpt>", $str);
            $countTracks = 0;
            foreach ($pieces as $piece)
            {
                $count = 0;
                $position = [];
                for ($i = 0;$i< strlen($piece);$i++)
                {
                    if($piece[$i] == "\"")
                    {
                        $position[$count] = $i;
                        $count++;
                        if ($count == 4){
                            break;
                        }
                    }
                }
                $latitude = '';
                for ($i = $position[0] + 1; $i < $position[1] - 1; $i++){
                    $latitude = $latitude . $piece[$i];
                }
                $longitude = '';
                for ($i = $position[2] + 1; $i < $position[3] - 1; $i++){
                    $longitude = $longitude . $piece[$i];
                }

                $track = new Track();
                $track->latitude = $latitude;
                $track->longitude = $longitude;
                $track->speed = rand(5, 50);
                $track->route()->associate($route);
                $track->save();
                $countTracks++;
            }

        }

        fclose($f);

        return $countTracks;
    }
}