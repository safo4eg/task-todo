<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:128'],
            'content' => ['sometimes', 'string', 'max:1024'],
            'tags' => ['sometimes', 'array', 'min:1'],
            'tags.*' => ['string', 'max:8']
        ];
    }
}
