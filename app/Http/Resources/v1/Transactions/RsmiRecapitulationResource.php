<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class RsmiRecapitulationResource extends JsonResource
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
            'stock_number' => $this->lot_number,
            'quantity' => $this->stockCard->issuanceDirectiveItem->quantity,
            'unit_cost' => $this->unit_price,
            'total_cost' => number_format($this->stockCard->issuanceDirectiveItem->quantity * $this->unit_price, 2)
        ];
    }
}
