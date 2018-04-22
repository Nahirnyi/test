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
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class GpxRepository
{
    public const DISTANCE_EARTH = 2 * 3.14 * 6372795;

    /**
     * @param String $fileName
     * @return mixed
     */
    public function store(String $fileName)
    {
        $gpx = new Gpx();
        $gpx->name = $fileName;
        $gpx->status = config('models.migrations.gpx.stated');
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
     * @return Route
     */
    public function parseGpxFile(Route $route, Gpx $gpx) : Route
    {
        $file = fopen('gpx/'.$gpx->name, "r");
        while(!feof($file) && File::isFile($file)) {
            $str = fgets($file);
            $tracks = explode("</wpt>", $str);
            foreach ($tracks as $track)
            {
                $position = $this->getPositions($track);

                $latitude = $this->findLatitude($position, $track);
                $longitude = $this->findLongitude($position, $track);

                $data = $this->makeData($latitude, $longitude);

                $trackRepository = app(TrackRepository::class);

                $trackRepository->store($route, $data);
            }

        }

        fclose($file);

        $this->changeGpxStatus($gpx);

        return $route->load('tracks');
    }

    /**
     * @param Gpx $gpx
     */
    private function changeGpxStatus(Gpx $gpx)
    {
        $gpx->status = config('models.migrations.gpx.done');
        $gpx->save();
    }

    /**
     * @param array $position
     * @param $track
     * @return string
     */
    private function findLatitude(array $position, $track)
    {
        $latitude = '';
        for ($i = $position[0] + 1; $i < $position[1] - 1; $i++){
            $latitude .= $track[$i];
        }

        return $latitude;
    }

    /**
     * @param array $position
     * @param $track
     * @return string
     */
    private function findLongitude(array $position, $track)
    {
        $longitude = '';
        for ($i = $position[2] + 1; $i < $position[3] - 1; $i++){
            $longitude .= $track[$i];
        }

        return $longitude;
    }

    /**
     * @param $track
     * @return array
     */
    private function getPositions($track)
    {
        $count = 0;
        $position = [];
        for ($i = 0; $i < strlen($track); $i++)
        {
            if($track[$i] == "\"")
            {
                $position[$count] = $i;
                $count++;
                if ($count == 4){
                    break;
                }
            }
        }

        return $position;
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return array
     */
    private function makeData($latitude, $longitude)
    {
        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'speed' => rand(5, 10)
        ];
    }
}