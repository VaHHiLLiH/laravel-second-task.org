<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use Faker\Factory;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(ImageRepository $imageRepository)
    {
        //dd($imageRepository->getPeace(0, 5));
        //$category = Category::factory()->create();
        //$images = Image::factory()->count(9)->for($category)->create();
        // НЕ РАБОТАЕТ

        //$category = Category::factory()->has(Image::factory()->count(9))->create();

        return view('welcome');
    }

    public function viewCategory(Category $category)
    {
        return view('category', compact('category'));
    }

    public function showCategory(Request $request, CategoryRepository $categoryRepository)
    {
        //dd($request->all());

        return $categoryRepository->getPeace($request->get('start'), $request->get('count'));
    }

    public function getCategoryLimit(Request $request, CategoryRepository $categoryRepository)
    {
        return count(Category::all());
    }
}
