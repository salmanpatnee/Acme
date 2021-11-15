<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Image;

use function App\Helpers\uploadImage;

class BrandController extends Controller
{
    private $path = 'images/brands/';

    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->paginate(20);

        return view('admin.brands.index', compact('brands'));
    }

    public function store()
    {
        $attributes = $this->validateAttributes();

        if (request()->has('image')) {
            $attributes['image'] = uploadImage($this->path, request()->file('image'));
        }

        Brand::create($attributes);

        return redirect(route('brands.index'))
            ->with([
                'message' => 'Brand added.',
                'type'    => 'success'
            ]);
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Brand $brand)
    {
        $attributes = $this->validateAttributes($brand);

        $attributes['image'] = $attributes['old_image'];

        if (request()->has('image')) {

            File::delete($attributes['image']);

            $attributes['image'] = uploadImage($this->path, request()->file('image'));
        }

        $brand->update($attributes);

        return redirect(route('brands.index'))
            ->with([
                'message' => 'Brand updated.',
                'type' => 'success'
            ]);
    }

    public function destroy(Brand $brand)
    {
        File::delete($brand->image);

        $brand->delete();

        return redirect(route('brands.index'))
            ->with([
                'message' => 'Brand deleted.',
                'type' => 'info'
            ]);
    }

    protected function validateAttributes(Brand $brand = null)
    {

        return request()->validate(
            [
                'name'      => ['required', Rule::unique('brands', 'name')->ignore($brand), 'min:3', 'max:255'],
                'image'     => 'image|mimes:jpg,jpeg,webp,png|max:2048',
                'old_image' => 'string'
            ],
            [
                'name.required' => 'Brand name can not be null.',
                'name.unique'   => 'Brand already exist.',
                'name.min'   => 'Brand name can not be less than 3 characters.',
            ]
        );
    }
}
