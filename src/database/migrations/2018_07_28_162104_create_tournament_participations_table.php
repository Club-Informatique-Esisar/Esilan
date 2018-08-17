<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_participations', function (Blueprint $table) {
            $table->increments('id');

            // Fk
            $table->unsignedInteger("idTournament");
            $table->unsignedInteger("idGamer");
            $table->foreign("idTournament")->references('id')->on('tournaments');
            $table->foreign("idGamer")->references('id')->on('users');
            $table->unique(['idTournament','idGamer']);

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
        Schema::dropIfExists('tournament_participations');
    }
}
