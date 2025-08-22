<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Http\Requests\Cms\PelangganRequest;
use App\Models\Cms\pelanggan;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PelangganService
{
    public function store(PelangganRequest $request) {
        $validatedData = $request->validated();

        try {
            pelanggan::create($validatedData);
        } catch (\Exception $e) {
            Log::error('Error storing pelanggan: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(PelangganRequest $request, pelanggan $pelanggan)
    {
        $validatedData = $request->validated();

        try {
            $pelanggan->update($validatedData);
        } catch (\Exception $e) {
            Log::error('Error updating pelanggan: ' . $e->getMessage());
            throw $e;
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
