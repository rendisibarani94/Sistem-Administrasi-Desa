<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('master');
})->name('asu');

Route::get('/kanban', function () {
    return view('kanban');
})->name('asi');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/invoice', function () {
    return view('invoice');
})->name('invoice');