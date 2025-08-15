<?php

namespace App\Http\Controllers\Back\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Booking;
use App\Models\MasterData\TalentPrice;
use App\Services\Ecommerce\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        return view('back.e-commerce.schedule.index');
    }

    public function edit(Booking $schedule)
    {
        $prices = TalentPrice::whereIn('id', $schedule->prices)->get();

        return view('back.e-commerce.schedule.edit', compact('schedule', 'prices'));
    }

    public function update(Request $request, Booking $schedule)
    {
        $this->scheduleService->update($request, $schedule);

        return redirect()->route('admin.e-commerce.schedule.index')->with('success', 'Data Berhasil Diperbaharui');
    }

    public function data(Booking $booking)
    {
        return $this->scheduleService->data($booking);
    }
}
