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

    public function findCategory($filter_name)
    {
        return DB::table('categories')->where('name', 'like', ucfirst($filter_name).'%')->get();
    }

    /*public function getCount($category_id)
    {
        return count(DB::table('images')->where('category_id'));
    }*/
}
