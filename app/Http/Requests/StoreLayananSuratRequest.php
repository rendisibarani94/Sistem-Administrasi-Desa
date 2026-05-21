<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLayananSuratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_surat' => ['required', 'integer', 'exists:jenis_surat,id_jenis_surat'],
            'keterangan' => ['required', 'string', 'max:1000'],
            'id_penduduk' => ['required', 'integer', 'exists:penduduk,id_penduduk'],
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_surat.required' => 'Jenis surat wajib diisi.',
            'jenis_surat.integer' => 'Jenis surat harus berupa ID numerik.',
            'jenis_surat.exists' => 'Jenis surat tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
            'id_penduduk.required' => 'ID penduduk wajib diisi.',
            'id_penduduk.integer' => 'ID penduduk harus berupa angka.',
            'id_penduduk.exists' => 'ID penduduk tidak ditemukan.',
        ];
    }
}
