<?php
namespace App\Http\Requests;

use App\Utils\DateUtils;
use App\Utils\Rupiah;
use Illuminate\Foundation\Http\FormRequest;
class MasterObatRequest extends FormRequest
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
         'harga' =>  Rupiah::clean($this->harga),
         'tgl_expired' => DateUtils::format($this->tgl_expired),
      ]);

    
   }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
   {
      $rules = [
         'kode_obat' => 'nullable',
         'keterangan' => 'nullable',
         'tgl_expired' => 'nullable',
         'nama' => 'required',
         'harga' => 'required',
         'stok' => 'required|integer',
      ];
      return $rules;
   }
}
