<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

  use SoftDeletes;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}
