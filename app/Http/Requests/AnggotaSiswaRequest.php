<?php

namespace App\Http\Requests;

use App\Models\AnggotaSiswa;
use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;

class AnggotaSiswaRequest extends FormRequest
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
         'tgl_lahir' => DateUtils::format($this->tgl_lahir),
        
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
      $rules =  [
         'nama' => 'required',
         'user_id' => 'nullable|integer',
         'angkatan_id' => 'nullable|integer',
         'nosis' => 'nullable|string|max:50',
         'nik' => 'nullable|string|max:50',
         'agama' => 'nullable|string|max:100',
         'tempat_lahir' => 'nullable|string|max:50',
         'tgl_lahir' => 'nullable|date_format:Y-m-d',
         'alamat' => 'nullable|string',
         'tinggi_badan' => 'nullable|numeric',
         'no_hp' => 'nullable|string|max:50',
         'no_bpjs' => 'nullable|string|max:50',
      ];
     
      return $rules;
   }
}
