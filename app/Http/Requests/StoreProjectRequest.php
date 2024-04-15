<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id',
            'image' => 'nullable|image'
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Dai un titolo al progetto',
            'title.string' => 'Il titolo non puo contenere numeri',
            'title.max' => 'Il titolo puo contenere {max} caratteri',
            'description.required' => 'Dai una descrizione al progetto',
            'technologies.exists' => 'le technologies selezionati non sono validi',
        ];
    }
}
