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

        //$category = Category::factory()->has(Image::factory()->count(10))->create();



        return view('welcome');
    }

    public function viewCategory(Category $category)
    {
        $images = $category->images;

        return view('category', compact('category', 'images'));
    }

    public function showCategory(Request $request, CategoryRepository $categoryRepository)
    {
        //dd($request->all());

        return $categoryRepository->getPeace($request->get('start'), $request->get('count'));
    }

    public function getCategoryLimit()
    {
        return count(Category::all());
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->get('category_id'));

        $category->delete();
    }

    public function findCategories(Request $request, CategoryRepository $categoryRepository)
    {
        return $categoryRepository->findCategory($request->get('name_filter'));
    }

    public function getCount(Request $request, CategoryRepository $categoryRepository)
    {
        $category = Category::find($request->get('category_id'));

        return count($category->images);
    }

    public function getPeaceForCategory(Request $request, ImageRepository $imageRepository)
    {
        return $imageRepository->getPeaceForCategory($request->get('start'), $request->get('count'), $request->get('id'));
    }
}
