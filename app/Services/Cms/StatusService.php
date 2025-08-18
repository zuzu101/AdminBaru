<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Cms\StatusRequest;
use App\Models\Cms\Status;
use Yajra\DataTables\Facades\DataTables;

class StatusService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/Status/');
    }

    public function store(StatusRequest $request) {
        $request->validated();

        try {
            Status::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(StatusRequest $request, Status $status)
    {
        $request->validated();

        try {
            $status->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Status $status) {
        try {
            $status->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $deviceRepair)
    {
        $array = $deviceRepair->with('pelanggan')->get(['id', 'pelanggan_id', 'brand', 'model', 'reported_issue', 'serial_number', 'technician_note']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['pelanggan_name'] = $item->pelanggan ? $item->pelanggan->name : 'No Customer';
            $nestedData['brand'] = $item->brand;
            $nestedData['model'] = $item->model;
            $nestedData['reported_issue'] = $item->reported_issue;
            $nestedData['serial_number'] = $item->serial_number;
            $nestedData['technician_note'] = $item->technician_note ?: '-';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="' . route('admin.cms.DeviceRepair.edit', $item) . '" class="btn btn-outline-warning "><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" onclick="deleteDeviceRepair(' . $item->id . ')" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
