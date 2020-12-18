<?php

namespace App\Http\Requests;

use App\Enums\EntryType;
use App\Enums\Expire;
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
            'expires' => 'required|in:'.implode(',', Expire::asArray()),
            'password' => 'sometimes|nullable|min:3|max:255|string',
            'format' => 'required|in:'.implode(',', EntryType::asArray()),
            'content' => 'required|min:1|string',
        ];
    }
}
