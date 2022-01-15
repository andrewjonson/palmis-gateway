<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\v1\References\AmmunitionNomenclature;
use App\Http\Resources\v1\Transactions\RpciItemResource;
use App\Http\Resources\v1\References\AmmunitionNomenclatureResource;

class RpciResource extends JsonResource
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
            'fund_cluster' => $this->fundCluster->name,
            'accountable_officer' => $this->accountable_officer,
            'officer_designation' => $this->officer_designation,
            'entity_name' => $this->entity_name,
            'items' => RpciItemResource::collection($this->inventory)
        ];
    }
}
