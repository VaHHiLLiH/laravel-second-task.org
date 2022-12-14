<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'image_path',
      'status',
      'category_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
