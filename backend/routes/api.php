<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\MentorLoginController;
use App\Http\Controllers\Auth\MentorRegisterController;
use App\Http\Controllers\Auth\StaffRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Health Check
Route::get('/health', function (): void {});

// 認証制限なし
Route::post('/mentors/login', MentorLoginController::class)->name('mentor.login');
Route::post('/mentors/register', MentorRegisterController::class)->name('mentor.register');
Route::post('/staff/register', StaffRegisterController::class)->name('staff.register');

// 認証制限
Route::middleware('auth:sanctum')->group(function () {
    // テスト
    Route::get('/mentors', function (Request $request) {
        return response()->json([
            'data' => [
                'id' => $request->user()->id,
                'type' => 'mentors',
                'attributes' => [
                    'message' => 'Mentor Login Success!',
                    'mentor' => $request->user(),
                ],
            ],
        ], 200);
    });
});
