<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopUser extends Model
{
    protected $table = 'shop_user';

    protected $fillable = ['user_id', 'shop_id', 'is_liked', 'is_disliked'];
}
