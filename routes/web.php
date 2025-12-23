<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [UserManagementController::class, 'register'])->name('voter.register');
Route::post('/register/store', [UserManagementController::class, 'storeVoter'])->name('register.voter.store');

Route::middleware('auth')->prefix('voting')->group(function () {
    Route::get('/', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/store', [VoteController::class, 'store'])->name('vote.store');
});

// routes/web.php
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Route::resource('admin/candidates', CandidateController::class);
    Route::get('/admin/voters', [DashboardController::class, 'voterList'])->name('admin.voters');
    Route::patch('/admin/toggle-voting', [DashboardController::class, 'toggleVotingStatus'])->name('admin.toggle-voting');

    Route::prefix('admin/candidates')->name('candidate.')->group(function () {
        Route::get('/', [CandidateController::class, 'index'])->name('index');
        Route::get('/create', [CandidateController::class, 'create'])->name('create');
        Route::post('/store', [CandidateController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CandidateController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CandidateController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CandidateController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/user-management')->name('user-management.')->group(function () {
        Route::get('/admin', [UserManagementController::class, 'admin'])->name('admin');
        Route::get('/admin/create', [UserManagementController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [UserManagementController::class, 'storeAdmin'])->name('admin.store');
        Route::get('/voters', [UserManagementController::class, 'voters'])->name('voters');
        Route::get('/voters/create', [UserManagementController::class, 'createVoter'])->name('voters.create');
        Route::post('/voters/store', [UserManagementController::class, 'storeVoter'])->name('voters.store');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('edit');
        Route::get('/generate-password/{id}', [UserManagementController::class, 'generatePassword'])->name('generate-password');
        Route::get('/delete/{id}', [UserManagementController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/user-profile')->name('user-profile.')->group(function () {
        Route::get('/show/{id}', [UserProfileController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserProfileController::class, 'update'])->name('update');
    });
});
