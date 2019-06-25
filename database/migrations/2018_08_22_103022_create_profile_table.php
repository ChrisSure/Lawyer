<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('surname', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('phone', 50)->nullable();
            $table->timestamps();
        });

        Schema::table('profile', function($table) {
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
        Schema::table('profile', function (Blueprint $table) {
            $table->dropForeign('profile_user_id_foreign');
            $table->dropIfExists('profile');
        });
    }
}
