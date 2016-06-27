<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summoners', function (Blueprint $table) {
            
            $table->string('region');
            $table->integer('playerId')->unsigned();
            $table->integer('user_id')->unsigned()->nulleable();
            $table->string('playerName');
            $table->string('leagueName');
            $table->string('tier');
            $table->string('division');
            $table->string('queue');
            $table->integer('leaguePoints');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('profileIconId')->default(0);
            $table->string('maxTier');
            $table->string('maxDivision');
            $table->primary(array('playerId', 'region'));
            $table->foreign('user_id')->references('Id')->on('users');
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
        Schema::drop('summoners');
    }
}
