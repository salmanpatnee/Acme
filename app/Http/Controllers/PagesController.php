<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Slide;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $brands = Brand::all();
        $slides = Slide::all();
        $categories = Category::orderby('name')->get();
        $portfolios = Portfolio::all();

        return view('pages.home', [
            'slides' => $slides,
            'brands' => $brands,
            'categories' => $categories,
            'portfolios' => $portfolios
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
