<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateRatingTalentRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentRating;
use Yajra\DataTables\Facades\DataTables;

class TalentRatingService
{
    public function store(UpdateRatingTalentRequest $request)
    {
        $request->validated();

        $talent = Talent::findOrFail($request->talent_id);
        try {
            $talent->talentRatings()->create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateRatingTalentRequest $request, TalentRating $talentRating)
    {
        $request->validated();

        try {
            $talentRating->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(TalentRating $talentRating) {
        try {
            $talentRating->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(Talent $talent, object $talentRating)
    {
        $array = $talent->talentRatings()->select('id', 'member_id', 'rating', 'status', 'comment')->with('member:id,name')->get();

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->member->name;
            $nestedData['rating'] = $item->rating;
            $nestedData['status'] = $item->status_badge;
            $nestedData['comment'] = $item->comment;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.talents.talent_rating.edit', [$talent, $item]) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.talents.talent_rating.destroy', [$talent, $item]) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "status"])->toJson();
    }
}
