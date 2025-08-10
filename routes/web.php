<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\JobServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\UpdateExpiredSubscriptions;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware([
    UpdateExpiredSubscriptions::class,
])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/login', function () {
        return redirect()->route('signin-page');
    })->name('login');
    Route::get('/sign-in', [AuthController::class, 'signin_page'])->name('signin-page');
    Route::post('/sign-in', [AuthController::class, 'signin'])->name('signin.post');
    Route::get('/sign-up', [AuthController::class, 'signup_page'])->name('signup-page');
    Route::get('/sign-up/staff', [AuthController::class, 'signup_page'])->name('signup-page-staff');
    Route::post('/sign-up', [AuthController::class, 'signup_user'])->name('signup-user.post');
    Route::post('/sign-up/staff', [AuthController::class, 'signup_staff'])->name('signup-staff.post');
    Route::get('/sign-out', [AuthController::class, 'signout'])->name('signout');
    Route::get('/forgot-password', [AuthController::class, 'forgot_password_page'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.post');

    Route::get('/province/{province}/get-regions', [ProvinceController::class, 'get_regions']);

    Route::middleware([
        Authenticate::class,
    ])->group(function () {
        Route::get('/dashboard', [AuthController::class, 'redirect_based_on_role'])->name('dashboard');
        Route::get('/account', [ProfileController::class, 'index'])->name('account');
        Route::post('/account/update-profile', [ProfileController::class, 'update_profile'])->name('account.update-profile');
        Route::post('/account/change-password', [ProfileController::class, 'change_password'])->name('account.change-password');
    });

    Route::middleware([
        Authenticate::class,
        RoleMiddleware::class . ':admin'
    ])->prefix('admin')->group(function () {
        Route::get('/', [UserController::class, 'admin_dashboard'])->name('admin.dashboard');

        Route::get('/manage-staffs', [UserController::class, 'admin_manage_staffs'])->name('admin.manage_staffs');
        Route::get('/manage-customers', [UserController::class, 'admin_manage_users'])->name('admin.manage_users');
        Route::post('/update-user-status', [UserController::class, 'admin_update_user_status'])->name('admin.update_user_status');
        
        Route::get('/service-bookings', [BookingController::class, 'index'])->name('admin.bookings');
        Route::get('/service-bookings/view/{booking}', [BookingController::class, 'view_booking'])->name('admin.bookings.view');

        Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces');
        Route::get('/provinces/create', [ProvinceController::class, 'create'])->name('provinces.create');
        Route::post('/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
        Route::get('/provinces/{province}/edit', [ProvinceController::class, 'edit'])->name('provinces.edit');
        Route::put('/provinces/{province}', [ProvinceController::class, 'update'])->name('provinces.update');
        Route::delete('/provinces/{province}', [ProvinceController::class, 'delete'])->name('provinces.delete');

        Route::get('/regions', [RegionController::class, 'index'])->name('regions');
        Route::get('/regions/create', [RegionController::class, 'create'])->name('regions.create');
        Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
        Route::get('/regions/{region}/edit', [RegionController::class, 'edit'])->name('regions.edit');
        Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
        Route::delete('/regions/{region}', [RegionController::class, 'delete'])->name('regions.delete');

        Route::get('/job-services', [JobServiceController::class, 'index'])->name('job_services');
        Route::get('/job-services/create', [JobServiceController::class, 'create'])->name('job_services.create');
        Route::post('/job-services', [JobServiceController::class, 'store'])->name('job_services.store');
        Route::get('/job-services/{jobservice}/edit', [JobServiceController::class, 'edit'])->name('job_services.edit');
        Route::put('/job-services/{jobservice}', [JobServiceController::class, 'update'])->name('job_services.update');
        Route::delete('/job-services/{jobservice}', [JobServiceController::class, 'delete'])->name('job_services.delete');

        Route::get('/complaints', [ComplaintController::class, 'index'])->name('admin.complaints');
        Route::get('/complaints/{complaint}/reply', [ComplaintController::class, 'show_reply_popup'])->name('complaint.reply');
        Route::put('/complaints/{complaint}/save-reply', [ComplaintController::class, 'save_complaint_reply'])->name('complaint.reply.save');
    });

    Route::middleware([
        Authenticate::class,
        RoleMiddleware::class . ':staff'
    ])->prefix('staff')->group(function () {
        Route::get('/', [UserController::class, 'staff_dashboard'])->name('staff.dashboard');
        Route::post('/renew-subscription', [UserController::class, 'renew_subscription'])->name('staff.renew_subscription');

        Route::get('/job-update', [JobServiceController::class, 'staff_update_job'])->name('staff.job_update');
        Route::put('/job-update', [JobServiceController::class, 'save_job_update'])->name('staff.save_job_update');
        Route::get('/job-update/get-staff-regions', [JobServiceController::class, 'get_staff_regions'])->name('staff.get_staff_regions');
        Route::put('/job-update/location', [JobServiceController::class, 'save_job_location_update'])->name('staff.save_job_location_update');

        Route::get('/service-bookings', [BookingController::class, 'index'])->name('staff.bookings');
        Route::put('/service-bookings/{booking}', [BookingController::class, 'staff_update_booking'])->name('staff.bookings.update');
        
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('staff.complaints');
        Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('staff.complaint.create');
        Route::post('/complaints', [ComplaintController::class, 'store'])->name('staff.complaint.store');
    });

    Route::middleware([
        Authenticate::class,
        RoleMiddleware::class . ':user'
    ])->prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'user_dashboard'])->name('user.dashboard');
        Route::get('/find', [BookingController::class, 'search'])->name('user.service.search');
        Route::get('/view-service/{user}', [BookingController::class, 'view_staff_service'])->name('user.view.service');
        Route::post('/book-service/{user}', [BookingController::class, 'book_staff_service'])->name('user.book.service');
        
        Route::get('/service-bookings', [BookingController::class, 'index'])->name('user.bookings');
        Route::put('/service-bookings/{booking}/cancel', [BookingController::class, 'user_cancel_booking'])->name('user.bookings.cancel');
        
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('user.complaints');
        Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('user.complaint.create');
        Route::post('/complaints', [ComplaintController::class, 'store'])->name('user.complaint.store');
    });
});