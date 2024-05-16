<?php

namespace App\Http\Requests;

use App\Services\UserServices;
use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;

class MasterDataUserRequest extends FormRequest
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
         'password' => bcrypt($this->password),
      ];

      if ($this->jenis_user == "personil") {
         $merges['username'] = $this->nik;
      } else if ($this->jenis_user == "siswa") {
         $merges['username'] = $this->nrp;
      }
      else if ($this->jenis_user == "pimpinan") {
         $merges['username'] = "pimpinan";
      }
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
         'name' => 'required',
         'jenis_user' => 'required|in:personil,siswa,pimpinan',
         'user_id' => 'nullable|integer',
         'nrp' => 'nullable|string|max:50',
         'pangkat' => 'nullable|string|max:50',
         'jabatan' => 'nullable|string|max:50',
         'nik' => 'nullable|string|max:50',
         'agama' => 'nullable|string|max:100',
         'tmpt_lahir' => 'nullable|string|max:50',
         'tgl_lahir' => 'nullable|date_format:Y-m-d',
         'alamat' => 'nullable|string',
         'tinggi_badan' => 'nullable|numeric',
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
