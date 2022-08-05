<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|string',
//            'photo' => 'required|image',
            'password' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email je obavezan',
            'last_name.required' => 'prezime je obavezno',
            'first_name.required' => 'Ime je obavezno',
            'password.required' => 'Password je obavezan',
//            'photo.image' => 'slika je nedozvoljenog tipa',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $message = ['message' =>  $validator->errors()];
        throw new HttpResponseException(response()->json($message, 422));
    }
}
