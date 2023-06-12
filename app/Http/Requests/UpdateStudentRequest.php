<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'wali_id' => 'nullable',
            'name' => 'required',
            'nisn' => 'required|unique:students,nisn,' . $this->student,
            'jurusan' => 'required',
            'kelas' => 'required',
            'angkatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2000'
        ];
    }
}
