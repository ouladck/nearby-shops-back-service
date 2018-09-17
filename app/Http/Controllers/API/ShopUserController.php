<?php

namespace App\Http\Controllers\API;

use App\ShopUser;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopUserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop_id = $request->id;
        $user_id = Auth::user()->id;
        $data = [
            'shop_id' => $shop_id,
            'user_id' => $user_id
        ];
        if ($request->is_liked) {
            $data['is_liked'] = true;
        }
        else {
            $data['is_disliked'] = false;
        }
        $shop_user = ShopUser::firstOrCreate($data);
        return response()->json([
            'shop' => $shop_user,
            'message' => ($request->is_liked) ? 'Shop Liked' : 'Shop Disliked'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopUser  $shop_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($shop_user)
    {
        $shopUser = ShopUser::whereShopId($shop_user)->first();
        if ($shopUser->delete()) {
            return response()->json([
                'shop' => $shopUser,
                'message' => 'Shop removed from your favorite list!'
            ]);
        }
        else {
            return response()->json([
                'shop' => $shopUser,
                'message' => 'Shop still in your favorite list!'
            ]);
        }
    }
}
