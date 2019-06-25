<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddNetworksAuth extends Migration
{
    public function up()
    {
        Schema::create('user_networks', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('network', 100);
            $table->string('identity', 100);
            $table->primary(['user_id', 'identity']);

        });

        Schema::table('user_networks', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::table('user_networks', function (Blueprint $table) {
            $table->dropForeign('user_networks_user_id_foreign');
            $table->dropIfExists('user_networks');
        });
    }
}