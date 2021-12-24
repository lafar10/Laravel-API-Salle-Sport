<?php

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardAController;


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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//  Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Store Message

Route::post('store-message', [MessageController::class, 'store']);

Route::middleware(['auth:sanctum', 'checkingAuth'])->group(function () {

    Route::get('checking-authentication', function () {

        return response()->json([
            'status' => 200,
            'message' => 'You Are In ^-^',
        ]);
    });

    //  Messages

    Route::get('show-message', [MessageController::class, 'show']);
    Route::delete('delete-message/{id}', [MessageController::class, 'delete']);

    // Members

    Route::get('show-member', [MemberController::class, 'show']);
    Route::post('store-member', [MemberController::class, 'store']);
    Route::get('edit-member/{id}', [MemberController::class, 'edit']);
    Route::put('update-member/{id}', [MemberController::class, 'update']);
    Route::delete('delete-member/{id}', [MemberController::class, 'delete']);

    // Factures

    Route::get('show-facture', [FactureController::class, 'show']);
    Route::post('store-facture', [FactureController::class, 'store']);
    Route::get('edit-facture/{id}', [FactureController::class, 'edit']);
    Route::put('update-facture/{id}', [FactureController::class, 'update']);
    Route::delete('delete-facture/{id}', [FactureController::class, 'delete']);
    Route::get('show-members-ids', [FactureController::class, 'get_members_id']);
    Route::get('facture-PDF/{id}', [FactureController::class, 'pdf']);

    // Users

    Route::get('show-user', [UserController::class, 'show']);
    Route::get('edit-user/{id}', [UserController::class, 'edit']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::delete('delete-user/{id}', [UserController::class, 'delete']);

    // Dashboard

    Route::get('sum-user', [DashboardAController::class, 'sum_user']);
    Route::get('sum-member', [DashboardAController::class, 'sum_member']);
    Route::get('sum-facture', [DashboardAController::class, 'sum_facture']);
    Route::get('total-earn', [DashboardAController::class, 'total_earn']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('profile-user/{id}', [UserController::class, 'profile']);
    Route::put('update-user-user/{id}', [UserController::class, 'update_profile']);

    Route::post('logout', [AuthController::class, 'logout']);
});
