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
            'date' => $this->date,
            'reference' => $this->reference,
            'uom' => $this->stockCard->inventory->ammunitionNomenclature->ammunitionUom->name,
            'desciption' => $this->stockCard->inventory->description,
            'office' => $this->office,
            'receipt_qty' => $this->ris_id ? null : $this->stockCard->inventory->receipt_qty,
            'requisition_count' => $this->iar_id != null ? null : $this->balance,
            'issue_quantity' => $this->ris_id ? $this->quantity : null,
            'issue_remarks' => $this->ris_id ? $this->stockCard->issuanceDirectiveItem->remarks : null
        ];
    }
}
