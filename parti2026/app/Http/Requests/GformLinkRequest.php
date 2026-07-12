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
                    $allowedDomains = config('parti.gform_domains', ['docs.google.com/forms', 'forms.gle']);
                    $isValid = false;
                    foreach ($allowedDomains as $domain) {
                        if (str_contains($value, $domain)) {
                            $isValid = true;
                            break;
                        }
                    }
                    if (!$isValid) {
                        $fail('Tautan pendaftaran harus merupakan domain Google Form yang valid (docs.google.com/forms atau forms.gle).');
                    }
                },
            ],
        ];
    }
}
