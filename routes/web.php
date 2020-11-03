<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\AlunoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cursos', CursoController::class);
Route::get('cursos/{curso}/disciplina', [CursoController::class, 'disciplina'])->name('cursos.disciplina');
Route::post('cursos/{curso}/disciplina', [CursoController::class, 'assignDisciplina'])->name('cursos.assignDisciplina');
Route::resource('disciplinas', DisciplinaController::class);
Route::resource('alunos', AlunoController::class);
Route::get('alunos/{aluno}/disciplina', [AlunoController::class, 'disciplina'])->name('alunos.disciplina');
Route::post('alunos/{aluno}/disciplina', [AlunoController::class, 'assignDisciplina'])->name('alunos.assignDisciplina');
Route::delete('alunos/{aluno}/disciplina/{disciplina}/remove', [AlunoController::class, 'removeDisciplina'])->name('alunos.removeDisciplina');
