<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank', function (Blueprint $table) {
            $table->integer('rank');
            $table->integer('points');
            $table->integer('summoner_id')->unsigned();
            $table->string('summoner_region');
            $table->foreign(array('summoner_id', 'summoner_region'))->references(array('playerId', 'region'))->on('summoners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rank');
    }
}
