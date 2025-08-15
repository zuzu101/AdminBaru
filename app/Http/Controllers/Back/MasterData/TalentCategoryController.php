<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Category;
use App\Models\MasterData\Talent;
use App\Services\MasterData\TalentCategoryService;
use Illuminate\Http\Request;

class TalentCategoryController extends Controller
{

    protected $talentCategoryService;

    public function __construct(TalentCategoryService $talentCategoryService)
    {
        $this->talentCategoryService = $talentCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Talent $talent)
    {
        return view('back.master-data.talent.components.talent-category.index', compact('talent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Talent $talent)
    {
        $this->talentCategoryService->store($request, $talent);

        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Talent $talent)
    {
        $this->talentCategoryService->destroy($talent, $category);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Talent $talent)
    {
        return $this->talentCategoryService->data($talent);
    }

    public function getCategoriesByTalent(Talent $talent)
    {
        $categories = Category::whereDoesntHave('talents', function ($query) use ($talent) {
            $query->where('talents.id', $talent->id);
        })->get();

        return response()->json($categories);
    }
}
