<?php

namespace App\Http\Requests\Api\Order;

use App\Models\Partner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => [
                'required',
                Rule::in([0, 10, 20]),
            ],
            'partner_id' => [
                'required',
                Rule::exists((new Partner)->getTable(), 'id'),
            ],
            'client_email' => [
                'required', 'email',
            ],
        ];
    }
}
