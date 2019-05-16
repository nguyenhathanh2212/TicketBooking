<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('start_station_id');
            $table->unsignedInteger('destination_station_id');
            $table->time('start_time');
            $table->time('destination_time');
            $table->string('phone')->nullable();
            $table->tinyInteger('reservation')->default(1);
            $table->tinyInteger('direct_payment')->default(1);
            $table->unsignedInteger('number_preset_date')->default(10);
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
        Schema::dropIfExists('routes');
    }
}
