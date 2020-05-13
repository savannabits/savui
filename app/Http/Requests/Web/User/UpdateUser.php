<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user.edit', $this->user);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['nullable', 'confirmed', 'min:7', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/', 'string'],
            'first_name' => ['sometimes', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['sometimes', 'string'],
            'dob' => ['nullable', 'string'],
            'gender' => ['nullable', 'string'],
            'username' => ['sometimes', Rule::unique('users', 'username')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'guid' => ['nullable', Rule::unique('users', 'guid')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'domain' => ['nullable', 'string'],
                
            'roles' => ['sometimes', 'array'],
                
        ];

        if(Config::get('admin-auth.activation_enabled')) {
            $rules['activated'] = ['required', 'boolean'];
        }

        return $rules;
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getModifiedData(): array
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        if (!Config::get('admin-auth.activation_enabled')) {
            $data['activated'] = true;
        }
        if (array_key_exists('password', $data) && empty($data['password'])) {
            unset($data['password']);
        }
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}
