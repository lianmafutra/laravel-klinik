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
   }
   public function rules(): array
   {
      $rules = [
         'nama' => 'required',
         'spesialis' => 'required',
         'jenis_kelamin' => 'required|in:P,L',
         'alamat' => 'nullable|string',
         'no_hp' => 'nullable|string|max:50',
         'no_bpjs' => 'nullable|string|max:50',
      ];
      return $rules;
   }
}
