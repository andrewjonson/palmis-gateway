<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\RegionResource;

class ProvinceResource extends JsonResource
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
            'region' => new RegionResource($this->region),
            'code' => $this->code,
            'description' => $this->description
        ];
    }
}
