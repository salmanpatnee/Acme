<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories        = Category::orderBy('name', 'asc')->paginate(20);
        $trashedCategories = Category::onlyTrashed()->orderBy('name', 'asc')->paginate(20);

        return view('admin.categories.index', [
            'categories'        => $categories,
            'trashedCategories' => $trashedCategories,
        ]);
    }

    public function store()
    {
        Category::create($this->validateAttributes());

        $notification = [
            'message' => 'Category added.',
            'type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category)
    {
        $category->update($this->validateAttributes($category));

        $notification = [
            'message' => 'Category updated.',
            'type' => 'info'
        ];

        return redirect(route('categories.index'))->with($notification);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        $notification = [
            'message' => 'Category deleted.',
            'type' => 'info'
        ];

        return redirect(route('categories.index'))->with($notification);
    }

    public function restore($categoryId)
    {
        Category::withTrashed()
            ->find($categoryId)
            ->restore();

        $notification = [
            'message' => 'Category restored.',
            'type' => 'info'
        ];

        return redirect(route('categories.index'))->with($notification);
    }

    public function forceDestroy($categoryId)
    {
        Category::onlyTrashed()
            ->find($categoryId)
            ->forceDelete();

        $notification = [
            'message' => 'Category deleted.',
            'type' => 'info'
        ];

        return redirect(route('categories.index'))->with($notification);
    }


    protected function validateAttributes(Category $category = null)
    {
        return request()->validate(
            [
                'name'        => ['required', Rule::unique('categories', 'name')->ignore($category), 'max:255'],
                'description' => 'nullable|string|max:255'
            ],
            [
                'name.required' => 'Category name can not be null.',
                'name.unique'   => 'Category already exist.',
            ]
        );
    }
}
