<?php

namespace App\Services\Ecommerce;

use App\Helpers\ErrorHandling;
use App\Models\Ecommerce\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ScheduleService
{
    public function update(Request $request, Booking $schedule)
    {
        try {
            $schedule->update($request->all());
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $booking)
    {
        $array = $booking->select('id', 'code', 'talent_id', 'member_id', 'date', 'time', 'duration', 'is_paid')
                            ->with('talent:id,name', 'member:id,name')
                            ->where('is_paid', true)
                            ->where('has_content', false)
                            ->get();

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['code'] = $item->code;
            $nestedData['created_at_format'] = $item->created_at_format ?? '';
            $nestedData['member_name'] = $item->member->name ?? '';
            $nestedData['talent_name'] = $item->talent->name ?? '';
            $nestedData['date_format'] = $item->date_format;
            $nestedData['duration_total'] = $item->duration_total;
            $nestedData['is_paid_label'] = $item->is_paid_label;
            $nestedData['actions'] = '
                <div class="btn-group">
                    <a href="'. route('admin.e-commerce.schedule.edit', ['schedule' => $item]) .'" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "is_paid_label"])->toJson();
    }
}
