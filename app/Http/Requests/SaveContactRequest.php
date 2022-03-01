<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string'],
            'contact_image' => ['nullable', 'image'],
            'email' => ['required', 'email'],
            'google_map_url' => ['required', 'url'],
            'phone' => ['required', 'string'],
        ];
    }
}
