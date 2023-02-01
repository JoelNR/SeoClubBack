<?php

use App\Http\Controllers\CompetitionController;
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
use App\Http\Controllers\SetController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\TrainingController;

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
    Route::get('/profile/competition/{profile}', [ProfilesController::class, 'getProfileCompetition'])
                ->name('profile.getProfileCompetition');
    Route::get('/profile/competition/all/{profile}', [ProfilesController::class, 'getAllProfileCompetition'])
                ->name('profile.getAllProfileCompetition');
    Route::get('/profile/stats/{profile}', [ProfilesController::class, 'getProfileStats'])
                ->name('profile.getProfileStats');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth.session')
                ->name('logout');    
    Route::get('/news', [NewsController::class, 'index'])
                ->name('news.index');
    Route::get('/firstnews', [NewsController::class, 'first'])
                ->name('news.first');
    Route::get('/news/{news}', [NewsController::class, 'show'])
                ->name('news.show');
    Route::get('/initiation', [InitiationDateController::class, 'index'])
                ->name('initiationDate.index');
    Route::get('/initiation/{initiation_dates}', [InitiationDateController::class, 'show'])
                ->name('initiationDate.show');
    Route::put('/initiation/{initiation_dates}', [InitiationDateController::class, 'update'])
                ->name('initiationDate.update')
                ->middleware('auth.session');
    Route::get('/competition', [CompetitionController::class, 'index'])
                ->name('competition.index');
    Route::get('/competition/{competition}', [CompetitionController::class, 'show'])
                ->name('competition.show');
    Route::get('/target/{competition}', [CompetitionController::class, 'targetArchers'])
                ->name('competition.targetArchers')
                ->middleware('auth.session');
    Route::get('/records/{user}', [RecordController::class, 'profileRecords'])
                ->name('record.profileRecords');
    Route::get('/records', [RecordController::class, 'clubRecords'])
                ->name('record.clubRecords');
    Route::put('/competition/{competition}', [CompetitionController::class, 'update'])
                ->name('competition.update')
                ->middleware('auth.session'); 
    Route::put('/competition/points/{competition}', [CompetitionController::class, 'updatePoints'])
                ->name('competition.updatePoints')
                ->middleware('auth.session');                                     
    Route::put('/profile/update/{user}', [ProfilesController::class, 'update'])
                ->name('profile.update')
                ->middleware('auth.session');
    Route::post('/profile/photo/{user}', [ProfilesController::class, 'updatePhoto'])
                ->name('profile.updatePhoto')
                ->middleware('auth.session');
    Route::get('/set', [SetController::class, 'index'])
                ->name('set.index')
                ->middleware('auth.session');
    Route::get('/set/{set}', [SetController::class, 'show'])
                ->name('set.show')   
                ->middleware('auth.session');                             
    Route::put('/set/update/{set}', [SetController::class, 'update'])
                ->name('set.update')
                ->middleware('auth.session');
    Route::post('/set/create/{user}', [SetController::class, 'store'])
                ->name('set.store')
                ->middleware('auth.session');
    Route::post('/score/create/{user}', [ScoreController::class, 'store'])
                ->name('score.store')
                ->middleware('auth.session');
    Route::post('/round/create/{user}', [RoundController::class, 'store'])
                ->name('round.store')
                ->middleware('auth.session'); 
    Route::get('/round/{round}', [RoundController::class, 'showSet'])
                ->name('round.showSet')
                ->middleware('auth.session');
    Route::put('/round/{round}', [RoundController::class, 'update'])
                ->name('round.update')
                ->middleware('auth.session'); 
    Route::put('/score/{score}', [ScoreController::class, 'update'])
                ->name('score.update')
                ->middleware('auth.session');
    Route::get('/training/{user}', [TrainingController::class, 'index'])
                ->name('training.index')
                ->middleware('auth.session');        
    Route::post('/training/create/{user}', [TrainingController::class, 'store'])
                ->name('training.store')
                ->middleware('auth.session'); 
    Route::delete('/training/destroy/{training}', [TrainingController::class, 'destroy'])
                ->name('training.destroy')
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
