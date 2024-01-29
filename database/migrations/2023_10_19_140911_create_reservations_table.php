<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->enum('type', ['full', 'place']);
            $table->unsignedInteger('office_id');
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('place_id')->nullable();
            $table->unsignedInteger('user_id');

            $table->foreign('office_id')->references('id')->on('offices');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
