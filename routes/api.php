<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// define controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HardSkillController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SoftSkillController;
use App\Http\Controllers\SocialController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::get('user', [AuthController::class, 'user']);

Route::middleware('auth:api')->group(function () {
  Route::get('logout', [AuthController::class, 'logout']);
  Route::resource('contacts', ContactController::class)->except('index', 'show');
  Route::resource('projects', ProjectController::class)->except('index', 'show');
  Route::resource('soft-skills', SoftSkillController::class)->except('index', 'show');
  Route::resource('socials', SocialController::class)->except('index', 'show');
});
Route::resource('hard-skills', HardSkillController::class)->except('index', 'show');

Route::get('contacts', [ContactController::class, 'index']);
Route::get('contacts/{contact}', [ContactController::class, 'show']);

Route::get('hard-skills', [HardSkillController::class, 'index']);
Route::get('hard-skills/{hard_skill}', [HardSkillController::class, 'show']);

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{project}', [ProjectController::class, 'show']);

Route::get('soft-skills', [SoftSkillController::class, 'index']);
Route::get('soft-skills/{soft_skill}', [SoftSkillController::class, 'show']);

Route::get('socials', [SocialController::class, 'index']);
Route::get('socials/{social}', [SocialController::class, 'show']);

