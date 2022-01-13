<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\InventoryResource;

class StockCardResource extends JsonResource
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
            'stock_card_nr' => $this->stock_card_nr,
            'inventory' => $this->inventory ? new InventoryResource($this->inventory) : null,
            'entity_name' => $this->inventory->iar->entity_name,
            'fund_cluster' => $this->inventory->iar->fundCluster->name,
            'description' => $this->inventory->description
        ];
    }
}
