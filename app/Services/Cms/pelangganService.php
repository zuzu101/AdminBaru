<?php

namespace App\Services\MasterData;

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

    public function data(object $pelanggan)
    {
        $array = $pelanggan->get(['id', 'name' , 'phone', 'email', 'address']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['phone'] = $item->phone;
            $nestedData['email'] = $item->email;
            $nestedData['address'] = $item->address;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.master_data.pelanggan.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="' . route('admin.master_data.pelanggan.destroy', $item) . '" class="btn btn-outline-danger btn-delete"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
