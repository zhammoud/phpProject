<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('companies',[CompanyController::class,'getCompanies']);
Route::get('branches',[BranchController::class,'getBranches']);
Route::post('company_add',[CompanyController::class,'company_add']);
