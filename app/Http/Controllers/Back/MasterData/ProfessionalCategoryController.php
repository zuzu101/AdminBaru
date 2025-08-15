<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateProfessionalCategoryRequest;
use App\Models\MasterData\ProfessionalCategory;
use App\Services\MasterData\ProfessionalCategoryService;
use Illuminate\Http\Request;

class ProfessionalCategoryController extends Controller
{
    protected $professionalCategoryService;
    public function __construct(ProfessionalCategoryService $professionalCategoryService)
    {
        $this->professionalCategoryService = $professionalCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.master-data.professional-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.master-data.professional-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateProfessionalCategoryRequest $updateProfessionalCategoryRequest)
    {
        $this->professionalCategoryService->store($updateProfessionalCategoryRequest);

        return redirect()->route('admin.master_data.professional-categories.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalCategory $professionalCategory)
    {
        return view('back.master-data.professional-category.edit', compact('professionalCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessionalCategoryRequest $updateProfessionalCategoryRequest, ProfessionalCategory $professionalCategory)
    {
        $this->professionalCategoryService->update($updateProfessionalCategoryRequest, $professionalCategory);

        return redirect()->route('admin.master_data.professional-categories.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalCategory $professionalCategory)
    {
        $this->professionalCategoryService->destroy($professionalCategory);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(ProfessionalCategory $professionalCategory)
    {
        return $this->professionalCategoryService->data($professionalCategory);
    }
}
