<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\DB;


class ImageRepository
{
    public function getAll()
    {
        return Image::all();
    }

    public function getPeace($start, $count)
    {
        return DB::table('images')->skip($start)->take($count)->get();
    }

    public function getPeaceForCategory($start, $count, $category_id)
    {
        return DB::table('images')->where('category_id', '=', $category_id)->skip($start)->take($count)->get();
    }
}

