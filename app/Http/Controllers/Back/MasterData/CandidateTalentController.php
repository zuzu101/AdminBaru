<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\ArtCategory;
use App\Models\MasterData\ProfessionalCategory;
use App\Models\MasterData\Talent;
use App\Services\MasterData\CandidateTalentService;
use Illuminate\Http\Request;

class CandidateTalentController extends Controller
{
    protected $candidateTalentService;
    public function __construct(CandidateTalentService $candidateTalentService)
    {
        $this->candidateTalentService = $candidateTalentService;
    }

    public function index()
    {
        return view('back.master-data.candidate-talent.index');
    }

    public function edit($id)
    {
        $talent = Talent::findOrFail($id);
        $professionalCategories = ProfessionalCategory::get(['id', 'name']);
        $artCategories = ArtCategory::get(['id', 'name']);

        return view('back.master-data.candidate-talent.edit', compact('talent', 'professionalCategories', 'artCategories'));
    }

    public function update(Request $request, $id)
    {
        $talent = Talent::findOrFail($id);

        $this->candidateTalentService->update($request, $talent);

        return redirect()->route('admin.master_data.candidate-talents.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    public function data(Talent $talent)
    {
        return $this->candidateTalentService->data($talent);
    }
}
