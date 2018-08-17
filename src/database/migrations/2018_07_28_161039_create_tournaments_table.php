<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            // Own parameters
            $table->increments('id');
            $table->datetime("beginDate");
            $table->datetime("endDate");
            $table->string("name");

            // Fk
            $table->unsignedInteger("idEsilan");
            $table->unsignedInteger("idGame");
            $table->foreign("idEsilan")->references('id')->on('esilans');
            $table->foreign("idGame")->references('id')->on('games');
            $table->unique(['idEsilan','idGame']);
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
        Schema::dropIfExists('tournaments');
    }
}
