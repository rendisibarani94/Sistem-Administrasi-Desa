<?php

use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukCreate;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukController;
use App\Livewire\Admin\Master\CounterController;
use App\Livewire\Admin\Master\DusunController;
use App\Livewire\Admin\Master\PekerjaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pekerjaan', PekerjaanController::class)->name('pekerjaan');
Route::get('/dusun',DusunController::class)->name('dusun');
Route::get('/induk-penduduk',IndukPendudukController::class)->name('indukPenduduk');
Route::get('/induk-penduduk/create',IndukPendudukCreate::class)->name('indukPenduduk.create');
