<?php

namespace App\Http\Resources\v1\References\FpaoUnit;

use App\Services\ApiService\v1\ToeisService;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $unit = new ToeisService;
        $fetchUnit = $unit->getUnitById(hashid_encode($this->unit_id));
        
        return [
            'id' => hashid_encode($this->id),
            'unit' => $this->unit
            // 'unit_id' => $fetchUnit->{'original'}['data']['id'],
            // 'unit_short_description' => $fetchUnit->{'original'}['data']['short_description'],
            // 'unit_long_description' => $fetchUnit->{'original'}['data']['long_description']
        ];
    }
}
