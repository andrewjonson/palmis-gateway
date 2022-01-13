<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class RisItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $amount = $this->stockCard->inventory->quantity * $this->stockCard->inventory->unit_price;
        return [
            'id' => hashid_encode($this->id),
            'stock_card_nr' => $this->stockCard->stock_card_nr,
            'uom' => $this->stockCard ? $this->stockCard->inventory->ammunitionNomenclature->ammunitionUom->description : null,
            'description' => $this->stockCard->inventory->description,
            'requisition_qty' => $this->stockCard->inventory->quantity,
            'issue_qty' => $this->quantity,
            'amount' => $amount,
            'remarks' => $this->remarks
        ];
    }
}
