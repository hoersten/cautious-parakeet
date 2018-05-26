<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('attendees', function (Blueprint $table) {
      $table->increments('id');
      $table->string('first_name');
      $table->string('last_name');
      $table->timestamps();
    });
    Schema::create('trips_attendees', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('trip_id')->unsigned();
      $table->integer('attendee_id')->unsigned();
      $table->timestamps();
      $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
      $table->foreign('attendee_id')->references('id')->on('attendees');
    });
    Schema::create('highlights_attendees', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('highlight_id')->unsigned();
      $table->integer('attendee_id')->unsigned();
      $table->timestamps();
      $table->foreign('highlight_id')->references('id')->on('highlights')->onDelete('cascade');
      $table->foreign('attendee_id')->references('id')->on('attendees');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('highlights_attendees');
    Schema::dropIfExists('trips_attendees');
    Schema::dropIfExists('attendees');
  }
}
