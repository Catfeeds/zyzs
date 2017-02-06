<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//姓名
            $table->string('zhiwu');//职务
            $table->string('introduce');//介绍
            $table->integer('order');//排序
            $table->integer('type');
            $table->integer('indexshow');//0|1
            $table->string('photo');//招聘
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
        Schema::drop('teams_member');
    }
}
