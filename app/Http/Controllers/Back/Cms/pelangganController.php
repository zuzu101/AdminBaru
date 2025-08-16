<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\UpdatepelangganRequest;
use App\Models\Cms\pelanggan;
use App\Services\Cms\pelangganService;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    protected $pelangganService;
    public function __construct(pelangganService $pelangganService)
    {
        $this->pelangganService = $pelangganService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdatepelangganRequest $pelangganRequest)
    {
        $this->pelangganService->store($pelangganRequest);

        return redirect()->route('admin.cms.pelanggan.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pelanggan $pelanggan)
    {
        return view('back.cms.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepelangganRequest $UpdatepelangganRequest, pelanggan $pelanggan)
    {
        $this->pelangganService->update($UpdatepelangganRequest, $pelanggan);

        return redirect()->route('admin.cms.pelanggan.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelanggan $pelanggan)
    {
        $this->pelangganService->destroy($pelanggan);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(pelanggan $pelanggan)
    {
        return $this->pelangganService->data($pelanggan);
    }
}
