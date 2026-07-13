<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GformLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gform_link' => [
                'nullable',
                'url',
                function ($attribute, $value, $fail) {
                    $parsed = parse_url($value);
                    $host = isset($parsed['host']) ? preg_replace('/^www\./', '', strtolower($parsed['host'])) : '';
                    $path = isset($parsed['path']) ? $parsed['path'] : '';

                    $isValid = false;
                    if ($host === 'forms.gle') {
                        $isValid = true;
                    } elseif ($host === 'docs.google.com' && str_starts_with($path, '/forms')) {
                        $isValid = true;
                    }

                    if (!$isValid) {
                        $fail('Tautan pendaftaran harus merupakan domain Google Form yang valid (docs.google.com/forms atau forms.gle).');
                    }
                },
            ],
        ];
    }
}
