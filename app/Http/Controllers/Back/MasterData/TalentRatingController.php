<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateRatingTalentRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentRating;
use App\Models\Member;
use App\Services\MasterData\TalentRatingService;
use Illuminate\Http\Request;

class TalentRatingController extends Controller
{
    protected $talentRatingService;
    public function __construct(TalentRatingService $talentRatingService)
    {
        $this->talentRatingService = $talentRatingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-rating.index', compact('talent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Talent $talent)
    {
        $members = Member::get(['id', 'name']);

        return view('back.master-data.talent.components.talent-rating.create', compact('talent', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Talent $talent, UpdateRatingTalentRequest $updateTalentRatingRequest)
    {
        $this->talentRatingService->store($updateTalentRatingRequest, $talent);

        return redirect()->route('admin.master_data.talents.talent_rating.index', $talent)->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent, TalentRating $talentRating)
    {
        $members = Member::get(['id', 'name']);

        return view('back.master-data.talent.components.talent-rating.edit', compact('talent', 'talentRating', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Talent $talent, UpdateRatingTalentRequest $updateTalentRatingRequest, TalentRating $talentRating)
    {
        $this->talentRatingService->update($updateTalentRatingRequest, $talentRating);

        return redirect()->route('admin.master_data.talents.talent_rating.index', $talent)->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent, TalentRating $talentRating)
    {
        $this->talentRatingService->destroy($talentRating);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent, TalentRating $talentRating)
    {
        return $this->talentRatingService->data($talent, $talentRating);
    }
}
