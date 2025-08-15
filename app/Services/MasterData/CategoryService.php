<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateCategoryRequest;
use App\Models\MasterData\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    public function store(UpdateCategoryRequest $request) {
        $request->validated();

        try {
            Category::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();

        try {
            $category->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Category $category) {
        try {
            $category->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $category)
    {
        $array = $category->get(['id', 'name']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.categories.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.categories.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
