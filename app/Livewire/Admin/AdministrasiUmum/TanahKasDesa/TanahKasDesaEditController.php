<?php
namespace App\Livewire\Admin\AdministrasiUmum\TanahKasDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class TanahKasDesaEditController extends Component
{
    public $id_tkd;

    #[Rule('required', message: 'Kolom Asal Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Asal Tanah Kas Desa Terlalu Panjang')]
    public $asal_tkd;

    #[Rule('required', message: 'Kolom Nomor Letter C Harus Diisi!')]
    #[Rule('max:10', message: 'Kolom Nomor Letter C Terlalu Panjang')]
    public $letter_c;

    #[Rule('required', message: 'Kolom Nomor Persil Harus Diisi!')]
    #[Rule('max:10', message: 'Kolom Nomor Persil Terlalu Panjang')]
    public $persil;

    #[Rule('required', message: 'Kolom Kelas Tanah Kas Desa Harus Diisi!')]
    public $kelas;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_desa;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_pemerintah;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_provinsi;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_kabupaten;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_lain_lain;

    #[Rule('required', message: 'Kolom Tanggal Perolehan Tanah Kas Desa Harus Diisi!')]
    public $tanggal_perolehan;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $sawah;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tegal;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $kebun;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tombak;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanah_kering;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $patok;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanpa_patok;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $papan_nama;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanpa_papan_nama;

    #[Rule('required', message: 'Kolom Lokasi Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Lokasi Terlalu Panjang')]
    public $lokasi;

    #[Rule('required', message: 'Kolom Peruntukan Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Peruntukan Terlalu Panjang')]
    public $peruntukan;

    #[Rule('max:255', message: 'Kolom Keterngan Terlalu Panjang')]
    public $keterangan;

    public function mount($id_tkd)
    {
        $this->id_tkd = $id_tkd;
        $this->loadEditData();
    }

    public function loadEditData(){
        $tkd = DB::table('tanah_kas_desa')->where('id_tkd', $this->id_tkd)->first();

        $this->asal_tkd = $tkd->asal_tkd;
        $this->letter_c = $tkd->letter_c;
        $this->persil = $tkd->persil;
        $this->kelas = $tkd->kelas;
        $this->oleh_desa = $tkd->oleh_desa;
        $this->oleh_pemerintah = $tkd->oleh_pemerintah;
        $this->oleh_provinsi = $tkd->oleh_provinsi;
        $this->oleh_kabupaten = $tkd->oleh_kabupaten;
        $this->oleh_lain_lain = $tkd->oleh_lain_lain;
        $this->tanggal_perolehan = $tkd->tanggal_perolehan;
        $this->sawah = $tkd->sawah;
        $this->tegal = $tkd->tegal;
        $this->kebun = $tkd->kebun;
        $this->tombak = $tkd->tombak;
        $this->tanah_kering = $tkd->tanah_kering;
        $this->patok = $tkd->patok;
        $this->tanpa_patok = $tkd->tanpa_patok;
        $this->papan_nama = $tkd->papan_nama;
        $this->tanpa_papan_nama = $tkd->tanpa_papan_nama;
        $this->lokasi = $tkd->lokasi;
        $this->peruntukan = $tkd->peruntukan;
        $this->keterangan = $tkd->keterangan;
    }
    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('tanah_kas_desa')->where('id_tkd', $this->id_tkd)->update($validated);

        return redirect()->route('TanahKasDesa')->with('success', 'Data Tanah Kas Desa Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.tanah-kas-desa.edit',
            [
                'kelasTanahData' => DB::table('kelas_tanah')
                ->where('is_deleted', 0)
                ->orderBy('id_kelas_tanah', 'desc')
                ->get()
            ]
        );
    }
}