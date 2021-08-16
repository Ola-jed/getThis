<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PasteRequest
 * Creation of a paste: content and lifetime
 * @package App\Http\Requests
 */
class PasteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'    => 'string|required',
            'content'  => 'string|required',
            'lifetime' => 'integer|numeric|required'
        ];
    }
}
