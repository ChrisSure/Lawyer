<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReverseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reverse', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 100)->nullable();
            $table->text('text');
            $table->string('status', 16);
            $table->timestamps();
        });

        Schema::table('reverse', function($table) {
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
        Schema::table('reverse', function (Blueprint $table) {
            $table->dropForeign('reverse_user_id_foreign');
            $table->dropIfExists('reverse');
        });
    }
}
