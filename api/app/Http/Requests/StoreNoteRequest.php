<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:128'],
            'content' => ['required', 'string', 'max:1024'],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['string', 'max:8']
        ];
    }
}
