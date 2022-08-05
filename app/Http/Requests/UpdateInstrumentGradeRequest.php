<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateInstrumentGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'grade' => 'required|min:1|max:5'
        ];
    }

    public function messages()
    {
        return [
            'grade.required' => 'Ocjena je obavezna',
            'grade.min' => 'Minimalna ocjena je 1',
            'grade.max' => 'Maximalna ocjena je 5'
        ];
    }
}
