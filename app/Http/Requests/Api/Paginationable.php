<?php

namespace App\Http\Requests\Api;

trait Paginationable
{
    public function getPerPage()
    {
        return $this->input('per_page', 30);
    }
}
