<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccountUpdateRequest
 * @package App\Http\Requests
 */
class AccountUpdateRequest extends FormRequest
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
            'name'                 => 'string|required|max:25',
            'email'                => 'email|required',
            'initial_password'     => 'string|required',
            'new_password'         => 'same:new_password_confirm',
            'new_password_confirm' => 'same:new_password'
        ];
    }
}
