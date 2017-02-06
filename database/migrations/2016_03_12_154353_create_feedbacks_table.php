<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('ip')->nullable();
            $table->string('name')->nullable();
            $table->string('contact')->nullable();
            $table->longText('content');
            $table->longText('filePath')->nullable();
            $table->string('hasreply')->nullable();
            $table->string('haslook')->nullable();//是否已阅
            $table->longText('reply')->nullable();//回复内容
            $table->integer('showsnot');
            $table->longText('keywords')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('published_at');
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
        Schema::drop('feedbacks');
    }
}
