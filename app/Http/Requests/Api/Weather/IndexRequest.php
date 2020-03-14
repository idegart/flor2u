<?php

namespace App\Http\Requests\Api\Weather;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lat' => [
                'required',
                'numeric',
            ],
            'lon' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function getLat()
    {
        return $this->input('lat');
    }

    public function getLon()
    {
        return $this->input('lon');
    }
}
