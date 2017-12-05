<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'status', 'description'
    ];

    /**
     * Active attribute accesssor.
     *
     * @var boolean
     */
    public function getActiveAttribute()
    {
        return $this->attributes['status'] == "Y";
    }

    /**
     * Product -> Store  relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stock()
    {
        return $this->hasMany('App\Store');
    }
}
