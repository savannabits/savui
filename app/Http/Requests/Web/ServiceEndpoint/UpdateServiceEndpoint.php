<?php

namespace App\Http\Requests\Web\ServiceEndpoint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateServiceEndpoint extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('service-endpoint.edit', $this->serviceEndpoint);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', Rule::unique('service_endpoints', 'name')->ignore($this->serviceEndpoint->getKey(), $this->serviceEndpoint->getKeyName()), 'string'],
            'endpoint' => ['sometimes', Rule::unique('service_endpoints', 'endpoint')->ignore($this->serviceEndpoint->getKey(), $this->serviceEndpoint->getKeyName()), 'string'],
            'description' => ['nullable', 'string'],
            'enabled' => ['sometimes', 'boolean'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
