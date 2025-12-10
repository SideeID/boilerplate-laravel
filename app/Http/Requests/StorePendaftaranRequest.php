<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePendaftaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_lowongan' => ['required', 'integer', 'exists:master_lowongans,id'],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:male,female'],
            'dob' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string', 'max:100'],
            'no_telp' => ['required', 'string', 'max:100'],
            'university' => ['required', 'string', 'max:100'],
            'major' => ['required', 'string', 'max:100'],
            'ipk' => ['required', 'numeric', 'min:0', 'max:4'],
            'cv_file' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ];
    }
}
