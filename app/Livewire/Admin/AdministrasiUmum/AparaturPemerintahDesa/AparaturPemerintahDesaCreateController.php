<?php

namespace App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AparaturPemerintahDesaCreateController extends Component
{
    use WithFileUploads;

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

    #[Rule(
        ['required_without:nipd', 'nullable'],
        message: [
            'required_without' => 'Golongan Harus Diisi Untuk Aparatur PNS',
        ]
    )]
    public $golongan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $jabatan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $pendidikan;

    #[Rule('required|date', message: 'Tanggal pengangkatan harus diisi')]
    public $tanggal_pengangkatan;

    #[Rule('nullable|date', message: 'Format tanggal tidak valid')]
    public $tanggal_pemberhentian;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto;
    public $oldFoto;
    public $existingFoto;

    public $is_active = true;

    #[Rule('max:255', message: 'Input Keterangan Maksimal 255 digit karakter!')]
    public $keterangan;

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

public function updated($propertyName)
{
    if (in_array($propertyName, ['tanggal_pengangkatan', 'tanggal_pemberhentian'])) {
        $this->validateOnly($propertyName);
        $this->validateDates();
    }
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

    public function store()
    {
        $validated = $this->validate();

        if (!$this->validateDates()) {
        return; // Stop if date validation fails
        }

        // Calculate active status based on dates
        $isActive = !$this->tanggal_pemberhentian || Carbon::parse($this->tanggal_pemberhentian)->isFuture();

        if ($this->foto) {
            // Store new image
            $imagePath = $this->foto->store('images/aparatur-desa', 'public');
        }

        $validated['foto'] = $imagePath ?? null;

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
            DB::table('aparatur_desa')->insert([
                ...$validated,
                'is_active' => $isActive,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });

        cleanup_livewire_temp_files($this->foto);

        $this->reset();

        return redirect()->route('AparaturDesa')->with('success', 'Data Aparatur Desa berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.create',
        );
    }
}
