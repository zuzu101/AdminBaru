<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateProfessionalCategoryRequest;
use App\Models\MasterData\ProfessionalCategory;
use Yajra\DataTables\Facades\DataTables;

class ProfessionalCategoryService
{
    public function store(UpdateProfessionalCategoryRequest $request) {
        $request->validated();

        try {
            ProfessionalCategory::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateProfessionalCategoryRequest $request, ProfessionalCategory $professionalCategory)
    {
        $request->validated();

        try {
            $professionalCategory->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(ProfessionalCategory $professionalCategory) {
        try {
            $professionalCategory->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $professionalCategory)
    {
        $array = $professionalCategory->get(['id', 'name']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.professional-categories.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.professional-categories.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
