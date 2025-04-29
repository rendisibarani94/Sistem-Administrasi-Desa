<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaHapusController extends Component
{
    public $id_inventaris_desa;

    public $jumlah_baik;

    public $jumlah_rusak;

    public $jenis_inventaris;

    public $created_at;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_dijual = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_disumbangkan = 0;

    #[Rule('required', message: 'Kolom Tanggal Penghapusan Harus Diisi!')]
    public $tanggal_penghapusan;

    #[Rule('max:255', message: 'Kolom Keterangan Terlalu Panjang')]
    public $keterangan;


    public function mount($id_inventaris_desa)
    {
        $this->id_inventaris_desa = $id_inventaris_desa;
        $this->loadHapusData();
        $this->ensureNumericValues();
    }

    // Create a separate method for numeric conversion
    protected function ensureNumericValues()
    {
        $numericFields = [
            'jumlah_dijual',
            'jumlah_disumbangkan',
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
            'jumlah_dijual',
            'jumlah_disumbangkan',
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
            'jumlah_dijual',
            'jumlah_disumbangkan',
        ];

        if (in_array($propertyName, $relevantFields)) {
            $this->validateTotals();
        }
    }

    // Custom method to validate totals
    protected function validateTotals()
    {
        $sumHapus = (float)$this->jumlah_dijual + (float)$this->jumlah_disumbangkan;
        $sumKondisi = (float)$this->jumlah_baik + (float)$this->jumlah_rusak;
        $fields = [
            'jumlah_dijual',
            'jumlah_disumbangkan',
        ];
        if ($sumHapus != $sumKondisi) {
            $errorMessage = "Total jumlah dari inventaris awal harus sama dengan total inventaris yang akan dihapus .";
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


    public function loadHapusData()
    {
        $id = DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->first();

        $this->keterangan = $id->keterangan;
        $this->jumlah_baik = $id->jumlah_baik;
        $this->jenis_inventaris = $id->jenis_inventaris;
        $this->jumlah_rusak = $id->jumlah_rusak;
        $this->created_at = $id->created_at;
    }

    public function hapus()
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
        $validated['is_deleted'] = 1;

        DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->update($validated);

        return redirect()->route('InventarisDesa')->with('success', 'Penghapusan Data Inventaris Desa Berhasil dilakukan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.hapus');
    }
}
