<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('pictures', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('highlight_id')->unsigned();
      $table->string('url');
      $table->decimal('lat', 10, 7);
      $table->decimal('lon', 10, 7);
      $table->date('date_taken')->nullable();
      $table->string('caption')->nullable();
      $table->timestamps();
      $table->foreign('highlight_id')->references('id')->on('highlights')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('pictures');
  }
}
