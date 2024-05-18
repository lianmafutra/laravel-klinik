<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterDataDokterRequest extends FormRequest
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
      $this->merge([
         'username' =>  $this->nik,
         'password' => bcrypt($this->password),
      ]);
   }


   public function rules(): array
   {
      $rules = [
         'nama' => 'required',
         'spesialis' => 'required',
         'jenis_kelamin' => 'required|in:P,L',
         'user_id' => 'nullable|integer',
         'nik' => 'nullable|string|max:50',
         'alamat' => 'nullable|string',
         'no_hp' => 'nullable|string|max:50',
         'no_bpjs' => 'nullable|string|max:50',
      ];


      if ($this->isMethod('PUT')) {
         $rules['password'] = 'nullable';
         $rules['username'] = 'nullable';
      }
      if ($this->isMethod('POST')) {
         $rules['password'] = 'required';
         $rules['username'] = 'required';
      }


    
      return $rules;
   }
}
