<?php

namespace App\Http\Requests;

use App\Helpers\Expires;
use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'expires' => 'required|in:'.implode(',', Expires::all()->pluck("name")->toArray()),
            'password' => 'sometimes|nullable|min:3|max:255|string',
            'content' => 'required|min:1|string',
        ];
    }
}
