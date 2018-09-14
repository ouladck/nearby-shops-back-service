<?php

use Illuminate\Database\Seeder;
use App\Shop;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->delete();
        $json = File::get('database/seeds/shops.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Shop::create(array(
                'name' => $obj->name,
                'email' => $obj->email,
                'city' => $obj->city,
                'picture' => $obj->picture,
                'location' => implode('#', $obj->location->coordinates)
            ));
        }
    }
}
