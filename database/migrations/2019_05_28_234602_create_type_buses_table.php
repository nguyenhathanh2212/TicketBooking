<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('number_of_seats');
            $table->tinyInteger('number_row');
            $table->tinyInteger('number_column');
            $table->tinyInteger('number_level');
            $table->text('map');
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
        Schema::dropIfExists('type_buses');
    }
}
