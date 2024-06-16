<?php

namespace App\Http\Requests;

use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;

class PemeriksaanRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
      return true;
   }
   protected function prepareForValidation(): void
   {
      $merges = [
         // 'category_multi_id' => json_encode($this->category_multi_id),
         'tgl_pemeriksaan' => DateUtils::format($this->tgl_pemeriksaan),
      ];

      $this->merge($merges);
   }
   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {


      $rules = [
         'tindakan_array_id' => 'required|array',
         'nomor_pemeriksaan' => 'required|string|max:50',
         'pasien_id' => 'required|max:50',
         'dokter_id' => 'required|integer',
         'riwayat_penyakit' => 'nullable|string|max:500',
         'catatan' => 'nullable|string|max:500',
         'berat_badan' => 'nullable|numeric|min:0',
         'tgl_pemeriksaan' => 'nullable|date',
         'keluhan' => 'nullable|string',
         'tensi' => 'nullable|string',
         'denyut_nadi' => 'nullable|string',
         'suhu' => 'nullable|string',
         'nafas' => 'nullable|string',
         'diagnosis' => 'nullable|string',
         'rujukan_no' => 'nullable|string',
         'rujukan_ket' => 'nullable|string',
         'rujukan_tujuan' => 'nullable|string',
         'status_pemeriksaan' => 'required|string',
         'tinggi_badan' => 'nullable|required',
         'spo2' => 'nullable',
      ];

      return $rules;
   }
}
