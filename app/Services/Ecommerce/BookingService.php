<?php

namespace App\Services\Ecommerce;

use App\Helpers\ErrorHandling;
use App\Helpers\ImageHelpers;
use App\Http\Requests\Ecommerce\UpdateBookingRequest;
use App\Models\Ecommerce\Booking;
use App\Models\MasterData\Talent;
use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingService
{
    protected $imageHelper;
    public function __construct()
    {
        $this->imageHelper = new ImageHelpers('back_assets/img/booking/receipts/');
    }

    public function store(UpdateBookingRequest $request, Talent $talent)
    {
        $request->validated();

        try {
            $booking = $talent->bookings()->create($request->only([
                'member_id',
                'date',
                'time',
                'duration',
                'prices',
                'total_payment',
            ]));

            $booking->bookingInformation()->create($request->only([
                'location',
                'type',
                'request'
            ]));

            $this->checkMemberEqual($request->member_id, $request, $booking);

        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    private function checkMemberEqual($memberId, UpdateBookingRequest $request, Booking $booking)
    {
        $member = Member::find($memberId)->only(['name', 'phone', 'email']);

        $requestedMember = $request->only([
          'name',
          'phone',
          'email',
        ]);

        if(count(array_diff_assoc($member, $requestedMember)) !== 0) {
            $booking->bookingContact()->create($requestedMember);
        }
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'receipt' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required',
            'total_payment' => 'required'
        ]);

        try {
            $booking->update(array_merge($request->all(), [
                'receipt' => $this->imageHelper->uploadImage($request, 'receipt')
            ]));
        } catch (\Exception $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $booking)
    {
        $array = $booking->select('id', 'code', 'talent_id', 'member_id', 'date', 'time', 'duration', 'is_paid')
                            ->with('talent:id,name', 'member:id,name')
                            ->where('is_paid', true)
                            ->where('has_content', true)
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
                    <a href="'. route('admin.e-commerce.booking.show', $item) .'" class="btn btn-outline-primary"><i class="fa fa-info"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "is_paid_label"])->toJson();
    }

    public function dataIsPaid(object $booking)
    {
        $array = $booking->select('id', 'code', 'talent_id', 'member_id', 'date', 'time', 'duration', 'is_paid')
                            ->with('talent:id,name', 'member:id,name')
                            ->where('is_paid', false)
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
                    <a href="'. route('admin.e-commerce.booking.edit', $item) .'" class="btn btn-outline-primary"><i class="fa fa-info"></i></a>
                </div>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["actions", "is_paid_label"])->toJson();
    }
}
