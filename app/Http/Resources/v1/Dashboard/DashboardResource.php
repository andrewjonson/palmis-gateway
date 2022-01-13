<?php

namespace App\Http\Resources\v1\Dashboard;

use App\Services\ApiService\v1\ToeisService;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Dashboard\DashboardIdResource;
use App\Http\Resources\v1\Transactions\IssuanceDirectiveItemResource;

class DashboardResource extends JsonResource
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
        $fetchPamu = $unit->getToggleUnitName(hashid_encode($this->pamu_id));
        return [
            'id' => hashid_encode($this->id),
            'pamu' => $fetchPamu->{'original'}['data'],
            'items' => DashboardIdResource::collection($this->issuanceDirectiveItem),
        ];
    }
}
