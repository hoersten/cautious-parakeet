<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighLightsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('highlights', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('trip_id')->unsigned();
      $table->string('slug')->unique();
      $table->string('name');
      $table->string('road')->nullable();
      $table->string('road2')->nullable();
      $table->string('city')->nullable();
      $table->string('state')->nullable();
      $table->string('zip')->nullable();
      $table->string('country')->nullable();
      $table->decimal('lat', 6);
      $table->decimal('lon', 6);
      $table->string('description');
      $table->timestamps();
      $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('highlights');
  }
}
