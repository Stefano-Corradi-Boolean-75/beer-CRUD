<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeerRequest extends FormRequest
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
            'name' => 'required|min:3|max:150',
            'image' => 'required|min:10|max:255',
            'price' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=> 'Il nome è un campo obbligatorio',
            'name.min'=> 'Il nome deve avere almeno :min caratteri',
            'name.max'=> 'Il nome deve avere al massimo :max caratteri',
            'image.required'=> 'L\'immagine è un campo obbligatorio',
            'image.min'=> 'L\'immagine deve avere almeno :min caratteri',
            'image.max'=> 'L\'immagine deve avere al massimo :max caratteri',
            'price.required'=> 'Il prezzo è un campo obbligatorio',
        ];
    }
}
