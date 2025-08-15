<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cms\NewsroomRequest;
use App\Models\Cms\Newsroom;
use App\Services\Cms\NewsroomService;
use Illuminate\Http\Request;

class NewsroomController extends Controller
{
    protected $newsRoomService;
    public function __construct(NewsroomService $newsRoomService)
    {
        $this->newsRoomService = $newsRoomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.cms.newsroom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.cms.newsroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsroomRequest $newsroomRequest)
    {
        $this->newsRoomService->store($newsroomRequest);

        return redirect()->route('admin.cms.newsrooms.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsroom $newsroom)
    {
        return view('back.cms.newsroom.edit', compact('newsroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsroomRequest $newsroomRequest, Newsroom $newsroom)
    {
        $this->newsRoomService->update($newsroomRequest, $newsroom);

        return redirect()->route('admin.cms.newsrooms.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsroom $newsroom)
    {
        $this->newsRoomService->destroy($newsroom);

        return response()->json(['message' => "Data berhasil dihapus"],200);
    }

    public function data(Newsroom $newsroom)
    {
        return $this->newsRoomService->data($newsroom);
    }
}
