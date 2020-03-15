<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Partner\IndexRequest;
use App\Http\Resources\Api\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerController extends Controller
{
    public function index(IndexRequest $request): JsonResource
    {
        $partnersQuery = Partner::query();

        $partners = $request->isAll()
            ? $partnersQuery->get()
            : $partnersQuery->paginate($request->getPerPage());

        return PartnerResource::collection($partners);
    }
}
