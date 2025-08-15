<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Auth\Talent\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateTalentRequest;
use App\Models\MasterData\ArtCategory;
use App\Models\MasterData\ProfessionalCategory;
use App\Models\MasterData\Talent;
use App\Services\MasterData\TalentService;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    protected $talentService;
    public function __construct(TalentService $talentService)
    {
        $this->talentService = $talentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.master-data.talent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professionalCategories = ProfessionalCategory::get(['id', 'name']);
        $artCategories = ArtCategory::get(['id', 'name']);

        return view('back.master-data.talent.create', compact('professionalCategories', 'artCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registerController = new RegisterController();

        $talent = $registerController->storeTalent($request);
        $registerController->storeTalentArt($request, $talent);
        $registerController->storeTalentContent($request, $talent);
        $registerController->storeTalentProfessional($request, $talent);
        $registerController->storeTalentEducation($request, $talent);
        $registerController->storeTalentWorkExperience($request, $talent);
        $registerController->storeTalentPhoto($request, $talent);
        $registerController->storeTalentExperience($request, $talent);
        $registerController->storeTalentPortofolio($request, $talent);
        $registerController->storeTalentRate($request, $talent);

        return redirect()->route('admin.master_data.talents.talent_price.create', $talent)
            ->with('success', 'Data Berhasil Ditambahkan')
            ->with('continous', 1);
    }

    public function show(Talent $talent)
    {
        $professionalCategories = ProfessionalCategory::get(['id', 'name']);
        $artCategories = ArtCategory::get(['id', 'name']);

        return view('back.master-data.talent.components.talent-profile.index', compact('talent', 'professionalCategories', 'artCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talent $talent)
    {
        $this->talentService->update($request, $talent);

        return redirect()->route('admin.master_data.talents.show', $talent)->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talent $talent)
    {
        $this->talentService->destroy($talent);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent)
    {
        return $this->talentService->data($talent);
    }
}
