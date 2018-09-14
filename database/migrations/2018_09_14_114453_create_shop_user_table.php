<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shop_id');
            $table->boolean('is_liked')->default(false);
            $table->boolean('is_disliked')->default(false);
            $table->timestamps();
        });
        Schema::table('shop_user', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_user');        Schema::table('shop_user', function (Blueprint $table) {
        $table->dropForeign('user_shop_shop_id_foreign');
        $table->dropForeign('user_shop_user_id_foreign');
    });

        Schema::dropIfExists('shop_user');
    }
}
