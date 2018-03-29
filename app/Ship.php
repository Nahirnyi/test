<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ship extends Model
{

    /*************
     * RELATIONS *
     ************/

    /**
     * @return BelongsTo
     */
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function containers() : HasMany
    {
        return $this->hasMany(Container::class,'container_id','id');
    }

    /**
     * @return HasMany
     */
    public function routes() : HasMany
    {
        return $this->hasMany(Route::class, 'route_id', 'id');
    }
}
