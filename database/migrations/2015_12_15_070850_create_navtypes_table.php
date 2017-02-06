<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('typename');
            $table->string('subtype')->nullable();
            $table->string('typeicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navtypes');
    }
}
