<?php

namespace App\Http\Requests;

use App\Enums\EntryType;
use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:'.implode(',', EntryType::asArray()),
            'password' => 'sometimes|nullable|min:3|max:255|string',
            'content' => 'required|min:1|string',
        ];
    }
}
