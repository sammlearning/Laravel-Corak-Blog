<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'link_id',
    'parent_list',
    'position',
    'type',
    'url',
    'category_id',
  ];

  public function links() {
    return $this->hasMany(Link::class);
  }

  public function parent() {
    return $this->belongsTo(Link::class, 'link_id');
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

}
