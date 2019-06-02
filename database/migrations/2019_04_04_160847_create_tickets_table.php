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
            $table->bigIncrements('id');
            $table->unsignedInteger('bus_route_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('start_place')->nullable();
            $table->string('destination_place')->nullable();
            $table->string('seat_number');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('quantity')->nullable();
            $table->tinyInteger('payment_method')->default(01);
            $table->dateTime('date_away');
            $table->double('total_price');
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
