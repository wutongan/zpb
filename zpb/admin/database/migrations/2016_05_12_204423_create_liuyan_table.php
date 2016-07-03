<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiuyanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('toupiao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->enum('stat',['Y','N']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
