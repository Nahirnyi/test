<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function ships() : HasMany
    {
        return $this->hasMany(Ship::class);
    }

    /**
     * @return HasMany
     */
    public function users() :HasMany
    {
        return $this->hasMany(User::class);
    }
}
