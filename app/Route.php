<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'total_time',
        'total_distance',
        'average_speed'
    ];

    /**
     * @return BelongsTo
     */
   public function ship() : BelongsTo
   {
       return $this->belongsTo(Ship::class, 'ship_id', 'id');
   }

    /**
     * @return HasMany
     */
   public function tracks() : HasMany
   {
       return $this->hasMany(Track::class);
   }
}
