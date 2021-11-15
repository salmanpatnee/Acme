<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Image;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->paginate(20);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store()
    {
        $attributes = $this->validateAttributes();

        if (request()->has('image')) {
            $file = $this->uploadBanner(request()->file('image'));
            $attributes['image'] = $file;
        }

        Slide::create($attributes);

        $notification = [
            'message' => 'Slide added.',
            'type' => 'success'
        ];

        return redirect(route('slides.index'))->with($notification);
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Slide $slide)
    {
        $attributes = $this->validateAttributes();

        $attributes['image'] = $attributes['old_image'];

        if (request()->has('image')) {
            File::delete(public_path($attributes['image']));
            $file = $this->uploadBanner(request()->file('image'));
            $attributes['image'] = $file;
        }

        $slide->update($attributes);

        $notification = [
            'message' => 'Slide updated.',
            'type' => 'info'
        ];

        return redirect(route('slides.index'))->with($notification);
    }

    public function destroy(Slide $slide)
    {
        File::delete(public_path($slide->image));

        $slide->delete();

        $notification = [
            'message' => 'Slide deleted.',
            'type' => 'info'
        ];

        return redirect(route('slides.index'))->with($notification);
    }
    protected function uploadBanner($image)
    {

        $file = '/images/slides/' . time() . '.jpeg';

        $isUploaded = Image::make($image)->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpeg')->save(public_path($file));

        return ($isUploaded) ? $file : false;
    }

    protected function validateAttributes()
    {
        return request()->validate(
            [
                'title'     => 'nullable|string|max:255',
                'caption'   => 'nullable|string|max:255',
                'image'     => 'required_without_all:old_image|image|mimes:jpg,jpeg,webp,png|max:2048',
                'old_image' => 'string'
            ],
            [
                'image.required_without_all' => 'Image is required'
            ]
        );
    }
}
