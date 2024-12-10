<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class SectionRequest extends FormRequest
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
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => '  برجاء ادخال اسم القسم ',
            'section_name.unique' => 'هذا القسم موجود بالفعل',
            'section_name.max' => 'لقد تجاوزت الحد الاقصي ',

            'description.required' => ' برجاء ادخال  الوصف',
        ];
    }
}
