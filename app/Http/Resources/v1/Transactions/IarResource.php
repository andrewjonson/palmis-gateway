<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\OfficeResource;
use App\Http\Resources\v1\Transactions\TallyInResource;
use App\Http\Resources\v1\References\FundClusterResource;
use App\Http\Resources\v1\References\ResponsibilityCodeResource;

class IarResource extends JsonResource
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
            'is_iar' => $this->tallyIn->is_iar,
            'supplier' => $this->tallyIn->supplier->name,
            'tally_in' => $this->tallyIn ? new TallyInResource($this->tallyIn) : null,
            'iar_nr' => $this->iar_nr,
            'entity_name' => $this->entity_name,
            'date' => $this->date,
            'po_nr' => $this->po_nr,
            'fund_cluster' => $this->fundCluster ? new FundClusterResource($this->fundCluster) : null,
            'invoice_nr' => $this->invoice_nr,
            'invoice_date' => $this->invoice_date,
            'office' => new OfficeResource($this->office),
            'responsibility_code' => new ResponsibilityCodeResource($this->responsibilityCode),
            'inventory' => InventoryResource::collection($this->inventory)
        ];
    }
}
