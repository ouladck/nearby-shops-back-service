<?php

namespace App\Http\Controllers\API;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lat = floatval(34.037582);
        $lon = floatval(-6.751614);
        $shops = Shop::nearest($lat, $lon);
        $shops = $this->paginate($shops);

        return response()->json(compact('shops'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return response()->json(compact('shop'));
    }


    /**
     * Display preferred shops
     *
     * @param Shop $shop
     * @return \Illuminate\Http\JsonResponse
     */
    public function preferred()
    {
        $shops = Auth::user()->shops()->whereIsLiked(true)->paginate(12);
        return response()->json(compact('shops'));
    }

}
