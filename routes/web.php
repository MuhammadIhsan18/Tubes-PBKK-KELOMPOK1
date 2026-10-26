<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AlatLabController;

Route::get('/', [AlatLabController::class, 'index'])->name('alatlab.index');
Route::get('/alatlab/create', [AlatLabController::class, 'create'])->name('alatlab.create');
Route::post('/alatlab', [AlatLabController::class, 'store'])->name('alatlab.store');
Route::get('/alatlab/{alatLab}/edit', [AlatLabController::class, 'edit'])->name('alatlab.edit');
Route::put('/alatlab/{alatLab}', [AlatLabController::class, 'update'])->name('alatlab.update');
Route::delete('/alatlab/{alatLab}', [AlatLabController::class, 'destroy'])->name('alatlab.destroy');