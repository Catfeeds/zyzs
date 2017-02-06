<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitesets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyname');
            $table->string('companyphone');
            $table->string('companyfax');
            $table->string('companyaddress');
            $table->string('companylogo');
            $table->string('footershow')->nullable();
            $table->string('footericonshow')->nullable();
            $table->string('sitename');
            $table->string('siteico');
            $table->string('sitebeian');
            $table->string('sitekeywords');
            $table->longText('sitedescription');
            $table->string('siteurl');
            $table->string('sitemqcrode')->nullable();
            $table->string('sitewxqcrode')->nullable();
            $table->longText('statistical')->nullable();
            $table->string('comment')->nullable();
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
        Schema::drop('sitesets');
    }
}
