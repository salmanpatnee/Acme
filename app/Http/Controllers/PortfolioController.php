<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(20);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        return view('portfolios.show', compact('portfolio'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store()
    {
        $attributes = $this->validateAttributes();

        if (request()->has('image')) {
            $file = $this->uploadThumbnail(request()->file('image'));
            $attributes['image'] = $file;
        }

        $portfolio = Portfolio::create($attributes);

        $portfolio->categories()->attach(request('category_id'));

        $notification = [
            'message' => 'Portfolio added.',
            'type' => 'success'
        ];

        return redirect(route('portfolios.index'))->with($notification);
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.portfolios.edit', compact('categories', 'portfolio'));
    }

    public function update(Portfolio $portfolio)
    {
        $attributes = $this->validateAttributes($portfolio);

        if (request()->has('image')) {
            $file = $this->uploadThumbnail(request()->file('image'));
            $attributes['image'] = $file;
        }

        $portfolio->update($attributes);

        $portfolio->categories()->sync(request('category_id'));

        $notification = [
            'message' => 'Portfolio updated.',
            'type' => 'info'
        ];

        return redirect(route('portfolios.index'))->with($notification);
    }

    public function destroy(Portfolio $portfolio)
    {
        File::delete(public_path($portfolio->imagepath));
        $portfolio->delete();

        $notification = [
            'message' => 'Portfolio deleted.',
            'type' => 'info'
        ];

        return redirect(route('portfolios.index'))->with($notification);
    }

    protected function uploadThumbnail($image)
    {

        $file = '/images/portfolios/' . time() . '.jpeg';

        $isUploaded = Image::make($image)->resize(870, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpeg')->save(public_path($file));

        return ($isUploaded) ? $file : false;
    }

    protected function validateAttributes(Portfolio $portfolio = null)
    {
        return request()->validate(
            [
                'title'       => ['required', Rule::unique('portfolios', 'title')->ignore($portfolio), 'max:255'],
                'description' => 'nullable|string',
                'client'      => 'nullable|string|max:255',
                'date'        => 'nullable|date',
                'url'         => 'nullable|url',
                'image'       => 'required_without_all:old_image|image|max:2048',
                'category_id' => 'required|exists:categories,id',
            ],
            [
                'image.required_without_all' => 'Image is required'
            ]
        );
    }
}
