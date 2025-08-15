<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateTalentPhotoRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentPhoto;
use App\Services\MasterData\TalentPhotoService;

class TalentPhotoController extends Controller
{
    protected $talentPhotoService;
    public function __construct(TalentPhotoService $talentPhotoService)
    {
        $this->talentPhotoService = $talentPhotoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-photo.index', compact('talent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-photo.create', compact('talent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Talent $talent, UpdateTalentPhotoRequest $updateTalentPhotoRequest)
    {
        $this->talentPhotoService->store($updateTalentPhotoRequest, $talent);

        if(request()->get('continous') == 1) {
            return redirect()->route('admin.master_data.talents.talent_spotlight.create', $talent)
                ->with('success', 'Data Berhasil Ditambahkan')
                ->with('continous', 1);
        } else {
            return redirect()->route('admin.master_data.talents.talent_photo.index', $talent)->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent, TalentPhoto $talentPhoto)
    {
        return view('back.master-data.talent.components.talent-photo.edit', compact('talentPhoto', 'talent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Talent $talent, UpdateTalentPhotoRequest $updateTalentPhotoRequest, TalentPhoto $talentPhoto)
    {
        $this->talentPhotoService->update( $updateTalentPhotoRequest, $talentPhoto);

        return redirect()->route('admin.master_data.talents.talent_photo.index', $talent)->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent, TalentPhoto $talentPhoto)
    {
        $this->talentPhotoService->destroy($talentPhoto);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent, TalentPhoto $talentPhoto)
    {
        return $this->talentPhotoService->data($talent, $talent->talentPhotos());
    }
}
