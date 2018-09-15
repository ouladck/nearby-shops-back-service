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
        return $this->belongsToMany('App\User')->withPivot('is_liked');
    }

    static function nearest ($lat1, $lon1) {
        $shops = \DB::table('shops')
            ->select(['shops.*', 'shop_user.is_liked'])
            ->leftjoin('shop_user', 'shop_user.shop_id', '=', 'shops.id')
            ->where('shop_user.is_liked', '=', null)
            ->get();
        $shops->transform(function ($shop) use ($lat1, $lon1){
            $location = explode('#', $shop->location);
            $shop = (array)$shop;
            $shop['distance'] = Shop::calculateDistance($lat1, $lon1, $location[0], $location[1]);
            $shop = collect($shop);
            return $shop;
        });
        $shops = $shops->sortBy('distance');
        return $shops;
    }


    static function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $R = 6371; //KM
        $d = acos(sin($lat1) * sin($lat2) +
                cos($lat1) * cos($lat2) * cos($lon2 - $lon1)) * $R;
        return $d;
    }
}
