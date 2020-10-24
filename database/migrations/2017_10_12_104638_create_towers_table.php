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
            $table->string('sitename')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('height')->nullable();
            $table->string('structuretype')->nullable();
            $table->string('structureclassification');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
			$table->string('region')->nullable();
            $table->string('towerowner');
            $table->string('towerownershort')->nullable();
            $table->string('btanumber')->nullable();
            $table->string('btaname')->nullable();
            $table->string('mtanumber')->nullable();
            $table->string('mtaname')->nullable();
            $table->string('newsite')->nullable();
            $table->string('fccnumber')->nullable();
            $table->string('stimsiteid')->nullable();
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
