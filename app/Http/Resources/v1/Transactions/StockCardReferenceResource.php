<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class StockCardReferenceResource extends JsonResource
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
            'reference' => $this->reference,
            'uom' => $this->stockCard->inventory->ammunitionNomenclature->ammunitionUom->name,
            'desciption' => $this->stockCard->inventory->description,
            'office' => $this->office,
            'requisition_count' => $this->stockCard->inventory->quantity,
            'issue_quantity' => $this->ris_id ? $this->stockCard->issuanceDirectiveItem->quantity : null,
            'issue_remarks' => $this->ris_id ? $this->stockCard->issuanceDirectiveItem->remarks : null
        ];
    }
}
