<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('towerid');
            $table->string('sitename');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('stateid');
            $table->string('zipcode');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('height');
            $table->string('structuretype');
            $table->string('infication');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email');
			$table->string('region');
            $table->string('towerowner');
            $table->string('towerownershort');
            $table->string('btanumber');
            $table->string('btaname');
            $table->string('mtanumber');
            $table->string('mtaname');
            $table->string('newsite');
            $table->string('fccnumber');
            $table->string('stimsiteid');
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
        Schema::dropIfExists('towers');
    }
}
