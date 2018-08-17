<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            // Own parameters
            $table->increments('id');
            $table->datetime('dateCreation')->nullable()->default(null);
            $table->datetime('dateValidation')->nullable()->default(null);

            // Fk
            $table->unsignedInteger("validator")->nullable()->default(null);
            $table->foreign("validator")->references('id')->on('users');

            $table->unsignedInteger("idGamer");
            $table->unsignedInteger("idTicketType");
            $table->foreign("idTicketType")->references('id')->on('ticket_types');
            $table->foreign("idGamer")->references('id')->on('users');
            $table->unique(['idGamer','idTicketType']);

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
        Schema::dropIfExists('tickets');
    }
}
