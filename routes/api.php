<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VideoTestimoniesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WrittenTestimonyController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');



Route::group(['middleware' => ['auth:sanctum']], function () {

    // categories
    Route::get('/categories', [CategoryController::class,'index']);
    Route::get('/{cat}/video_testimonies', [CategoryController::class,'get_videos_in_categories']);
    Route::post('/categories/store',[CategoryController::class,'store']);
    Route::post('/categories/delete/{cat}',[CategoryController::class,'destroy']);


// video testimonies'
Route::get('/video_testimonies', [VideoTestimoniesController::class,'index']);

Route::post('/video_testimonies/store',[VideoTestimoniesController::class,'store']);
Route::post('/video_testimonies/delete/{cat}',[VideoTestimoniesController::class,'destroy']);
// show video category
Route::get('/video_cat/{id}', [VideoTestimoniesController::class,'showCategory']);

// show a single video testimony
Route::get('/video_testimony/{id}', [VideoTestimoniesController::class,'showVideo']);

// comments route

//get all comments
Route::get('/comments',[CommentController::class,'index']);
// add comments
Route::post('/comments/addComments',[CommentController::class,'addComments']);

//get all written testimonies
Route::get('/written_testimony',[WrittenTestimonyController::class,'index']);
// add written testimonies
Route::post('/addWrittenTestimony',[WrittenTestimonyController::class,'addWrittenTestimony']);

});









