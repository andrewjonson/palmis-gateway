<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\FpaoResource;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;

class FpaoUnitResource extends JsonResource
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
            'fpao' => new FpaoResource($this->fpao),
            'unit' => $this->unit
        ];
    }
}
