<?php

namespace App\Http\Requests\Api\Partner;

use App\Http\Requests\Api\Paginationable;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    use Paginationable;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
