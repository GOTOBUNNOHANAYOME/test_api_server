<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image_file' => [
                'required',
                'file',
                'image',
                'mimes:jpg,gif,png,webp',
                'max:2048'
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'image_file' => '画像ファイル'
        ];
    }
}
