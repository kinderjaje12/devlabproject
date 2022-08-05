<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreInstrumentCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:instrument_categories,name|max:255',
            'photo' => 'image|required'
        ];
    }

    public function  messages(): array
    {
        return [
            'name.required' => 'Naziv kategorije je obavezan',
            'name.unique' => 'Vec postoji kategorija sa tim imenom',
            'name.max' => 'Naziv kategorije je predug',
            'photo.required' => 'Slika je obavezna',
            'photo.image' => 'Nedozvoljeni tip'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $message = ['message' =>  $validator->errors()];
        throw new HttpResponseException(response()->json($message, 422));
    }
}
