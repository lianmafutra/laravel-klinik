<?php
namespace App\Http\Requests;
use App\Services\UserServices;
use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;
class MasterAnggotaRequest extends FormRequest
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
         'jenis' => 'required|in:personil,siswa',
         'user_id' => 'nullable|integer',
         'nrp' => 'nullable|string|max:50',
         'pangkat' => 'nullable|string|max:50',
         'jabatan' => 'nullable|string|max:50',
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
