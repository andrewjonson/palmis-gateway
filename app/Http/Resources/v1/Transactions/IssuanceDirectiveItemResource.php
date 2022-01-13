<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\StockCardResource;

class IssuanceDirectiveItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $amount = $this->quantity * $this->stockCard->inventory->unit_price;
        return [
            'id' => hashid_encode($this->id),
            'lot_number' => $this->stockCard->inventory->lot_number,
            'item' => $this->stockCard->inventory->description,
            'quantity' => $this->quantity,
            'unit_price' => $this->stockCard->inventory->unit_price,
            'amount' => number_format($amount),
            'temp_balance_qty' => $this->stockCard->inventory->temp_balance_qty,
            'entity_name' => $this->stockCard->inventory->iar->entity_name,
            'fund_cluster' => $this->stockCard->inventory->iar->fundCluster->name,
            'office' => $this->stockCard->inventory->iar->office->code,
            'responsibility_center_code' => $this->stockCard->inventory->iar->responsibilityCode->name,
            'stock_card' => $this->stockCard->stock_card_nr,
            'description' => $this->stockCard->inventory->description,
            'remarks' => $this->remarks
        ];
    }
}
