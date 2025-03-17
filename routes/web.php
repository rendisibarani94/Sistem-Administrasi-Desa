<?php

use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukCreateController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukEditController;
use App\Livewire\Admin\Master\DusunController;
use App\Livewire\Admin\Master\PekerjaanController;
use Illuminate\Support\Facades\Route;

Route::get('/induk-penduduk/{nik}/edit', IndukPendudukEditController::class)
    ->name('indukPenduduk.edit');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pekerjaan', PekerjaanController::class)->name('pekerjaan');
Route::get('/dusun',DusunController::class)->name('dusun');
Route::get('/induk-penduduk',IndukPendudukController::class)->name('indukPenduduk');
Route::get('/induk-penduduk/create',IndukPendudukCreateController::class)->name('indukPenduduk.create');
Route::get('/induk-penduduk/{id}/edit', IndukPendudukEditController::class)->name('indukPenduduk.edit');
