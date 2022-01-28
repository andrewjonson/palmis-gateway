<?php

namespace App\Http\Resources\v1\Transactions;

use App\Services\ApiService\v1\ToeisService;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use App\Http\Resources\v1\Transactions\RisItemResource;
use App\Http\Resources\v1\References\FundClusterResource;
use App\Http\Resources\v1\References\ResponsibilityCodeResource;
use App\Http\Resources\v1\Transactions\IssuanceDirectiveResource;

class RisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $unit = new ToeisService;
        // $fetchPamu = $unit->getToggleUnitName(hashid_encode($this->issuanceDirective->pamu_id));
        
        return [
            'id' => hashid_encode($this->id),
            'ris_nr' => $this->ris_nr,
            'status' => $this->status,
            'entity_name' => $this->issuanceDirective->iar->entity_name,
            'fund_cluster' => new FundClusterResource($this->issuanceDirective->iar->fundCluster),
            'issuance_directive' => new IssuanceDirectiveResource($this->issuanceDirective),
            // 'division' => $fetchPamu->{'original'}['data'],
            'responsibility_center_code' => new ResponsibilityCodeResource($this->issuanceDirective->iar->responsibilityCode),
            'purpose' => $this->issuanceDirective->issuancePurpose->name,
            'items' => RisItemResource::collection(IssuanceDirectiveItem::where('issuance_directive_id', $this->issuance_directive_id)->get())
        ];
    }
}
