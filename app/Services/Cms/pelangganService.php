<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Http\Requests\Cms\UpdatepelangganRequest;
use App\Models\Cms\pelanggan;
use Yajra\DataTables\Facades\DataTables;

class pelangganService
{
    public function store(UpdatepelangganRequest $request) {
        $request->validated();

        try {
            pelanggan::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(UpdatepelangganRequest $request, pelanggan $pelanggan)
    {
        $request->validated();

        try {
            $pelanggan->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(pelanggan $pelanggan) {
        try {
            $pelanggan->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function detail($id)
    {
        return pelanggan::findOrFail($id);
    }

    public function data()
    {
        $pelanggan = pelanggan::query()->orderBy('id', 'desc');

        return DataTables::of($pelanggan)
            ->addIndexColumn()
            ->addColumn('no', function($row) {
                static $no = 0;
                return ++$no;
            })
            ->addColumn('status', function($row) {
                return $row->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->addColumn('actions', function($row) {
                return '
                    <div class="btn-group">
                        <a href="' . route('admin.cms.pelanggan.edit', $row->id) . '" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <button onclick="deletePelanggan(' . $row->id . ')" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }
}
