<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    /**
     * @return BelongsTo
     */
   public function ship() : BelongsTo
   {
       $this->belongsTo(Ship::class, 'ship_id', 'id');
   }

    /**
     * @return HasMany
     */
   public function tracks() : HasMany
   {
       $this->hasMany(Track::class, 'track_id', 'id');
   }
}
