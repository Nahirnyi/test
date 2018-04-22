<?php

namespace App\Jobs;

use App\Track;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TrackQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $track;

    /**
     * TrackQueue constructor.
     * @param $track
     */
    public function __construct($track)
    {
        $this->track = $track;
    }

    /**
     *
     */
    public function handle()
    {
        $track = new Track();
        $track->latitude = $this->track->latitude;
        $track->longitude = $this->track->longitude;
        $track->speed = $this->track->speed;
        $track->route_id = $this->track->route_id;
        $track->save();
    }
}
