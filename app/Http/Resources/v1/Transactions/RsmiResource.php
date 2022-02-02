<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Support\Arr;
use App\Models\v1\Transactions\Ris;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\v1\Transactions\IssuanceDirective;
use App\Http\Resources\v1\Transactions\RisResource;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use App\Http\Resources\v1\Transactions\RisItemResource;
use App\Http\Resources\v1\Transactions\RsmiItemResource;
use App\Http\Resources\v1\References\FundClusterResource;

class RsmiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $issuanceDirectiveId = $this->issuanceDirectives ? $this->issuanceDirectives()->pluck('id') : null;
        $stdId = $this->std ? $this->std->id : null;
        return [
            'id' => hashid_encode($this->id),
            'entity_name' => $this->entity_name,
            'date' => $this->date,
            'po_nr' => $this->po_nr,
            'fund_cluster' => $this->fundCluster ? new FundClusterResource($this->fundCluster) : null,
            'ris' => RsmiItemResource::collection($this->inventory)
        ];
    }
}
