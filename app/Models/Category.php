<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

  use HasFactory;

  protected $fillable = [
    'title',
    'description',
  ];

  public function posts() {
    return $this->belongsToMany(Post::class);
  }

}
