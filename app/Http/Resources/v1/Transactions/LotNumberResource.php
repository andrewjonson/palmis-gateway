<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class LotNumberResource extends JsonResource
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
            'id' => hashid_encode($this->inventory_id),
            'stock_card_id' => hashid_encode($this->stock_card_id),
            'lot_number' => $this->lot_number,
            'item' => $this->description,
            'quantity' => $this->temp_balance_qty
        ];
    }
}
