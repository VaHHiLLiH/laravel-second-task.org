<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function getPeace($start, $count)
    {
        return DB::table('categories')->skip($start)->take($count)->get();
    }
}
