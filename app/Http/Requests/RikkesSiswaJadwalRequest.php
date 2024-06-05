<?php

namespace App\Http\Requests;

use App\Utils\DateUtils;
use Illuminate\Foundation\Http\FormRequest;

class RikkesSiswaJadwalRequest extends FormRequest
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
          'tgl' => DateUtils::format($this->tgl),
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
         'nama' => 'required',
         'tgl' => 'required',
         'angkatan_id' => 'required',
      ];

      return $rules;
    }
}
