<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateTimeTaken extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('pictures', function (Blueprint $table) {
      $table->datetime('date_taken')->change();
      $table->renameColumn('date_taken', 'datetime_taken');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    $table->renameColumn('datetime_taken', 'date_taken');
    $table->date('date_taken')->change();
  }
}
