<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\UpdateArtCategoryRequest;
use App\Models\MasterData\ArtCategory;
use App\Services\MasterData\ArtCategoryService;
use Illuminate\Http\Request;

class ArtCategoryController extends Controller
{
    protected $artCategoryService;
    public function __construct(ArtCategoryService $artCategoryService)
    {
        $this->artCategoryService = $artCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.master-data.art-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.master-data.art-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateArtCategoryRequest $updateArtCategoryRequest)
    {
        $this->artCategoryService->store($updateArtCategoryRequest);

        return redirect()->route('admin.master_data.art-categories.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ArtCategory $artCategory)
    {
        return view('back.master-data.art-category.edit', compact('artCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtCategoryRequest $updateArtCategoryRequest, ArtCategory $artCategory)
    {
        $this->artCategoryService->update($updateArtCategoryRequest, $artCategory);

        return redirect()->route('admin.master_data.art-categories.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtCategory $artCategory)
    {
        $this->artCategoryService->destroy($artCategory);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(ArtCategory $artCategory)
    {
        return $this->artCategoryService->data($artCategory);
    }
}
