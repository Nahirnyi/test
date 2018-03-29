<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
