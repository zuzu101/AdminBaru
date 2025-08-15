<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateArtCategoryRequest;
use App\Models\MasterData\ArtCategory;
use Yajra\DataTables\Facades\DataTables;

class ArtCategoryService
{
    public function store(UpdateArtCategoryRequest $request) {
        $request->validated();

        try {
            ArtCategory::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateArtCategoryRequest $request, ArtCategory $artCategory)
    {
        $request->validated();

        try {
            $artCategory->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(ArtCategory $artCategory) {
        try {
            $artCategory->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $artCategory)
    {
        $array = $artCategory->get(['id', 'name']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.art-categories.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.art-categories.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
