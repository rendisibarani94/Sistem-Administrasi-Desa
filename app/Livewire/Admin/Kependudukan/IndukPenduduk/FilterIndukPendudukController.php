<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilterIndukPendudukController extends Component
{
    use WithPagination;

    public $deleteId;

    public $nik = '';
    public $nama_lengkap = '';
    public $jenis_kelamin = '';
    public $alamat = '';
    public $nama_ayah = '';
    public $nama_ibu = '';
    public $tempat_lahir = '';
    public $tanggal_lahir_awal = '';
    public $tanggal_lahir_akhir = '';
    public $kewarganegaraan = '';
    public $golongan_darah = '';
    public $agama = '';
    public $status_perkawinan = '';
    public $pendidikan_terakhir = '';
    public $pekerjaan = '';
    public $baca_huruf = '';
    public $kedudukan_keluarga = '';
    public $dusun = '';
    public $asal_penduduk = '';
    public $suku = '';
    public $status_penduduk = 'aktif';
    public $perPage = 10;

public function exportToExcel(): StreamedResponse
{
    $query = DB::table('penduduk')
        ->leftJoin('dusun', 'penduduk.dusun', '=', 'dusun.id_dusun')
        ->leftJoin('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
        ->select('penduduk.*', 'dusun.dusun as nama_dusun', 'kartu_keluarga.nomor_kartu_keluarga')
        ->where('penduduk.is_deleted', 0);

        // Apply filters
        if ($this->nik) {
            $query->where('penduduk.nik', 'like', '%'.$this->nik.'%');
        }

        if ($this->nama_lengkap) {
            $query->where('penduduk.nama_lengkap', 'like', '%'.$this->nama_lengkap.'%');
        }

        if ($this->jenis_kelamin) {
            $query->where('penduduk.jenis_kelamin', $this->jenis_kelamin);
        }

        if ($this->alamat) {
            $query->where('penduduk.alamat', 'like', '%'.$this->alamat.'%');
        }

        if ($this->nama_ayah) {
            $query->where('penduduk.nama_ayah', 'like', '%'.$this->nama_ayah.'%');
        }

        if ($this->nama_ibu) {
            $query->where('penduduk.nama_ibu', 'like', '%'.$this->nama_ibu.'%');
        }

        if ($this->tempat_lahir) {
            $query->where('penduduk.tempat_lahir', 'like', '%'.$this->tempat_lahir.'%');
        }

        if ($this->tanggal_lahir_awal && $this->tanggal_lahir_akhir) {
            $query->whereBetween('penduduk.tanggal_lahir', [$this->tanggal_lahir_awal, $this->tanggal_lahir_akhir]);
        }

        if ($this->kewarganegaraan) {
            $query->where('penduduk.kewarganegaraan', $this->kewarganegaraan);
        }

        if ($this->golongan_darah) {
            $query->where('penduduk.golongan_darah', $this->golongan_darah);
        }

        if ($this->agama) {
            $query->where('penduduk.agama', $this->agama);
        }

        if ($this->status_perkawinan) {
            $query->where('penduduk.status_perkawinan', $this->status_perkawinan);
        }

        if ($this->pendidikan_terakhir) {
            $query->where('penduduk.pendidikan_terakhir', $this->pendidikan_terakhir);
        }

        if ($this->pekerjaan) {
            $query->where('penduduk.pekerjaan', 'like', '%'.$this->pekerjaan.'%');
        }

        if ($this->baca_huruf) {
            $query->where('penduduk.baca_huruf', $this->baca_huruf);
        }

        if ($this->kedudukan_keluarga) {
            $query->where('penduduk.kedudukan_keluarga', $this->kedudukan_keluarga);
        }

        if ($this->dusun) {
            $query->where('penduduk.dusun', $this->dusun);
        }

        if ($this->asal_penduduk) {
            $query->where('penduduk.asal_penduduk', 'like', '%'.$this->asal_penduduk.'%');
        }

        if ($this->suku) {
            $query->where('penduduk.suku', 'like', '%'.$this->suku.'%');
        }

        if ($this-> status_penduduk == 'aktif') {
            $query->where('penduduk.is_deleted', 0)->where('penduduk.is_mutated', 0);
        }
        if ($this-> status_penduduk == 'pindah') {
            $query->where('penduduk.is_mutated', 1)->where('penduduk.tujuan_pindah', '!=', null);
        }
        if ($this-> status_penduduk == 'meninggal') {
            $query->where('penduduk.is_mutated', 1)->where('penduduk.tempat_meninggal', '!=', null);
        }

    $data = $query->get();

    $fileName = 'data-penduduk-' . now()->format('YmdHis') . '.xlsx';

    return response()->streamDownload(function() use ($data) {
        $writer = SimpleExcelWriter::streamDownload('php://output', 'xlsx');
        $writer->addHeader([
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Alamat',
            'Nama Ayah',
            'Nama Ibu',
            'Nomor Kartu Keluarga',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Kewarganegaraan',
            'Nomor Akta Kelahiran',
            'Golongan Darah',
            'Agama',
            'Tanggal Keluar E-KTP',
            'Keturunan',
            'Status Perkawinan',
            'Pendidikan Terakhir',
            'Pekerjaan',
            'Kemampuan Baca Huruf',
            'Kedudukan Keluarga',
            'Dusun',
            'Asal Penduduk',
            'Suku',
            'Tanggal Penambahan',
            'Tanggal Pengurangan',
            'Tempat Tujuan Pindah',
            'Tempat Meninggal',
            'Keterangan',
        ]);

        foreach ($data as $row) {
            $writer->addRow([
                $row->nik,
                $row->nama_lengkap,
                $row->jenis_kelamin,
                $row->alamat,
                $row->nama_ayah,
                $row->nama_ibu,
                $row->nama_ibu,
                $row->nomor_kartu_keluarga,
                $row->tanggal_lahir ? date('d/m/Y', strtotime($row->tanggal_lahir)) : '-',
                $row->kewarganegaraan,
                $row->nomor_akta_lahir ?? '-',
                $row->golongan_darah,
                $row->agama,
                $row->tanggal_keluar_ktp ? date('d/m/Y', strtotime($row->tanggal_keluar_ktp)) : '-',
                $row->keturunan ?? '-',
                $row->status_perkawinan,
                $row->pendidikan_terakhir,
                $row->pekerjaan,
                $row->baca_huruf,
                $row->kedudukan_keluarga,
                $row->nama_dusun,
                $row->asal_penduduk,
                $row->suku ?? '-',
                $row->tanggal_penambahan ? date('d/m/Y', strtotime($row->tanggal_penambahan)) : '-',
                $row->tanggal_pengurangan ? date('d/m/Y', strtotime($row->tanggal_pengurangan)) : '-',
                $row->tujuan_pindah ?? '-',
                $row->tempat_meninggal ?? '-',
                $row->keterangan,
            ]);
        }

        $writer->close();
    }, $fileName);
}

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $query = DB::table('penduduk');

        // Apply filters
        if ($this->nik) {
            $query->where('nik', 'like', '%'.$this->nik.'%');
        }

        if ($this->nama_lengkap) {
            $query->where('nama_lengkap', 'like', '%'.$this->nama_lengkap.'%');
        }

        if ($this->jenis_kelamin) {
            $query->where('jenis_kelamin', $this->jenis_kelamin);
        }

        if ($this->alamat) {
            $query->where('alamat', 'like', '%'.$this->alamat.'%');
        }

        if ($this->nama_ayah) {
            $query->where('nama_ayah', 'like', '%'.$this->nama_ayah.'%');
        }

        if ($this->nama_ibu) {
            $query->where('nama_ibu', 'like', '%'.$this->nama_ibu.'%');
        }

        if ($this->tempat_lahir) {
            $query->where('tempat_lahir', 'like', '%'.$this->tempat_lahir.'%');
        }

        if ($this->tanggal_lahir_awal && $this->tanggal_lahir_akhir) {
            $query->whereBetween('tanggal_lahir', [$this->tanggal_lahir_awal, $this->tanggal_lahir_akhir]);
        }

        if ($this->kewarganegaraan) {
            $query->where('kewarganegaraan', $this->kewarganegaraan);
        }

        if ($this->golongan_darah) {
            $query->where('golongan_darah', $this->golongan_darah);
        }

        if ($this->agama) {
            $query->where('agama', $this->agama);
        }

        if ($this->status_perkawinan) {
            $query->where('status_perkawinan', $this->status_perkawinan);
        }

        if ($this->pendidikan_terakhir) {
            $query->where('pendidikan_terakhir', $this->pendidikan_terakhir);
        }

        if ($this->pekerjaan) {
            $query->where('pekerjaan', 'like', '%'.$this->pekerjaan.'%');
        }

        if ($this->baca_huruf) {
            $query->where('baca_huruf', $this->baca_huruf);
        }

        if ($this->kedudukan_keluarga) {
            $query->where('kedudukan_keluarga', $this->kedudukan_keluarga);
        }

        if ($this->dusun) {
            $query->where('dusun', $this->dusun);
        }

        if ($this->asal_penduduk) {
            $query->where('asal_penduduk', 'like', '%'.$this->asal_penduduk.'%');
        }

        if ($this->suku) {
            $query->where('suku', 'like', '%'.$this->suku.'%');
        }

        if ($this-> status_penduduk == 'aktif') {
            $query->where('is_deleted', 0)->where('is_mutated', 0);
        }
        if ($this-> status_penduduk == 'pindah') {
            $query->where('is_mutated', 1)->where('tujuan_pindah', '!=', null);
        }
        if ($this-> status_penduduk == 'meninggal') {
            $query->where('is_mutated', 0)->where('tempat_meninggal', '!=', null);
        }

        $pendudukData = $query->paginate($this->perPage);

        return view(
            'admin.kependudukan.induk-penduduk.filter-penduduk',
            [
                'pendudukData' => $pendudukData,
                    'dusunData' => DB::table('dusun')
                    ->where('is_deleted', 0)
                    ->get(),
            ]
        );
    }


    public function resetFilters()
    {
        $this->nik = '';
        $this->nama_lengkap = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->nama_ayah = '';
        $this->nama_ibu = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir_awal = '';
        $this->tanggal_lahir_akhir = '';
        $this->kewarganegaraan = '';
        $this->golongan_darah = '';
        $this->agama = '';
        $this->status_perkawinan = '';
        $this->pendidikan_terakhir = '';
        $this->pekerjaan = '';
        $this->baca_huruf = '';
        $this->kedudukan_keluarga = '';
        $this->dusun = '';
        $this->asal_penduduk = '';
        $this->suku = '';
        $this->status_penduduk = 'aktif';
    }
    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data penduduk ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }
    public function delete()
    {
        DB::table('penduduk')
            ->where('id_penduduk', $this->deleteId)
            ->update(['is_deleted' => 1, 'updated_at' => now()]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data penduduk berhasil dihapus.',
        ]);
    }
    public function mutasi($id_penduduk)
    {
        $penduduk = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('id_penduduk', $id_penduduk)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->first();

        $familyCardId = DB::table('penduduk')->where('id_penduduk', $id_penduduk)->value('id_kartu_keluarga');

        // 1. Check if he is a non-deleted Head
        $isHead = DB::table('penduduk')
            ->where('id_penduduk', $id_penduduk)
            ->where('is_deleted', 0)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->exists();

        // 2. Check if he is the only one in his family
        $isOnlyMember = DB::table('penduduk')
            ->where('id_kartu_keluarga', $familyCardId) // Get this from the first query if needed
            ->where('is_deleted', 0)
            ->count() == 1; // Only 1 member left?

        $isLoneHead = $isHead && $isOnlyMember;

        if ($isLoneHead) {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
        if ($penduduk) {
            return $this->redirect(route('indukPenduduk.mutasi.kepala-keluarga', ['id' => $id_penduduk]));
        } else {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
    }
}
