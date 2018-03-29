<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    /**
     * @return BelongsTo
     */
    public function route() : BelongsTo
    {
        $this->belongsTo(Route::class,'route_id', 'id');
    }
}
