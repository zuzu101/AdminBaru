<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\NewsRoomController as FrontNewsRoomController;
use App\Http\Controllers\Front\ContactController as FrontContactController;
use App\Http\Controllers\Front\DirectoryController as FrontDirectoryController;
use App\Http\Controllers\Front\Ecommerce\PaymentController as FrontPaymentController;
use App\Http\Controllers\Front\Ecommerce\BookingController as FrontBookingController;
use App\Http\Controllers\Auth\Member\RegisterController as MemberRegisterController;
use App\Http\Controllers\Auth\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Auth\Talent\RegisterController as TalentRegisterController;
use App\Http\Controllers\Auth\Talent\LoginController as TalentLoginController;
use App\Http\Controllers\Back\Cms\ContactController;
use App\Http\Controllers\Back\Cms\FounderController;
use App\Http\Controllers\Back\Cms\NewsroomController;
use App\Http\Controllers\Back\Cms\pelangganController;
use App\Http\Controllers\Back\Ecommerce\BookingController;
use App\Http\Controllers\Back\Ecommerce\ScheduleController;
use App\Http\Controllers\Back\MasterData\ArtCategoryController;
use App\Http\Controllers\Back\MasterData\CandidateTalentController;
use App\Http\Controllers\Back\MasterData\CategoryController;
use App\Http\Controllers\Back\MasterData\MemberController;
use App\Http\Controllers\Back\MasterData\ProfessionalCategoryController;
use App\Http\Controllers\Back\MasterData\TalentCategoryController;
use App\Http\Controllers\Back\MasterData\TalentController;
use App\Http\Controllers\Back\MasterData\TalentPhotoController;
use App\Http\Controllers\Back\MasterData\TalentPriceController;
use App\Http\Controllers\Back\MasterData\TalentRatingController;
use App\Http\Controllers\Back\MasterData\TalentSpotlightController;
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

            Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
                Route::get('contacts', [ContactController::class, 'index'])->name('index');
                Route::post('data', [ContactController::class, 'data'])->name('data');
            });

            Route::resource('pelanggan', pelangganController::class)->except('show');
            Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function () {
                Route::post('data', [pelangganController::class, 'data'])->name('data');
            });

        });

        Route::group(['prefix' => 'master_data', 'as' => 'master_data.'], function () {
            Route::group(['prefix' => 'talents', 'as' => 'talents.'], function () {
                Route::post('data', [TalentController::class, 'data'])->name('data');

                Route::group(['prefix' => '{talent}'], function () {
                    Route::resource('talent_categories', TalentCategoryController::class)->only('index', 'store', 'destroy');
                    Route::group(['prefix' => 'talent_categories', 'as' => 'talent_categories.'], function () {
                        Route::post('data', [TalentCategoryController::class, 'data'])->name('data');
                        Route::get('get-categories-by-talent', [TalentCategoryController::class, 'getCategoriesByTalent'])->name('get_categories_by_talent');
                    });

                    Route::resource('talent_photo', TalentPhotoController::class)->except('show');
                    Route::group(['prefix' => 'talent_photo', 'as' => 'talent_photo.'], function () {
                        Route::post('data', [TalentPhotoController::class, 'data'])->name('data');
                    });

                    Route::resource('talent_price', TalentPriceController::class)->except('show');
                    Route::group(['prefix' => 'talent_price', 'as' => 'talent_price.'], function () {
                        Route::post('data', [TalentPriceController::class, 'data'])->name('data');
                    });

                    Route::resource('talent_spotlight', TalentSpotlightController::class)->except('show');
                    Route::group(['prefix' => 'talent_spotlight', 'as' => 'talent_spotlight.'], function () {
                        Route::post('data', [TalentSpotlightController::class, 'data'])->name('data');
                    });

                    Route::resource('talent_rating', TalentRatingController::class)->except('show');
                    Route::group(['prefix' => 'talent_rating', 'as' => 'talent_rating.'], function () {
                        Route::post('data', [TalentRatingController::class, 'data'])->name('data');
                    });
                });
            });
            Route::resource('talents', TalentController::class);

            Route::resource('categories', CategoryController::class)->except('show');
            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
                Route::post('data', [CategoryController::class, 'data'])->name('data');
            });

            Route::resource('art-categories', ArtCategoryController::class)->except('show');
            Route::group(['prefix' => 'art-categories', 'as' => 'art-categories.'], function () {
                Route::post('data', [ArtCategoryController::class, 'data'])->name('data');
            });

            Route::resource('professional-categories', ProfessionalCategoryController::class)->except('show');
            Route::group(['prefix' => 'professional-categories', 'as' => 'professional-categories.'], function () {
                Route::post('data', [ProfessionalCategoryController::class, 'data'])->name('data');
            });

            Route::resource('candidate-talents', CandidateTalentController::class)->only('index', 'edit', 'update');
            Route::group(['prefix' => 'candidate-talents', 'as' => 'candidate-talents.'], function () {
                Route::post('data', [CandidateTalentController::class, 'data'])->name('data');
            });

            Route::resource('members', MemberController::class)->except('show');
            Route::group(['prefix' => 'members', 'as' => 'members.'], function () {
                Route::post('data', [MemberController::class, 'data'])->name('data');
            });
        });

        Route::group(['prefix' => 'e-commerce', 'as' => 'e-commerce.'], function () {
            Route::resource('booking', BookingController::class)->except('show');
            Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
                Route::get('{booking}/show', [BookingController::class, 'show'])->name('show');
                Route::post('data', [BookingController::class, 'data'])->name('data');
                Route::get('is-paid', [BookingController::class, 'indexIsPaid'])->name('is_paid');
                Route::post('is-paid/data', [BookingController::class, 'dataIsPaid'])->name('is_paid.data');
            });

            Route::resource('schedule', ScheduleController::class)->only('index', 'edit', 'update');
            Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
                Route::post('data', [ScheduleController::class, 'data'])->name('data');
            });
        });
    });
});
