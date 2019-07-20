<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDescriptionToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('esilans', function (Blueprint $table) {
            $table->text("desc")->nullable()->default(null)->change();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->text("desc")->nullable()->default(null)->change();
        });
        Schema::table('ticket_types', function (Blueprint $table) {
            $table->text("desc")->nullable()->default(null)->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('esilans', function (Blueprint $table) {
            $table->text("desc")->nullable(false)->change();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->text("desc")->nullable(false)->change();
        });
        Schema::table('ticket_types', function (Blueprint $table) {
            $table->text("desc")->nullable(false)->change();
        });
    }
}
