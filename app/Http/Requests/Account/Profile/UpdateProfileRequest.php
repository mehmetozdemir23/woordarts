<?php

namespace App\Http\Requests\Account\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
            [
                'user-username' => 'required|min:2',
                'user-firstname' => 'required|min:2',
                'user-lastname' => 'required|min:2',
                'password' => 'nullable|confirmed|min:8'
            ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user-username' => 'username',
            'user-firstname' => 'first name',
            'user-lastname' => 'last name',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute is required',
        ];
    }

    protected $redirectRoute = 'account.profile.index';
}
