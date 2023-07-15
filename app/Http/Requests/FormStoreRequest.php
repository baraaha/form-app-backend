<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormStoreRequest extends FormRequest
{
    public function authorize()
    {
        // TODO: Update it according to your authorization rules
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required',
            'submission_limit' => 'nullable|numeric',
            'allow_notifications' => 'required',
            'published' => 'required',
            'published_at' => 'nullable|date',
            'expires_at' => 'required',
            'elements' => 'required',
        ];
    }
}
