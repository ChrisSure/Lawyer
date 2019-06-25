<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('path', 200);
            $table->integer('sum');
            $table->string('status', 16);
            $table->timestamps();
        });

        Schema::table('state', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('state', function (Blueprint $table) {
            $table->dropForeign('state_user_id_foreign');
            $table->dropIfExists('state');
        });
    }
}
