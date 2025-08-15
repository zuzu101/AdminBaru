<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateTalentSpotlightRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentSpotlight;
use App\Services\MasterData\TalentSpotlightService;
use Illuminate\Http\Request;

class TalentSpotlightController extends Controller
{
    protected $talentSpotlightService;
    public function __construct(TalentSpotlightService $talentSpotlightService)
    {
        $this->talentSpotlightService = $talentSpotlightService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-spotlight.index', compact('talent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-spotlight.create', compact('talent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Talent $talent, UpdateTalentSpotlightRequest $updateTalentSpotlightRequest)
    {
        $this->talentSpotlightService->store( $updateTalentSpotlightRequest, $talent);

        if(request()->get('continous') == 1) {
            return redirect()->route('admin.master_data.talents.index', $talent)
                ->with('success', 'Data Berhasil Ditambahkan')
                ->with('continous', 1);
        } else {
            return redirect()->route('admin.master_data.talents.talent_spotlight.index', $talent)->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent, TalentSpotlight $talentSpotlight)
    {
        return view('back.master-data.talent.components.talent-spotlight.edit', compact('talentSpotlight', 'talent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Talent $talent, UpdateTalentSpotlightRequest $updateTalentSpotlightRequest, TalentSpotlight $talentSpotlight)
    {
        $this->talentSpotlightService->update($updateTalentSpotlightRequest, $talentSpotlight);

        return redirect()->route('admin.master_data.talents.talent_spotlight.index', $talent)->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent, TalentSpotlight $talentSpotlight)
    {
        $this->talentSpotlightService->destroy($talentSpotlight);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent, TalentSpotlight $talentSpotlight)
    {
        return $this->talentSpotlightService->data($talent, $talentSpotlight);
    }
}
