<?php

namespace App\Http\Requests;

use App\Enums\Expires;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasteStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'expires' => [
                'required',
                Rule::enum(Expires::class),
            ],
            'password' => 'nullable|string|max:255',
            'content' => 'required|string',
        ];
    }
}
