<?php

namespace App\Http\Requests;

use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;

class PasienRequest extends FormRequest
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
         'select_jenis_anggota' => 'nullable',
         'tgl_lahir' => 'required|date_format:Y-m-d',
         'alamat' => 'required|string',
         // 'tinggi_badan' => 'nullable|numeric',
         'no_hp' => 'nullable|string|max:50',
         'jenis_kelamin' => 'required|string',
        
      ];
     
      return $rules;
   }
}
