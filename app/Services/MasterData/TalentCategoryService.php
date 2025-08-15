<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Models\MasterData\Category;
use App\Models\MasterData\Talent;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TalentCategoryService
{
    public function store(Request $request, Talent $talent)
    {
        try {
            $talent->categories()->attach($request->category_id);
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Talent $talent, Category $category)
    {
        try {
            $talent->categories()->detach($category->id);
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(Talent $talent)
    {
        $array = $talent->categories()->get();

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.talents.talent_categories.destroy', [$talent, $item->pivot->category_id]) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
