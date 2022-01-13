<?php

namespace App\Http\Resources\v1\Transactions;

use App\Services\ApiService\v1\ToeisService;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $unit = new ToeisService;
        $fetchPamu = $unit->getToggleUnitName(hashid_encode($this->issuanceDirective->pamu_id));
        
        return [
            'id' => hashid_encode($this->id),
            'ris_nr' => $this->ris_nr,
            'status' => $this->status,
            'issuance_directive' => new IssuanceDirectiveResource($this->issuanceDirective),
            'division' => $fetchPamu->{'original'}['data'],
            'purpose' => $this->issuanceDirective->issuancePurpose->name
        ];
    }
}
