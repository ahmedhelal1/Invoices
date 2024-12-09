<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'product_name' => 'required|unique:products|max:255',
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => '  برجاء ادخال اسم النتج ',
            'product_name.unique' => 'هذا المنتج موجود بالفعل',
            'product_name.max' => 'لقد تجاوزت الحد الاقصي ',

            'description.required' => ' برجاء ادخال  الوصف',
        ];
    }
}
