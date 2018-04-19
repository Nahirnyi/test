<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Container extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'price'
    ];

    /**
     * @return BelongsTo
     */
    public function ship() : BelongsTo
    {
        return $this->belongsTo(Ship::class, 'ship_id', 'id');
    }
}
