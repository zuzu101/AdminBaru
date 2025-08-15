<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateTalentPriceRequest;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentPrice;
use App\Services\MasterData\TalentPriceService;
use Illuminate\Http\Request;

class TalentPriceController extends Controller
{
    protected $talentPriceService;
    public function __construct(TalentPriceService $talentPriceService)
    {
        $this->talentPriceService = $talentPriceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-price.index', compact('talent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-price.create', compact('talent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Talent $talent, UpdateTalentPriceRequest $updateTalentPriceRequest)
    {
        $this->talentPriceService->store($updateTalentPriceRequest, $talent);

        if(request()->get('continous') == 1) {
            return redirect()->route('admin.master_data.talents.talent_photo.create', $talent)
                ->with('success', 'Data Berhasil Ditambahkan')
                ->with('continous', 1);
        } else {
            return redirect()->route('admin.master_data.talents.talent_price.index', $talent)->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talent $talent, TalentPrice $talentPrice)
    {
        return view('back.master-data.talent.components.talent-price.edit', compact('talent', 'talentPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Talent $talent, UpdateTalentPriceRequest $updateTalentPriceRequest, TalentPrice $talentPrice)
    {
        $this->talentPriceService->update($updateTalentPriceRequest, $talentPrice);

        return redirect()->route('admin.master_data.talents.talent_price.index', $talent)->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent, TalentPrice $talentPrice)
    {
        $this->talentPriceService->destroy($talentPrice);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent, TalentPrice $talentPrice)
    {
        return $this->talentPriceService->data($talent, $talentPrice);
    }
}
