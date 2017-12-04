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
        'name', 'description', 'price', 'status'
    ];

    public function getActiveAttribute()
    {
        return $this->attributes['status'] == "Y";
    }
}
