<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_schedule', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->enum('day_flag', ['workday', 'day_off']);
            $table->unsignedInteger('office_id');

            $table->foreign('office_id')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_schedule');
    }
}
