<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Cms\TransactionRequest;
use App\Models\Cms\Transaction;
use Yajra\DataTables\Facades\DataTables;

class TransactionService
{
    protected $imageHelper;
    public function __construct() {
        $this->imageHelper = new ImageHelpers('back_assets/img/cms/Transaction/');
    }

    public function store(TransactionRequest $request) {
        $request->validated();

        try {
            Transaction::create($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $request->validated();

        try {
            $transaction->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function destroy(Transaction $transaction) {
        try {
            $transaction->delete();
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data()
    {
        $array = \App\Models\Cms\DeviceRepair::with('pelanggan')->orderBy('id', 'desc')->get();

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            //transaction table with no input or button
            $nestedData['no'] = ++$no;
            $nestedData['nota'] = $item->nota_number ?: '-';
            $nestedData['pelanggan_name'] = $item->pelanggan ? $item->pelanggan->name : 'No Customer';
            $nestedData['email'] = $item->pelanggan ? $item->pelanggan->email : '-';
            $nestedData['phone'] = $item->pelanggan ? $item->pelanggan->phone : '-';
            $nestedData['address'] = $item->pelanggan ? $item->pelanggan->address : '-';
            $nestedData['brand'] = $item->brand ?: '-';
            $nestedData['model'] = $item->model ?: '-';
            $nestedData['reported_issue'] = $item->reported_issue ?: '-';
            $nestedData['serial_number'] = $item->serial_number ?: '-';
            $nestedData['technician_note'] = $item->technician_note ?: '-';
            $nestedData['status'] = $item->status ?: 'Perangkat Baru Masuk';
            $nestedData['price'] = $item->price ? 'Rp ' . number_format((float)$item->price, 0, ',', '.') : '-';
            $nestedData['created_at'] = $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-';
            $nestedData['complete_in'] = $item->complete_in ? \Carbon\Carbon::parse($item->complete_in)->format('d/m/Y') : '-';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions"])->toJson();
    }
}
