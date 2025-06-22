<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaEditController extends Component
{
    public $id_inventaris_desa;

    #[Rule('required', message: 'Kolom Jenis Barang Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Jenis Barang Terlalu Panjang!')]
    public $jenis_inventaris;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_desa;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_pemerintah;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_provinsi;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_kabupaten;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_sumbangan;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_baik;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_rusak;

    #[Rule('max:255', message: 'Kolom Keterangan Terlalu Panjang!')]
    public $keterangan;


    public function mount($id_inventaris_desa)
    {
        $this->id_inventaris_desa = $id_inventaris_desa;
        $this->loadEditData();
        $this->ensureNumericValues();
    }

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

    protected function loadEditData()
    {
        $id = DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->first();

        $this->jenis_inventaris = $id->jenis_inventaris;
        $this->oleh_desa = $id->oleh_desa;
        $this->oleh_pemerintah = $id->oleh_pemerintah;
        $this->oleh_provinsi = $id->oleh_provinsi;
        $this->oleh_kabupaten = $id->oleh_kabupaten;
        $this->oleh_sumbangan = $id->oleh_sumbangan;
        $this->keterangan = $id->keterangan;
        $this->jumlah_baik = $id->jumlah_baik;
        $this->jumlah_rusak = $id->jumlah_rusak;
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
        $sumSumber = (float)$this->oleh_desa + (float)$this->oleh_pemerintah +
            (float)$this->oleh_provinsi + (float)$this->oleh_kabupaten +
            (float)$this->oleh_sumbangan;

        $sumKondisi = (float)$this->jumlah_baik + (float)$this->jumlah_rusak;

        // Define the fields that should receive the error message
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

    public function update()
    {
        $validated = $this->validate();
        // Then run the custom totals validation
        $this->validateTotals();
        // Check if there are any errors after both validations
        if ($this->getErrorBag()->isNotEmpty()) {
            // If there are errors, stop here and don't proceed with saving
            return;
        }

        $validated['updated_at'] = now();

        DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->update($validated);

        return redirect()->route('InventarisDesa')->with('success', 'Data Inventaris Desa Berhasil Diubah!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.edit');
    }
}
