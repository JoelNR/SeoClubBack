<?php

use App\Http\Controllers\InitiationDateController;
use App\Models\InitiationDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\NewsController;

Route::group(['middleware' => ['api','cors']], function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');
    Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');
    Route::get('/profiles', [ProfilesController::class, 'index'])
                ->name('profile.index');                
    Route::get('/profile/{user}', [ProfilesController::class, 'show'])
                ->name('profile.show');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth.session')
                ->name('logout');    
    Route::get('/news', [NewsController::class, 'index'])
                ->name('news.index');
    Route::get('/news/{news}', [NewsController::class, 'show'])
                ->name('news.show');
    Route::get('/initiation', [InitiationDateController::class, 'index'])
                ->name('initiationDate.index');
    Route::put('/initiation/{initiation}', [InitiationDateController::class, 'update'])
                ->name('initiationDate.update')
                ->middleware('auth.session');
    Route::put('/profile/update/{user}', [ProfilesController::class, 'update'])
                ->name('profile.update')
                ->middleware('auth.session');
    Route::post('/profile/photo/{user}', [ProfilesController::class, 'updatePhoto'])
                ->name('profile.updatePhoto')
                ->middleware('auth.session');

    });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();});
});



Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');
