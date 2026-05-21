<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSurat = [
            [
                'nama_surat' => 'Surat Keterangan Domisili',
                'deskripsi'  => 'Keterangan tempat tinggal warga.',
                'is_active'  => true,
            ],
            [
                'nama_surat' => 'Surat Keterangan Usaha',
                'deskripsi'  => 'Keterangan kepemilikan usaha warga.',
                'is_active'  => true,
            ],
            [
                'nama_surat' => 'Surat Keterangan Tidak Mampu',
                'deskripsi'  => 'Keterangan kondisi ekonomi warga.',
                'is_active'  => true,
            ],
            [
                'nama_surat' => 'Surat Pengantar',
                'deskripsi'  => 'Surat pengantar untuk keperluan administrasi.',
                'is_active'  => true,
            ],
            [
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'deskripsi'  => 'Keterangan kelahiran anak.',
                'is_active'  => true,
            ],
        ];

        foreach ($jenisSurat as $item) {
            JenisSurat::updateOrCreate(
                ['nama_surat' => $item['nama_surat']],
                $item
            );
        }
    }
}
