<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id');//侧边栏id

            $table->integer('count');//数量
            $table->string('title');
            $table->integer('order');
            $table->integer('team_id');

            $table->string('orderkey');
            $table->string('ordervalue');

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
        Schema::drop('sections_team');
    }
}
