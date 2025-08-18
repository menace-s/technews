<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'site_name'=> 'required|string|max:255',
        'site_logo'=> 'nullable|image|mimes:png,jpeg,jpg|max:2048',
        'contact_email'=> 'required|email|max:255',
        'contact_phone'=> 'nullable|string|max:20',
        'contact_address'=> 'nullable|string|max:255',
        'about'=> 'nullable|string',
        ];
    }
}
