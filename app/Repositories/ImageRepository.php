<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

// Указать везде тайпхинты
class ImageRepository
{
    public function getAll()
    {
        return Image::all();
    }

    public function getPeace(int $start, int $count)
    {
        return DB::table('images')->skip($start)->take($count)->get();
    }

    public function getPeaceForCategory(int $start, int $count, int $category_id)
    {
        return DB::table('images')->where('category_id', '=', $category_id)->skip($start)->take($count)->get();
    }
}

