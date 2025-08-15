<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\UpdateFounderRequest;
use App\Models\Cms\Founder;
use App\Services\Cms\FounderService;
use Illuminate\Http\Request;

class FounderController extends Controller
{
    protected $founderService;
    public function __construct(FounderService $founderService)
    {
        $this->founderService = $founderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.founder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.founder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateFounderRequest $updateFounderRequest)
    {
        $this->founderService->store($updateFounderRequest);

        return redirect()->route('admin.cms.founders.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Founder $founder)
    {
        return view('back.cms.founder.edit', compact('founder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFounderRequest $UpdateFounderRequest, Founder $founder)
    {
        $this->founderService->update($UpdateFounderRequest, $founder);

        return redirect()->route('admin.cms.founders.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Founder $founder)
    {
        $this->founderService->destroy($founder);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Founder $founder)
    {
        return $this->founderService->data($founder);
    }
}
