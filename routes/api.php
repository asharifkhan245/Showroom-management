<?php

use App\Http\Controllers\AdminController;
use App\Models\Admin;
use App\Models\Role;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/** Admin routes **/


Route::post('/login', [AdminController::class, 'login']);
Route::post('/forgot-password', [AdminController::class, 'forget_password'])->middleware('auth:api');
Route::post('/reset-password/{id}', [AdminController::class, 'reset_password'])->middleware('auth:api');
Route::post('/edit-admin/{id}', [AdminController::class, 'edit_admin'])->middleware('auth:api');


/** Role privileges routes **/
Route::post('/create-role', [AdminController::class, 'create_role'])->middleware('auth:api');
Route::post('/edit-role/{id}', [AdminController::class, 'edit_role'])->middleware('auth:api');
Route::get('/get-roles', [AdminController::class, 'get_roles'])->middleware('auth:api');
Route::post('/delete-role/{id}', [AdminController::class,'delete_role'])->middleware('auth:api');

/** Sub admin routes **/
Route::post('/create-sub-admin', [AdminController::class, 'create_sub_admin'])->middleware('auth:api');
Route::post('/edit-sub-admin/{id}', [AdminController::class, 'edit_sub_admin'])->middleware('auth:api');
Route::post('/delete-sub-admin/{id}', [AdminController::class, 'delete_sub_admin'])->middleware('auth:api');
Route::get('/get-subadmins', [AdminController::class, 'get_sub_admins'])->middleware('auth:api');

/** Employee routes **/
Route::post('/create-employee', [AdminController::class, 'create_employee'])->middleware('auth:api');
Route::post('/edit-employee/{id}', [AdminController::class, 'edit_employee'])->middleware('auth:api');
Route::post('/delete-employee/{id}', [AdminController::class, 'delete_employee'])->middleware('auth:api');
Route::get('/get-employees', [AdminController::class, 'get_employees'])->middleware('auth:api');

/** Cars routes */
Route::post('/create-car', [AdminController::class, 'create_car'])->middleware('auth:api');
Route::post('/edit-car/{id}', [AdminController::class, 'edit_car'])->middleware('auth:api');
Route::post('/delete-car/{id}', [AdminController::class, 'delete_car'])->middleware('auth:api');
Route::get('/get-cars', [AdminController::class, 'get_cars']);
Route::get('/get-single-car/{id}', [AdminController::class, 'get_single_car']);

/** Car management routes **/
Route::get('/show-car-code/{id}', [AdminController::class, 'show_car_code']);
Route::post('/mark-car/{id}', [AdminController::class, 'mark_car'])->middleware('auth:api');
Route::post('/delete-feature/{car_id}/{id}', [AdminController::class, 'delete_feature'])->middleware('auth:api');
Route::post('/edit-feature/{car_id}/{id}', [AdminController::class, 'edit_feature'])->middleware('auth:api');

/** Expenses routes **/
Route::post('/create-expense', [AdminController::class, 'create_expense'])->middleware('auth:api');
Route::post('/edit-expense/{id}', [AdminController::class, 'edit_expense'])->middleware('auth:api');
Route::post('/delete-expense/{id}', [AdminController::class, 'delete_expense'])->middleware('auth:api');
Route::get('/get-expenses', [AdminController::class, 'get_expenses']);

/** Appointments routes **/
Route::post('/create-appointment', [AdminController::class, 'create_appointment']);
Route::post('/edit-appointment/{id}', [AdminController::class, 'edit_appointment']);
Route::post('/delete-appointment/{id}', [AdminController::class, 'delete_appointment']);
Route::get('/get-appointments', [AdminController::class, 'get_appointments']);
Route::post('/approved-appointment/{id}', [AdminController::class, 'approved_appointment'])->middleware('auth:api');

/** Analytics routes **/
Route::get('/get-analytics', [AdminController::class, 'get_analytics']);

/** attendance routes **/
Route::get('/show-attendance-qrcode', [AdminController::class, 'generateQrCode']);
Route::post('/mark-attendance', [AdminController::class, 'markAttendance']);
Route::post('/get-attendances', [AdminController::class, 'getAttendances']);
Route::post('/edit-attendances/{id}', [AdminController::class, 'editAttendances'])->middleware('auth:api');
