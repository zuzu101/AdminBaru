<?php

namespace App\Http\Controllers\Back\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\UpdateBookingRequest;
use App\Models\Ecommerce\Booking;
use App\Models\MasterData\Talent;
use App\Models\MasterData\TalentPrice;
use App\Services\Ecommerce\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    protected $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.e-commerce.booking.index');
    }

    public function data(Booking $booking)
    {
        return $this->bookingService->data($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $prices = TalentPrice::whereIn('id', $booking->prices)->get();

        return view('back.e-commerce.booking.show', compact('booking', 'prices'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $talents = Talent::where('status', Talent::STATUS_APPROVED)->get();
        $prices = TalentPrice::whereIn('id', $booking->prices)->get();

        return view('back.e-commerce.booking.edit', compact('booking', 'prices', 'talents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $this->bookingService->update($request, $booking);

        return redirect()->route('admin.e-commerce.booking.is_paid')->with('success', 'Data Berhasil Diperbaharui');
    }

    public function indexIsPaid()
    {
        return view('back.e-commerce.booking.is-paid');
    }

    public function dataIsPaid(Booking $booking)
    {
        return $this->bookingService->dataIsPaid($booking);
    }
}
