<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTypeTournamentCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tick_tour_compatibilities', function (Blueprint $table) {
            $table->increments('id');
            // Fk
            $table->unsignedInteger("idTournament");
            $table->unsignedInteger("idTicketType");
            $table->foreign("idTournament")->references('id')->on('tournaments');
            $table->foreign("idTicketType")->references('id')->on('ticket_types');
            $table->unique(['idTournament','idTicketType']);
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
        Schema::dropIfExists('tick_tour_compatibilities');
    }
}
