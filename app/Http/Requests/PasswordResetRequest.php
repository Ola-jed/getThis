<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PasswordResetRequest
 * Reset a password
 * @package App\Http\Requests
 */
class PasswordResetRequest extends FormRequest
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
            'email'                 => 'email|required',
            'token'                 => 'bail|required',
            'password'              => 'string|required|same:password_confirmation',
            'password_confirmation' => 'string|required|same:password'
        ];
    }
}
