<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateTalentPriceRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentPrice;
use Yajra\DataTables\Facades\DataTables;

class TalentPriceService
{
    public function store(UpdateTalentPriceRequest $request, Talent $talent) {
        $request->validated();

        try {
            $talent->talentPrices()->create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateTalentPriceRequest $request, TalentPrice $talentPrice)
    {
        $request->validated();

        try {
            $talentPrice->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(TalentPrice $talentPrice) {
        try {
            $talentPrice->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(Talent $talent, object $talentPrice)
    {
        $array = $talent->talentPrices()->get(['id', 'name', 'price', 'session']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['price'] = 'Rp '.$item->format_price;
            $nestedData['session'] = $item->session;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.talents.talent_price.edit', [$talent, $item]) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.talents.talent_price.destroy', [$talent, $item]) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "image"])->toJson();
    }
}
