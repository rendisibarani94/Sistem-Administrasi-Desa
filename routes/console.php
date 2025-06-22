<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    DB::table('aparatur_desa')
        ->where('is_active', true)
        ->where('tanggal_pemberhentian', '<', now())
        ->update(['is_active' => false]);
})->daily();
