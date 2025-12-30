<?php

use App\Actions\Auth\EmailVerificationNotificationAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\NewPasswordAction;
use App\Actions\Auth\PasswordResetLinkAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\VerifyEmailAction;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterAction::class)
    ->middleware('guest')
    ->name('register');

Route::post('/login', LoginAction::class)
    ->middleware('guest')
    ->name('login');

Route::post('/forgot-password', PasswordResetLinkAction::class)
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', NewPasswordAction::class)
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailAction::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', EmailVerificationNotificationAction::class)
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', LogoutAction::class)
    ->middleware('auth')
    ->name('logout');
