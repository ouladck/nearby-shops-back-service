<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name', 'email', 'location', 'city', 'picture'
    ];

    /**
     * Users liked or disliked this shops
     * @return Relationship
     */
    function users () {
        return $this->belongsToMany('App\User');
    }
}
