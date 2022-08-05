<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInstrumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ["max:255",Rule::unique('instruments')->ignore($this->route('instrument')->id)],
            'price' => 'required|min:0.1',
            'photo' => 'image',
            'description' => 'required',
            'instrument_category_id' => 'required|exists:instrument_categories,id',
            'quantity' => 'required|min:1',
            'weight' => 'required',
            'color' => 'required',
            'dimensions' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Ime je predugo',
            'name.unique' => 'Vec postoji isntrument sa tim imenom',
            'photo.image' => 'Nedozvoljeni tip slike',
            'description.required' => 'Opis je obavezan',
            'instrument_category_id.required' => 'Kategorija instrumenta je obavezna',
            'instrument_category_id.exists' => 'Kategorija instrumenta nije validna',
            'quantity' => 'Kolicina je obavezna',
            'weight.required' => 'tezina je obavezna',
            'dimensions.required' => 'dimenzije su obavezne',
            'color.required' => 'boja je obavezna'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $message = ['message' =>  $validator->errors()];
        throw new HttpResponseException(response()->json($message, 422));
    }
}
