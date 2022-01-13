<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\WarehouseResource;

class UserWarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => hashid_encode($this->id),
            'pmcode' => $this->pmcode,
            'warehouse' => new WarehouseResource($this->warehouse)
        ];
     }
}
