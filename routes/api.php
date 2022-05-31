<?php
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\MarcacaoController;
use App\Http\Controllers\MarcacaoAlunoController;

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

Route::get('students', [ApiController::class ,'getAllStudents']);
Route::get('students/{id}',[ApiController::class,'getStudent']);
Route::post('students',[ApiController::class, 'createStudent']);
Route::put('updatestudents/{id}', [ApiController::class, 'updateStudent']);
Route::delete('students/{id}',[ApiController::class,'deleteStudent']);
Route::get('aluno', [AlunosController::class ,'getAllStudents']);
Route::get('getaluno/{id}',[AlunosController::class,'getStudent']);
Route::post('updatealuno/{id}', [AlunosController::class ,'updateStudent']);
Route::post('marcar', [MarcacaoController::class ,'createMarcacao']);
Route::get('getmarcacao', [MarcacaoAlunoController::class ,'index']);
Route::get('getmark/{id}', [MarcacaoAlunoController::class ,'getMark']);
Route::get('getnaomarcado/{tipo_marcacao}', [MarcacaoAlunoController::class ,'getNaoMarcado']);

Route::middleware('prefix:/api','auth:sanctum')->get('/user', function (Request $request) {
    
    return $request->user();
    
});



