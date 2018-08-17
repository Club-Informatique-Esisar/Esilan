<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esilans', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text("desc");
            $table->string("imgName");
            $table->datetime("beginDate");
            $table->datetime("endDate");
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
        Schema::dropIfExists('esilans');
    }
}
