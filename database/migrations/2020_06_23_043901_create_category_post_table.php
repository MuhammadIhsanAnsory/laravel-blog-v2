<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category_post', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
      $table->unsignedBigInteger('post_id');
      $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
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
    Schema::dropIfExists('category_post');
  }
}
