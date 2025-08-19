<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\NewsRoomController as FrontNewsRoomController;
use App\Http\Controllers\Front\ContactController as FrontContactController;
use App\Http\Controllers\Auth\Member\RegisterController as MemberRegisterController;
use App\Http\Controllers\Auth\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Auth\Talent\RegisterController as TalentRegisterController;
use App\Http\Controllers\Auth\Talent\LoginController as TalentLoginController;
use App\Http\Controllers\Back\Cms\FounderController;
use App\Http\Controllers\Back\Cms\NewsroomController;
use App\Http\Controllers\Back\Cms\pelangganController;
use App\Http\Controllers\Back\Cms\DeviceRepairController;
use App\Http\Controllers\Back\Cms\StatusController;
use App\Http\Controllers\Back\Cms\NotaController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Member\HistoryBookingController as MemberHistoryBookingController;
use App\Http\Controllers\Talent\ScheduleController as TalentScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'front.'], function () {
    Route::get('/', FrontHomeController::class)->name('home');

    Route::resource('/newsrooms', FrontNewsRoomController::class)->only('index', 'show');

    Route::resource('/contacts', FrontContactController::class)->only('index', 'store');

    Route::resource('/directories', FrontDirectoryController::class)->only('index', 'show', 'store');

    Route::resource('/e-commerce/{talent}/booking', FrontBookingController::class )->only('index', 'store')->middleware('member');

    Route::post('/e-commerce/payment', [FrontPaymentController::class, 'createCharge'])->name('payment.create-charge')->middleware('member');
});

Route::group(['prefix' => 'talent', 'as' => 'talent.'], function () {
    Route::group(['as' => 'auth.'], function () {
        Route::resource('/registers', TalentRegisterController::class)->only('index', 'store');

        Route::get('/logins', [TalentLoginController::class, 'index'])->name('login.index');
        Route::post('/logins', [TalentLoginController::class, 'login'])->name('login.authentication');
        Route::post('/logout', [TalentLoginController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => ['talent']], function () {
        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
            Route::get('/', [TalentScheduleController::class, 'index'])->name('index');
            Route::get('/{id}', [TalentScheduleController::class, 'show'])->name('show');
            Route::post('/{id}/data', [TalentScheduleController::class, 'data'])->name('data');
        }) ;
    });
});

Route::group(['prefix' => 'member', 'as' => 'member.'], function () {
    Route::group(['as' => 'auth.'], function () {
        Route::resource('/registers', MemberRegisterController::class)->only('index', 'store');

        Route::get('/logins', [MemberLoginController::class, 'index'])->name('login.index');
        Route::post('/logins', [MemberLoginController::class, 'login'])->name('login.authentication');
        Route::post('/logout', [MemberLoginController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => ['member']], function () {
        Route::resource('/profiles', MemberProfileController::class)->only('index', 'update');

        Route::group(['prefix' => 'history-booking', 'as' => 'history_booking.'], function () {
            Route::get('/', [MemberHistoryBookingController::class, 'index'])->name('index');
            Route::get('/{booking}/show', [MemberHistoryBookingController::class, 'show'])->name('show');
            Route::post('/{member}/data', [MemberHistoryBookingController::class, 'data'])->name('data');
        });
    });

});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticate')->name('authenticate');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::group(['middleware' => ['auth:web']], function () {

        Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
            Route::resource('newsrooms', NewsroomController::class)->except('show');
            Route::group(['prefix' => 'newsrooms', 'as' => 'newsrooms.'], function () {
                Route::post('data', [NewsroomController::class, 'data'])->name('data');
            });

            Route::resource('founders', FounderController::class)->except('show');
            Route::group(['prefix' => 'founders', 'as' => 'founders.'], function () {
                Route::post('data', [FounderController::class, 'data'])->name('data');
            });

            Route::resource('pelanggan', pelangganController::class)->except('show');
            Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function () {
                Route::post('data', [pelangganController::class, 'data'])->name('data');
            });

            Route::resource('DeviceRepair', DeviceRepairController::class)->except('show')->parameters(['DeviceRepair' => 'deviceRepair']);
            Route::group(['prefix' => 'DeviceRepair', 'as' => 'DeviceRepair.'], function () {
                Route::post('data', [DeviceRepairController::class, 'data'])->name('data');
                Route::post('{deviceRepair}/update-status', [DeviceRepairController::class, 'updateDeviceRepairStatus'])->name('updateStatus');
            });

            Route::resource('Status', StatusController::class)->except('show')->parameters(['Status' => 'status']);
            Route::group(['prefix' => 'Status', 'as' => 'Status.'], function () {
                Route::post('data', [StatusController::class, 'data'])->name('data');
                Route::post('{status}/update-status', [StatusController::class, 'updateStatus'])->name('updateStatus');
            });

            Route::resource('Nota', NotaController::class)->only('index');
            Route::group(['prefix' => 'Nota', 'as' => 'Nota.'], function () {
                Route::post('data', [NotaController::class, 'data'])->name('data');
                Route::get('{id}/print', [NotaController::class, 'print'])->name('print');
                Route::get('{id}/pdf', [NotaController::class, 'pdf'])->name('pdf');
            });

        });

    });
});
