<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileIconIdColumnSummoners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summoners', function (Blueprint $table) {
            $table->integer('profileIconId')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summoners', function (Blueprint $table) {
            $table->dropColumn('profileIconId');
        });
    }
}
