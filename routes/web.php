<?php

use App\Http\Controllers\Laporan\Kependudukan\LaporanIndukPendudukController;
use App\Http\Controllers\Laporan\Kependudukan\LaporanKtpKkController;
use App\Http\Controllers\Laporan\Kependudukan\LaporanMutasiPendudukController;
use App\Http\Controllers\Laporan\Kependudukan\LaporanPendudukSementaraController;
use App\Http\Controllers\Laporan\Kependudukan\LaporanRekapitulasiPenduduk;
use App\Http\Controllers\Laporan\Pembangunan\LaporanPembangunanController;
use App\Http\Controllers\Laporan\Umum\LaporanAgendaSuratController;
use App\Http\Controllers\Laporan\Umum\LaporanAparatDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanEkspedisiController;
use App\Http\Controllers\Laporan\Umum\LaporanInventarisDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanKeputusanKepalaDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanLembaranBeritaDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanPeraturanDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanTanahDesaController;
use App\Http\Controllers\Laporan\Umum\LaporanTanahKasDesaController;
use App\Livewire\Admin\AdministrasiPembangunan\InventarisHasilPembangunan\InventarisHasilPembangunanController;
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
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukMutasiController;
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
use App\Livewire\Admin\AdministrasiUmum\AgendaSuratDesa\AgendaSuratDesaController;
use App\Livewire\Admin\AdministrasiUmum\AgendaSuratDesa\AgendaSuratDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\AgendaSuratDesa\AgendaSuratDesaEditController;
use App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan\KaderPemberdayaanController;
use App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan\KaderPemberdayaanCreateController;
use App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan\KaderPemberdayaanEditController;
use App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan\KegiatanPembangunanController;
use App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan\KegiatanCreatePembangunanController;
use App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan\KegiatanEditPembangunanController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\TanahDesa\TanahDesaEditController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaCreateController;
use App\Livewire\Admin\AdministrasiUmum\TanahKasDesa\TanahKasDesaEditController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukEditMutasiController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukDetailMutasiController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukPindahController;
use App\Livewire\Admin\Kependudukan\StatistikKependudukan\StatistikKependudukanController;
use App\Livewire\Admin\Master\BidangKeahlianController;
use App\Livewire\Admin\Master\JenisInventarisController;
use App\Livewire\Admin\Masyarakat\Agenda\AdminAgendaController;
use App\Livewire\Admin\Masyarakat\Agenda\AdminAgendaCreateController;
use App\Livewire\Admin\Masyarakat\Agenda\AdminAgendaEditController;
use App\Livewire\Admin\Masyarakat\Apbdes\AdminApbdesController;
use App\Livewire\Admin\Masyarakat\Apbdes\AdminApbdesCreateController;
use App\Livewire\Admin\Masyarakat\Apbdes\AdminApbdesEditController;
use App\Livewire\Admin\Masyarakat\Beranda\AdminBerandaController;
use App\Livewire\Admin\Masyarakat\Berita\AdminBeritaController;
use App\Livewire\Admin\Masyarakat\Berita\AdminBeritaCreateController;
use App\Livewire\Admin\Masyarakat\Berita\AdminBeritaEditController;
use App\Livewire\Admin\Masyarakat\Organisasi\AdminOrganisasiController;
use App\Livewire\Admin\Masyarakat\Organisasi\AdminOrganisasiCreateController;
use App\Livewire\Admin\Masyarakat\Organisasi\AdminOrganisasiEditController;
use App\Livewire\Admin\Masyarakat\Pengumuman\AdminPengumumanController;
use App\Livewire\Admin\Masyarakat\Pengumuman\AdminPengumumanCreateController;
use App\Livewire\Admin\Masyarakat\Pengumuman\AdminPengumumanEditController;
use App\Livewire\Admin\Masyarakat\Profil\AdminProfilController;
use App\Livewire\Admin\Masyarakat\Settings\SettingsController as SettingsSettingsController;
use App\Livewire\Masyarakat\Agenda\AgendaController;
use App\Livewire\Masyarakat\Apbdes\ApbdesController;
use App\Livewire\Masyarakat\Apbdes\ApbdesDetailController;
use App\Livewire\Masyarakat\BerandaController;
use App\Livewire\Masyarakat\Berita\BeritaController;
use App\Livewire\Masyarakat\Berita\DetailBeritaController;
use App\Livewire\Masyarakat\Organisasi\DetailOrganisasiController;
use App\Livewire\Masyarakat\Organisasi\OrganisasiController;
use App\Livewire\Masyarakat\Pembangunan\DetailPembangunanController;
use App\Livewire\Masyarakat\Pembangunan\PembangunanController;
use App\Livewire\Masyarakat\Pengumuman\DetailPengumumanController;
use App\Livewire\Masyarakat\Pengumuman\PengumumanController;
use App\Livewire\Masyarakat\ProfilController;
use App\Http\Controllers\Auth\AuthController;
use App\Livewire\Admin\BerandaAdminController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukCreateExcelController;
use App\Livewire\Admin\Kependudukan\IndukPenduduk\IndukPendudukKkMutasiController;
use App\Livewire\Admin\Kependudukan\KartuKeluarga\KartuKeluargaDetailController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Your protected routes here
    Route::get('/admin', BerandaAdminController::class)->name('beranda.admin');

Route::get('/pekerjaan', PekerjaanController::class)->name('pekerjaan');
Route::get('/dusun', DusunController::class)->name('dusun');
Route::get('/bidang-keahlian', BidangKeahlianController::class)->name('bidangKeahlian');

// Administrasi Kependudukan
Route::get('/statistik-kependudukan', StatistikKependudukanController::class)->name('statistikKependudukan');

Route::get('/induk-penduduk', IndukPendudukController::class)->name('indukPenduduk');
Route::get('/induk-penduduk/pindah', IndukPendudukPindahController::class)->name('indukPenduduk.pindah');
Route::get('/induk-penduduk/create', IndukPendudukCreateController::class)->name('indukPenduduk.create');
Route::get('/induk-penduduk/createExcel', IndukPendudukCreateExcelController::class)->name('indukPenduduk.create.excel');
Route::get('/induk-penduduk/{id}/edit', IndukPendudukEditController::class)->name('indukPenduduk.edit');
Route::get('/induk-penduduk/{id}/mutasi', IndukPendudukMutasiController::class)->name('indukPenduduk.mutasi');
Route::get('/induk-penduduk/{id}/mutasi/kepala-keluarga', IndukPendudukKkMutasiController::class)->name('indukPenduduk.mutasi.kepala-keluarga');
Route::get('/induk-penduduk/{id}/mutasi/edit', IndukPendudukEditMutasiController::class)->name('indukPenduduk.mutasi.edit');
Route::get('/induk-penduduk/{id}/mutasi/detail', IndukPendudukDetailMutasiController::class)->name('indukPenduduk.mutasi.detail');

Route::get('/kartu-keluarga', KartuKeluargaController::class)->name('kartuKeluarga');
Route::get('/kartu-keluarga/{id_kartu_keluarga}/detail', KartuKeluargaDetailController::class)->name('kartuKeluarga.detail');
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

Route::get('/agenda-surat', AgendaSuratDesaController::class)->name('AgendaSuratDesa');
Route::get('/agenda-surat/create', AgendaSuratDesaCreateController::class)->name('AgendaSuratDesa.create');
Route::get('/agenda-surat/{id_agenda_surat}/edit', AgendaSuratDesaEditController::class)->name('AgendaSuratDesa.edit');

Route::get('/kader-pemberdayaan-masyarakat', KaderPemberdayaanController::class)->name('KaderPemberdayaanMasyarakat');
Route::get('/kader-pemberdayaan-masyarakat/create', KaderPemberdayaanCreateController::class)->name('KaderPemberdayaanMasyarakat.create');
Route::get('/kader-pemberdayaan-masyarakat/{id_kader_pemberdayaan}/edit', KaderPemberdayaanEditController::class)->name('KaderPemberdayaanMasyarakat.edit');

Route::get('/kegiatan-pembangunan', KegiatanPembangunanController::class)->name('Pembangunan');
Route::get('/kegiatan-pembangunan/create', KegiatanCreatePembangunanController::class)->name('Pembangunan.create');
Route::get('/kegiatan-pembangunan/{id_pembangunan}/edit', KegiatanEditPembangunanController::class)->name('Pembangunan.edit');

Route::get('/admin/inventaris-hasil-pembangunan', InventarisHasilPembangunanController::class)->name('HasilPembangunan');

// Admin Informasi Masyarakat
Route::get('/admin/settings', SettingsSettingsController::class)->name('settings');

Route::get('/admin/beranda', AdminBerandaController::class)->name('admin.beranda');
Route::get('/admin/profil', AdminProfilController::class)->name('admin.profil');

Route::get('/admin/berita', AdminBeritaController::class)->name('admin.berita');
Route::get('/admin/berita/create', AdminBeritaCreateController::class)->name('admin.berita.create');
Route::get('/admin/berita/{id_berita}/edit', AdminBeritaEditController::class)->name('admin.berita.edit');

Route::get('/admin/pengumuman', AdminPengumumanController::class)->name('admin.pengumuman');
Route::get('/admin/pengumuman/create', AdminPengumumanCreateController::class)->name('admin.pengumuman.create');
Route::get('/admin/pengumuman/{id_pengumuman}/edit/', AdminPengumumanEditController::class)->name('admin.pengumuman.edit');

Route::get('/admin/agenda', AdminAgendaController::class)->name('admin.agenda');
Route::get('/admin/agenda/create', AdminAgendaCreateController::class)->name('admin.agenda.create');
Route::get('/admin/agenda/{id_agenda}/edit', AdminAgendaEditController::class)->name('admin.agenda.edit');

Route::get('/admin/organisasi', AdminOrganisasiController::class)->name('admin.organisasi');
Route::get('/admin/organisasi/create', AdminOrganisasiCreateController::class)->name('admin.organisasi.create');
Route::get('/admin/organisasi/{id_organisasi}/edit', AdminOrganisasiEditController::class)->name('admin.organisasi.edit');

Route::get('/admin/apbdes', AdminApbdesController::class)->name('admin.apbdes');
Route::get('/admin/apbdes/create', AdminApbdesCreateController::class)->name('admin.apbdes.create');
Route::get('/admin/apbdes/{id_apbdes}/edit', AdminApbdesEditController::class)->name('admin.apbdes.edit');

});

// Laporan Pembangunan View
Route::get('D1', [LaporanPembangunanController::class, 'displayD1']);
Route::get('D2', [LaporanPembangunanController::class, 'displayD2']);
Route::get('D3', [LaporanPembangunanController::class, 'displayD3']);
Route::get('D4', [LaporanPembangunanController::class, 'displayD4']);

// Laporan Umum View
Route::get('A1', [LaporanPeraturanDesaController::class, 'displayA1']);
Route::get('A2', [LaporanKeputusanKepalaDesaController::class, 'displayA2']);
Route::get('A3', [LaporanInventarisDesaController::class, 'displayA3']);
Route::get('A4', [LaporanAparatDesaController::class, 'displayA4']);
Route::get('A5', [LaporanTanahKasDesaController::class, 'displayA5']);
Route::get('A6', [LaporanTanahDesaController::class, 'displayA6']);
Route::get('A7', [LaporanAgendaSuratController::class, 'displayA7']);
Route::get('A8', [LaporanEkspedisiController::class, 'displayA8']);
Route::get('A9', [LaporanLembaranBeritaDesaController::class, 'displayA9']);

// Laporan Kependuduk
Route::get('B1', [LaporanIndukPendudukController::class, 'displayB1']);
Route::get('B2', [LaporanMutasiPendudukController::class, 'displayB2']);
Route::get('B3', [LaporanRekapitulasiPenduduk::class, 'displayB3']);
Route::get('B4', [LaporanPendudukSementaraController::class, 'displayB4']);
Route::get('B5', [LaporanKtpKkController::class, 'displayB5']);

// Example pdf download routes
Route::get('laporan-kader-pemberdayaan', [LaporanPembangunanController::class, 'kaderPemberdayaan']);

Route::get('/kader-pemberdayaan-masyarakat/{id_kader_pemberdayaan}/edit', KaderPemberdayaanEditController::class)->name('KaderPemberdayaanMasyarakat.edit');

// user masyarakat
Route::get('/', BerandaController::class)->name('beranda');
Route::get('/profil-desa', ProfilController::class)->name('profil');
Route::get('/berita-desa', BeritaController::class)->name('berita');
Route::get('/berita-desa/{id_berita}/detail', DetailBeritaController::class)->name('detail.berita');
Route::get('/pengumuman', PengumumanController::class)->name('pengumuman');
Route::get('/pengumuman/{id_pengumuman}/detail', DetailPengumumanController::class)->name('pengumuman.detail');
Route::get('/agenda-desa', AgendaController::class)->name('agenda-desa');
Route::get('/organisasi-desa', OrganisasiController::class)->name('organisasi.desa');
Route::get('/organisasi-desa/{id_organisasi}/detail', DetailOrganisasiController::class)->name('organisasi.desa.detail');
Route::get('/pembangunan', PembangunanController::class)->name('pembangunan');
Route::get('/pembangunan/{id_pembangunan}/detail', DetailPembangunanController::class)->name('pembangunan.detail');
Route::get('/apbdes', ApbdesController::class)->name('apbdes');
Route::get('/apbdes/{id_apbdes}/detail', ApbdesDetailController::class)->name('apbdes.detail');
