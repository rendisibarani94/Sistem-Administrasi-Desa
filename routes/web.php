<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Master\DusunController;
use App\Livewire\Admin\Master\JabatanController;
use App\Livewire\Admin\Master\PekerjaanController;
use App\Livewire\Admin\Master\KelasTanahController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukController;
use App\Livewire\Admin\Kependudukan\KartuKeluarga\KartuKeluargaController;
use App\Livewire\Admin\AdministrasiUmum\PeraturanDesa\PeraturanDesaController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukEditController;
use App\Livewire\Admin\Kependudukan\KartuKeluarga\KartuKeluargaEditController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukCreateController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukPindahController;
use App\Livewire\Admin\Kependudukan\KartuKeluarga\KartuKeluargaCreateController;
use App\Livewire\Admin\AdministrasiUmum\PeraturanDesa\PeraturanDesaEditController;
use App\Livewire\Admin\Kependudukan\PendudukSementara\PendudukSementaraController;
use App\Livewire\Admin\AdministrasiUmum\PeraturanDesa\PeraturanDesaCreateController;
use App\Livewire\Admin\Kependudukan\PendudukSementara\PendudukSementaraEditController;
use App\Livewire\Admin\Kependudukan\PendudukSementara\PendudukSementaraCreateController;
use App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa\KeputusanKepalaDesaController;
use App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa\KeputusanKepalaDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa\AparaturPemerintahDesaController;
use App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa\KeputusanKepalaDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa\AparaturPemerintahDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa\AparaturPemerintahDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaHapusController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaPenghapusanController;
use App\Livewire\Admin\AdministrasiUmum\InventarisDesa\InventarisDesaPenghapusanEditController;
use App\Livewire\Admin\AdministrasiUmum\AgendaDesa\AgendaDesaController;
use App\Livewire\Admin\AdministrasiUmum\AgendaDesa\AgendaDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\AgendaDesa\AgendaDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaEditController;
use App\Livewire\Admin\Master\JenisInventarisController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pekerjaan', PekerjaanController::class)->name('pekerjaan');
Route::get('/dusun', DusunController::class)->name('dusun');
Route::get('/jabatan', JabatanController::class)->name('jabatan');
Route::get('/kelas-tanah', KelasTanahController::class)->name('kelasTanah');
Route::get('/jenis-inventaris', JenisInventarisController::class)->name('jenisInventaris');

// Administrasi Kependudukan
Route::get('/induk-penduduk', IndukPendudukController::class)->name('indukPenduduk');
Route::get('/induk-penduduk/create', IndukPendudukCreateController::class)->name('indukPenduduk.create');
Route::get('/induk-penduduk/{id}/edit', IndukPendudukEditController::class)->name('indukPenduduk.edit');
Route::get('/induk-penduduk/{id}/pindah', IndukPendudukPindahController::class)->name('indukPenduduk.pindah');

Route::get('/kartu-keluarga', KartuKeluargaController::class)->name('kartuKeluarga');
Route::get('/kartu-keluarga/create', KartuKeluargaCreateController::class)->name('kartuKeluarga.create');
Route::get('/kartu-keluarga/{id_kartu_keluarga}/edit', KartuKeluargaEditController::class)->name('kartuKeluarga.edit');

Route::get('/penduduk-sementara', PendudukSementaraController::class)->name('pendudukSementara');
Route::get('/penduduk-sementara/create', PendudukSementaraCreateController::class)->name('pendudukSementara.create');
Route::get('/penduduk-sementara/{id_penduduk}/edit', PendudukSementaraEditController::class)->name('pendudukSementara.edit');

// Administrasi Umum
Route::get('/keputusan-kepala-desa', KeputusanKepalaDesaController::class)->name('keputusanKepalaDesa');
Route::get('/keputusan-kepala-desa/create', KeputusanKepalaDesaCreateController::class)->name('keputusanKepalaDesa.create');
Route::get('/keputusan-kepala-desa/{id_keputusan_kepala_desa}/edit}', KeputusanKepalaDesaEditController::class)->name('keputusanKepalaDesa.edit');

Route::get('/aparatur-desa', AparaturPemerintahDesaController::class)->name('AparaturDesa');
Route::get('/aparatur-desa/create', AparaturPemerintahDesaCreateController::class)->name('AparaturDesa.create');
Route::get('/aparatur-desa/{id_aparatur_desa}/edit', AparaturPemerintahDesaEditController::class)->name('AparaturDesa.edit');

Route::get('/peraturan-desa', PeraturanDesaController::class)->name('PeraturanDesa');
Route::get('/peraturan-desa/create', PeraturanDesaCreateController::class)->name('PeraturanDesa.create');
Route::get('/peraturan-desa/{id_peraturan_desa}/edit', PeraturanDesaEditController::class)->name('PeraturanDesa.edit');

Route::get('/tanah-kas-desa', TanahKasDesaController::class)->name('TanahKasDesa');
Route::get('/tanah-kas-desa/create', TanahKasDesaCreateController::class)->name('TanahKasDesa.create');
Route::get('/tanah-kas-desa/{id_tkd}/edit', TanahKasDesaEditController::class)->name('TanahKasDesa.edit');

Route::get('/inventaris-desa', InventarisDesaController::class)->name('InventarisDesa');
Route::get('/inventaris-desa/create', InventarisDesaCreateController::class)->name('InventarisDesa.create');
Route::get('/inventaris-desa/deleted', InventarisDesaPenghapusanController::class)->name('InventarisDesa.deleted');
Route::get('/inventaris-desa/{id_inventaris_desa}/delete', InventarisDesaHapusController::class)->name('InventarisDesa.delete');
Route::get('/inventaris-desa/{id_inventaris_desa}/deleted/edit', InventarisDesaPenghapusanEditController::class)->name('InventarisDesa.deleted.edit');
Route::get('/inventaris-desa/{id_inventaris_desa}/edit', InventarisDesaEditController::class)->name('InventarisDesa.edit');

Route::get('/tanah-desa', TanahDesaController::class)->name('TanahDesa');
Route::get('/tanah-desa/create', TanahDesaCreateController::class)->name('TanahDesa.create');
Route::get('/tanah-desa/{id_tanah_desa}/edit', TanahDesaEditController::class)->name('TanahDesa.edit');

Route::get('/surat-keluar', AgendaDesaController::class)->name('AgendaDesa');
Route::get('/surat-keluar/create', AgendaDesaCreateController::class)->name('AgendaDesa.create');
Route::get('/surat-keluar/{id_agenda_surat}/edit', AgendaDesaEditController::class)->name('AgendaDesa.edit');

