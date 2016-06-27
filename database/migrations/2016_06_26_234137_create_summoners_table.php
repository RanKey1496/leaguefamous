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
            $table->integer('playerId');
            $table->string('playerName');
            $table->string('region');
            $table->string('leagueName');
            $table->string('tier');
            $table->string('division');
            $table->string('queue');
            $table->integer('leaguePoints');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('likes');
            $table->string('maxTier');
            $table->string('maxDivision');
            $table->integer('user_id')->nulleable();

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
