<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use App\Models\PersyaratanSurat;
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
                'deskripsi'  => 'Keterangan tempat tinggal masyarakat.',
                'body_template' => '<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa {nama_desa}, {kecamatan}, {kabupaten} menerangkan bahwa :</p>
<div class="data-pemohon">
    <table>
        <tr><td>Nama</td><td>:</td><td><strong>{nama}</strong></td></tr>
        <tr><td>No. KK</td><td>:</td><td>{no_kk}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{nik}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{ttl}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{jenis_kelamin}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{pekerjaan}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{alamat}</td></tr>
    </table>
</div>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili di wilayah Desa {nama_desa}, {kecamatan}, {kabupaten}.</p>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Keterangan Domisili ini diberikan kepada yang bersangkutan untuk dipergunakan sebagai <strong>{keperluan}</strong>.</p>',
                'persyaratan' => [
                    ['nama_field' => 'Keperluan', 'tipe_field' => 'text', 'is_required' => true]
                ]
            ],
            [
                'nama_surat' => 'Surat Keterangan Usaha',
                'deskripsi'  => 'Keterangan kepemilikan usaha masyarakat.',
                'body_template' => '<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa {nama_desa}, {kecamatan}, {kabupaten} menerangkan bahwa :</p>
<div class="data-pemohon">
    <table>
        <tr><td>Nama</td><td>:</td><td><strong>{nama}</strong></td></tr>
        <tr><td>No. KK</td><td>:</td><td>{no_kk}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{nik}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{ttl}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{jenis_kelamin}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{pekerjaan}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{alamat}</td></tr>
    </table>
</div>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama tersebut diatas adalah benar merupakan masyarakat Desa {nama_desa} dan benar-benar mempunyai usaha dengan jenis usaha <strong>{nama_usaha}</strong> yang bertempat di Desa {nama_desa}, {kecamatan}, {kabupaten}.</p>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Keterangan Usaha ini diberikan untuk keperluan <strong>{keperluan}</strong>.</p>',
                'persyaratan' => [
                    ['nama_field' => 'Nama Usaha', 'tipe_field' => 'text', 'is_required' => true],
                    ['nama_field' => 'Keperluan', 'tipe_field' => 'text', 'is_required' => true]
                ]
            ],
            [
                'nama_surat' => 'Surat Keterangan Tidak Mampu',
                'deskripsi'  => 'Keterangan kondisi ekonomi masyarakat.',
                'body_template' => '<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa {nama_desa}, {kecamatan}, {kabupaten} menerangkan bahwa :</p>
<div class="data-pemohon">
    <table>
        <tr><td>Nama</td><td>:</td><td><strong>{nama}</strong></td></tr>
        <tr><td>No. KK</td><td>:</td><td>{no_kk}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{nik}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{ttl}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{jenis_kelamin}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{pekerjaan}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{alamat}</td></tr>
    </table>
</div>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama tersebut diatas adalah benar Penduduk Desa {nama_desa} dan nama tersebut diatas merupakan keluarga <strong>Tidak Mampu</strong>.</p>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adapun penghasilan per bulan yang bersangkutan adalah kurang lebih <strong>{penghasilan}</strong>.</p>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Keterangan Tidak Mampu ini dibuat untuk dipergunakan sebagai <strong>{keperluan}</strong>.</p>',
                'persyaratan' => [
                    ['nama_field' => 'Penghasilan', 'tipe_field' => 'number', 'is_required' => true],
                    ['nama_field' => 'Keperluan', 'tipe_field' => 'text', 'is_required' => true]
                ]
            ],
            [
                'nama_surat' => 'Surat Pengantar',
                'deskripsi'  => 'Surat pengantar untuk keperluan administrasi.',
                'body_template' => '<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa {nama_desa}, {kecamatan}, {kabupaten} menerangkan bahwa :</p>
<div class="data-pemohon">
    <table>
        <tr><td>Nama</td><td>:</td><td><strong>{nama}</strong></td></tr>
        <tr><td>No. KK</td><td>:</td><td>{no_kk}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{nik}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{ttl}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{jenis_kelamin}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{pekerjaan}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{alamat}</td></tr>
    </table>
</div>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili di Desa {nama_desa}, {kecamatan}, {kabupaten}.</p>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan keperluan untuk <strong>{keperluan}</strong>, maka dengan ini kami menerangkan bahwa yang bersangkutan adalah masyarakat kami dan kami merekomendasikan untuk diproses lebih lanjut sesuai ketentuan yang berlaku.</p>',
                'persyaratan' => [
                    ['nama_field' => 'Keperluan', 'tipe_field' => 'text', 'is_required' => true]
                ]
            ],
            [
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'deskripsi'  => 'Keterangan kelahiran anak.',
                'body_template' => '<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa {nama_desa}, {kecamatan}, {kabupaten} menerangkan bahwa :</p>
<div class="data-pemohon">
    <table>
        <tr><td>Nama Ibu</td><td>:</td><td><strong>{nama_ibu}</strong></td></tr>
        <tr><td>No. KK</td><td>:</td><td>{no_kk}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{nik}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{alamat}</td></tr>
    </table>
</div>
<p class="isi-surat">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menerangkan bahwa telah lahir seorang anak dari pasangan suami istri {nama_ayah} dan {nama_ibu} :</p>
<div class="data-pemohon" style="margin-left: 30px;">
    <table>
        <tr><td>Nama Anak</td><td>:</td><td><strong>{nama_anak}</strong></td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{ttl_anak}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{jenis_kelamin_anak}</td></tr>
    </table>
</div>',
                'persyaratan' => [
                    ['nama_field' => 'Nama Anak', 'tipe_field' => 'text', 'is_required' => true],
                    ['nama_field' => 'Tempat Lahir Anak', 'tipe_field' => 'text', 'is_required' => true],
                    ['nama_field' => 'Tanggal Lahir Anak', 'tipe_field' => 'date', 'is_required' => true],
                    ['nama_field' => 'Jenis Kelamin Anak', 'tipe_field' => 'text', 'is_required' => true],
                    ['nama_field' => 'Nama Ibu', 'tipe_field' => 'text', 'is_required' => true],
                    ['nama_field' => 'Nama Ayah', 'tipe_field' => 'text', 'is_required' => true]
                ]
            ],
        ];

        foreach ($jenisSurat as $item) {
            $surat = JenisSurat::updateOrCreate(
                ['nama_surat' => $item['nama_surat']],
                [
                    'deskripsi'     => $item['deskripsi'],
                    'body_template' => $item['body_template'],
                    'is_active'     => true,
                ]
            );

            if (isset($item['persyaratan'])) {
                // Clear old requirements to avoid duplicate inserts on re-running seeder
                PersyaratanSurat::where('jenis_surat_id', $surat->id_jenis_surat)->delete();
                foreach ($item['persyaratan'] as $req) {
                    $surat->persyaratanSurat()->create($req);
                }
            }
        }
    }
}
