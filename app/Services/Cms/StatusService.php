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

    public function data(object $status, $request = null)
    {
        $query = $status->with('pelanggan')->orderBy('id', 'desc');
        
        // Apply status filter if provided
        if ($request && $request->has('status_filter') && $request->status_filter != '') {
            $query->where('status', $request->status_filter);
        }
        
        $array = $query->get(['id', 'pelanggan_id', 'brand', 'model', 'reported_issue', 'serial_number', 'technician_note', 'status']);

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
            $nestedData['status'] = $item->status ?: 'Perangkat Baru Masuk';
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="javascript:void(0)" onclick="updateStatus(' . $item->id . ', \'Sedang Diperbaiki\')" class="btn btn-outline-info"><i class="fa fa-cog"></i></a>
                    <a href="javascript:void(0)" onclick="updateStatus(' . $item->id . ', \'Selesai\')" class="btn btn-outline-success"><i class="fa fa-check"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
