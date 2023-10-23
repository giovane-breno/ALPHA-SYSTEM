<?php

namespace App\Http\Resources\BenefitType;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BenefitTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        $pagination = new PaginationResource($this);
        return [
            'info' => $this->collection,
            'paginate' => $pagination,
        ];
    }
}