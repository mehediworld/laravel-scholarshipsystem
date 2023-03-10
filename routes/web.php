<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DynamicDropdownController;
use App\Http\Controllers\ListingApplicantController;
use App\Http\Controllers\RejectedApplicantController;
use App\Http\Controllers\QualifiedApplicantController;
use App\Http\Controllers\ScholarshipApplicationController;
use App\Http\Controllers\ChangesController;
use App\Http\Controllers\ForgotPasswordController;

Route::controller(UserController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/signup', 'signup')->middleware('guest')->name('signup');
    Route::post('/users', 'create')->middleware('guest');
    Route::post('authenticate', 'login')->name('login')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(ForgotPasswordController::class)->group(function(){
    Route::get('/forgot/password', 'create')->name('forgot-password')->middleware('guest');
    Route::post('/forgot/password/send', 'store')->name('forgot-password-send')->middleware('guest');
    Route::get('/forgot/password/change', 'show')->name('forgot-password-change')->middleware('guest');
    Route::put('/forgot/password/update', 'update')->name('forgot-password-update')->middleware('guest');
});

Route::get('activity', [ActivityController::class, 'index']);
Route::get('activity/{activity:slug}', [ActivityController::class, 'show']);

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'coordinator'], function(){

            Route::controller(CoordinatorController::class)->group(function(){
                Route::get('/home', 'home')->name('home');
                Route::get('/report', 'report')->name('report');
                Route::get('/applications', 'application')->name('applications');
            });

            Route::post('/report/export', [ExportDataController::class, 'show']);

            Route::controller(ScholarshipApplicationController::class)->group(function(){
                Route::get('/applications/create','create');
                Route::post('/applications/create','store');
                Route::get('/applications/{application}/edit','edit');
                Route::patch('/applications/{application}/details','updateDetails');
                Route::patch('/applications/{application}/files','updateFiles');
            });

            Route::controller(QualifiedApplicantController::class)->group(function(){
                Route::get('/qualified', 'index')->name('qualified');
                Route::get('/qualified/{application}','show');
            });

            Route::controller(RejectedApplicantController::class)->group(function(){
                Route::get('/rejected','index')->name('rejected');
                Route::get('/rejected/{application}','show');
            });

            Route::controller(NotificationController::class)->group(function(){
                Route::post('/applicants/qualified/message/{application}', 'storeQualified');
                Route::post('/applicants/rejected/message/{application}','storeRejected');
            });

            Route::get('/applications/{application}/submissions', [SubmissionController::class, 'show']);
            Route::get('/applicant/evaluation/{applicantlist}', [ListingApplicantController::class, 'index']);
            Route::post('/applicants/{application}', [ListingApplicantController::class, 'store']);

            Route::post('/activity', [ActivityController::class, 'store']);
            Route::post('/scholar', [ScholarController::class, 'store']);
            Route::get('/changes', [ChangesController::class, 'index'])->name('changes');
            Route::put('/changes/income', [ChangesController::class, 'updateIncome']);
            Route::post('/changes/course', [ChangesController::class, 'store']);

    });

    Route::controller(DynamicDropdownController::class)->group(function(){
        // Fetch Method of Address Dynamic Dependent
        Route::post('/applicantcontroller/fetchAddress', 'fetchAddress')
        ->name('dynamicdropdowncontroller.fetchAddress');
        // Fetch Method of School Courses Dynamic Dependent
        Route::post('/applicantcontroller/fetch', 'fetch')
        ->name('dynamicdropdowncontroller.fetch');
    });

    Route::group(['middleware' => 'applicant'], function() {

        Route::controller(ApplicantController::class)->group(function(){
            Route::get('/profile', 'index')->name('profile');
            Route::put('/profile/{applicant}', 'update');
            Route::put('/profile/{applicant}/contact', 'updateContact');
        });


        Route::controller(ApplicationController::class)->group(function(){
            Route::get('/apply', 'index')->name('apply');
            Route::post('/apply/{application}', 'store');
        });

        Route::get('/notifications/{notification}', [NotificationController::class, 'show'])
            ->name('notification');

        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

    });

});





