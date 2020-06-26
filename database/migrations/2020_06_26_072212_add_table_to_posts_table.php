<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableToPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id')->after('id');
      $table->foreign('user_id')->references('id')->on('users');
      $table->boolean('status')->after('slug');
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropColumn('user_id');
      $table->dropColumn('status');
      $table->dropSoftDeletes();
    });
  }
}
