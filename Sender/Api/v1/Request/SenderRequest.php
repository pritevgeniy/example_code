<?php

namespace App\Http\Api\v1\Controllers\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $email
 */
class SenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email'
            ],
        ];
    }

    public function getDto(): SenderDto
    {
        return new SenderDto(
            name: $this->name,
            email: $this->email
        );
    }
}
