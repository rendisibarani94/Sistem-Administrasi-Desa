<?php

namespace App\Livewire\Admin\Kependudukan\StatistikKependudukan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

class StatistikKependudukanController extends Component
{

    public $ageGroups;

    public $dusunData;

    public function mount()
    {
        $penduduks = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('is_mutated', 0)
            ->get();

        $this->ageGroups = $penduduks->groupBy(function ($item) {
            return $this->getAgeGroup($item->tanggal_lahir);
        })->map->count();

        // Data Dusun (new code)
        $this->dusunData = DB::table('penduduk')
            ->join('dusun', 'penduduk.dusun', '=', 'dusun.id_dusun')
            ->where('penduduk.is_deleted', 0)
            ->where('penduduk.is_mutated', 0)
            ->where('dusun.is_deleted', 0)
            ->select('dusun.dusun as name', DB::raw('count(*) as total'))
            ->groupBy('dusun.dusun')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->name => $item->total];
            });
    }

    private function getAgeGroup($tanggal_lahir)
    {
        $age = Carbon::parse($tanggal_lahir)->age;

        return match (true) {
            $age < 5 => 'Usia 0-4 Tahun',
            $age >= 5 && $age <= 17 => 'Usia 5-17 Tahun',
            $age >= 18 && $age <= 25 => 'Usia 18-25 Tahun',
            $age >= 26 && $age <= 35 => 'Usia 26-35 Tahun',
            $age >= 36 && $age <= 45 => 'Usia 36-45 Tahun',
            $age >= 46 && $age <= 55 => 'Usia 46-55 Tahun',
            $age >= 56 && $age <= 65 => 'Usia 56-65 Tahun',
            $age > 65 => 'Usia >65 Tahun',
            default => 'Tidak Diketahui'
        };
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.statistik-kependudukan.index', [
            'ageGroups' => $this->ageGroups,
            'dusunData' => $this->dusunData,
        ]);
    }
}
