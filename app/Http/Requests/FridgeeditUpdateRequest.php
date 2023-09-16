<?php

namespace App\Http\Requests;

use App\Models\Fridge;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FridgeeditUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'telephone' => ['string', 'max:20'],
        ];
    }
}
