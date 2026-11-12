<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
Route::get('/',[ProjectController::class,'index'])->name('home');
Route::post('/projects',[ProjectController::class,'store'])->name('projects.store');
Route::post('/projects/{project}/changes',[ProjectController::class,'change'])->name('changes.store');
Route::patch('/changes/{change}',[ProjectController::class,'decide'])->name('changes.decide');
