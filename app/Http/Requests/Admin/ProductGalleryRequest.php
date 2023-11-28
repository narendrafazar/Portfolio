<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
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
            // 'photos' => 'required|exists:products,id' ini artinya pada photos wajib diisi fieldnya dan mengandung table products di kolom id, 
            'products_id' => 'required|exists:products,id', 
            'photos' => 'required|image'
        ];
    }
}
