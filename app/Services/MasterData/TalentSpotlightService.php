<?php

namespace App\Services\MasterData;

use App\Helpers\ErrorHandling;
use App\Http\Requests\MasterData\UpdateTalentSpotlightRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentSpotlight;
use Yajra\DataTables\Facades\DataTables;

class TalentSpotlightService
{
    public function store(UpdateTalentSpotlightRequest $request, Talent $talent) {
        $request->validated();

        try {
            $talent->talentSpotlights()->create([
                'url' => $this->urlConverterYoutube($request->url)
            ]);
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdateTalentSpotlightRequest $request, TalentSpotlight $talentSpotlight)
    {
        $request->validated();

        try {
            $talentSpotlight->update([
                'url' => $this->urlConverterYoutube($request->url)
            ]);
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    private function urlConverterYoutube($url) {
        parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
        $videoId = $queryParams['v'] ?? null;

        if ($videoId) {
            // Generate the embed link
            $embedLink = "https://www.youtube.com/embed/" . $videoId;
        } else {
            $embedLink = null;
        }

        return $embedLink;
    }

    public function destroy(TalentSpotlight $talentSpotlight) {
        try {
            $talentSpotlight->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(Talent $talent, object $talentSpotlight)
    {
        $array = $talent->talentSpotlights()->get(['id', 'url']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['url'] = $item->url;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.talents.talent_spotlight.edit', [$talent, $item]) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.talents.talent_spotlight.destroy', [$talent, $item]) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "image"])->toJson();
    }
}
