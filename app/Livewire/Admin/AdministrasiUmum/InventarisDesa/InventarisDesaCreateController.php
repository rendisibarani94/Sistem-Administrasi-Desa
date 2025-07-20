<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaCreateController extends Component
{
    #[Rule('required', message: 'Kolom Jenis Barang Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Jenis Barang Maksimal 100 digit karakter!')]
    public $jenis_inventaris;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_desa = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_pemerintah = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_provinsi = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_kabupaten = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_sumbangan = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_baik = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_rusak = 0;


    #[Rule('max:255', message: 'Kolom Keterangan Maksimal 255 digit karakter!')]
    public $keterangan;

    // Instead of using prepareForValidation, use boot or mount to initialize values
    public function mount()
    {
        $this->ensureNumericValues();
    }

    // Create a separate method for numeric conversion
    protected function ensureNumericValues()
    {
        $numericFields = [
            'oleh_desa',
            'oleh_pemerintah',
            'oleh_provinsi',
            'oleh_kabupaten',
            'oleh_sumbangan',
            'jumlah_baik',
            'jumlah_rusak'
        ];

        foreach ($numericFields as $field) {
            $this->$field = is_numeric($this->$field) ? (float)$this->$field : 0;
        }
    }

    // Called before each property update
    public function updating($name, $value)
    {
        // If updating a numeric field, ensure it's converted properly
        $numericFields = [
            'oleh_desa',
            'oleh_pemerintah',
            'oleh_provinsi',
            'oleh_kabupaten',
            'oleh_sumbangan',
            'jumlah_baik',
            'jumlah_rusak'
        ];

        if (in_array($name, $numericFields) && !is_numeric($value)) {
            return 0;
        }

        return $value;
    }

    // We'll use updated method to check totals when any relevant field changes
    public function updated($propertyName)
    {
        // Only validate totals when one of these fields is updated
        $relevantFields = [
            'oleh_desa',
            'oleh_pemerintah',
            'oleh_provinsi',
            'oleh_kabupaten',
            'oleh_sumbangan',
            'jumlah_baik',
            'jumlah_rusak'
        ];

        if (in_array($propertyName, $relevantFields)) {
            $this->validateTotals();
        }
    }

    // Custom method to validate totals
    protected function validateTotals()
    {
        $sumSumber = (float)$this->oleh_desa + (float)$this->oleh_pemerintah + (float)$this->oleh_provinsi + (float)$this->oleh_kabupaten + (float)$this->oleh_sumbangan;
        $sumKondisi = (float)$this->jumlah_baik + (float)$this->jumlah_rusak;
        $fields = [
            'oleh_desa',
            'oleh_pemerintah',
            'oleh_provinsi',
            'oleh_kabupaten',
            'oleh_sumbangan',
            'jumlah_baik',
            'jumlah_rusak'
        ];
        if ($sumSumber != $sumKondisi) {
            $errorMessage = "Total jumlah dari semua sumber harus sama dengan total kondisi baik dan rusak .";
            // Add the error to all specified fields
            foreach ($fields as $field) {
                $this->addError($field, $errorMessage);
            }
        } else {
            // Clear errors from all fields if validation passes
            foreach ($fields as $field) {
                $this->resetErrorBag($field);
            }
        }
    }


    public function store()
    {
        $validated = $this->validate();
        $validated['awal_baik'] = $this->jumlah_baik;
        $validated['awal_rusak'] = $this->jumlah_rusak;

        // Then run the custom totals validation
        $this->validateTotals();

        // Check if there are any errors after both validations
        if ($this->getErrorBag()->isNotEmpty()) {
            // If there are errors, stop here and don't proceed with saving
            return;
        }

        DB::table('inventaris_desa')->insert($validated);

        $this->reset();

        return redirect()->route('InventarisDesa')->with('success', 'Data Inventaris Desa berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.create');
    }
}
