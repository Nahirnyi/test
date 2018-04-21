<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'speed',
        'longitude',
        'latitude'
    ];

    /**
     * @return BelongsTo
     */
    public function route() : BelongsTo
    {
        return $this->belongsTo(Route::class,'route_id', 'id');
    }
}
