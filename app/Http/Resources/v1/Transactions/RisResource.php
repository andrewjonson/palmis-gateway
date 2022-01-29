<?php

namespace App\Http\Resources\v1\Transactions;

use App\Models\v1\Transactions\StdItem;
use App\Services\ApiService\v1\ToeisService;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\StdResource;
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
            'entity_name' => $this->issuanceDirective ? $this->issuanceDirective->iar->entity_name : $this->std->iar->entity_name,
            'fund_cluster' => $this->issuanceDirective ? new FundClusterResource($this->issuanceDirective->iar->fundCluster) : new FundClusterResource($this->std->iar->fundCluster),
            'issuance_directive' => $this->issuanceDirective ? new IssuanceDirectiveResource($this->issuanceDirective) : null,
            'std' => $this->std ? new StdResource($this->std) : null,
            // 'division' => $fetchPamu->{'original'}['data'],
            'responsibility_center_code' => $this->issuanceDirective ? new ResponsibilityCodeResource($this->issuanceDirective->iar->responsibilityCode) : $this->std->iar->responsibilityCode,
            'purpose' => $this->issuanceDirective ? $this->issuanceDirective->issuancePurpose->name : $this->std->issuanceDirectivePurpose->name,
            'items' => $this->issuance_directive_id ? RisItemResource::collection(IssuanceDirectiveItem::where('issuance_directive_id', $this->issuance_directive_id)->get()) : RisItemResource::collection(StdItem::where('std_id', $this->std_id)->get())
        ];
    }
}
