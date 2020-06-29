<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function posts()
  {
    return $this->belongsToMany(Post::class);
  }
}
