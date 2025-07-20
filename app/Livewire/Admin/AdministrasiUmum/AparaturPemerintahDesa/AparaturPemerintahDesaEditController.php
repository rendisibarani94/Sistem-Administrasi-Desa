<?php

namespace App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AparaturPemerintahDesaEditController extends Component
{
    use WithFileUploads;

    public $id_aparatur;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Nama Lengkap Maksimal 100 digit karakter!')]
    public $nama_lengkap;

    #[Rule(
        ['required_without:nip', 'nullable', 'size:18'],
        message: [
            'required_without' => 'Mohon isi salah satu field: NIP atau NIPD.',
            'size' => 'Input NIPD harus 18 digit!'
        ]
    )]
    public $nipd;

    #[Rule(
        ['required_without:nipd', 'nullable', 'size:18'],
        message: [
            'required_without' => 'Mohon isi salah satu field: NIP atau NIPD.',
            'size' => 'Input NIP harus 18 digit!'
        ]
    )]
    public $nip;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi')]
    #[Rule('max:150', message: 'Input Tempat Lahir Maksimal 150 digit karakter!')]
    public $tempat_lahir;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Agama Harus Diisi')]
    public $agama;

    #[Rule('required', message: 'Kolom Golongan Harus Diisi')]
    public $golongan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $jabatan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $pendidikan;

    #[Rule('required|date', message: 'Tanggal pengangkatan harus diisi')]
    public $tanggal_pengangkatan;

    #[Rule('nullable|date', message: 'Format tanggal tidak valid')]
    public $tanggal_pemberhentian;

    #[Rule('max:255', message: 'Input Keterangan Maksimal 255 digit karakter!')]
    public $keterangan;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto;
    public $oldFoto;
    public $existingFoto;

    public $is_active = true;

        protected function validateDates()
{
    if ($this->tanggal_pemberhentian) {
        if (Carbon::parse($this->tanggal_pengangkatan)->gte(Carbon::parse($this->tanggal_pemberhentian))) {
            $this->addError('tanggal_pengangkatan', 'Tanggal pengangkatan harus sebelum pemberhentian');
            return false;
        }
    }
    return true;
}

    public function mount($id_aparatur_desa){
        $this->id_aparatur = $id_aparatur_desa;
        $this->loadEditData();
    }

        public function updatedFoto()
    {
        // Clean up previous file if exists
        if ($this->oldFoto) {
            cleanup_livewire_temp_files($this->oldFoto);
        }
        // Store reference to current file
        $this->oldFoto = $this->foto;
    }

    public function loadEditData(){
        $kkd = DB::table('aparatur_desa')->where('id_aparatur', $this->id_aparatur)->first();

        $this->nama_lengkap = $kkd->nama_lengkap;
        $this->nipd = $kkd->nipd;
        $this->nip = $kkd->nip;
        $this->jenis_kelamin = $kkd->jenis_kelamin;
        $this->tempat_lahir = $kkd->tempat_lahir;
        $this->tanggal_lahir = $kkd->tanggal_lahir;
        $this->agama = $kkd->agama;
        $this->golongan = $kkd->golongan;
        $this->jabatan = $kkd->jabatan;
        $this->pendidikan = $kkd->pendidikan;
        $this->tanggal_pengangkatan = $kkd->tanggal_pengangkatan;
        $this->tanggal_pemberhentian = $kkd->tanggal_pemberhentian;
        $this->existingFoto = $kkd->foto;
        $this->keterangan = $kkd->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();

        // Calculate active status based on dates
        $isActive = !$this->tanggal_pemberhentian || Carbon::parse($this->tanggal_pemberhentian)->isFuture();

        if (!$this->validateDates()) {
        return; // Stop if date validation fails
        }

        if ($this->foto) {
            // Delete old image if exists
            if ($this->existingFoto && Storage::disk('public')->exists($this->existingFoto)) {
                Storage::disk('public')->delete($this->existingFoto);
            }
            // Store new image
            $imagePath = $this->foto->store('images/aparatur-desa', 'public');
        }

        $validated['updated_at'] = now();
        $validated['foto'] = $imagePath ?? $this->existingFoto ?? null;

        DB::transaction(function () use ($validated, $isActive) {
            // Deactivate others in same position ONLY if activating new entry
            if ($isActive) {
                DB::table('aparatur_desa')
                    ->where('jabatan', $this->jabatan)
                    ->where('is_active', true)
                    ->whereNull('is_deleted')
                    ->update(['is_active' => false]);
            }

            // Insert with calculated active status
            DB::table('aparatur_desa')
            ->where('id_aparatur', $this->id_aparatur)
            ->update([
                ...$validated,
                'is_active' => $isActive,
                'updated_at' => now()
            ]);
        });

        cleanup_livewire_temp_files($this->foto);
        $this->reset();

        return redirect()->route('AparaturDesa')->with('success', 'Data Aparatur Desa Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.edit',
        );
    }
}
