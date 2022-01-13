<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\SupplierResource;
use App\Http\Resources\v1\Transactions\InventoryResource;

class PrintTallyInResource extends JsonResource
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
            'tally_in_date' => $this->tallyIn ? $this->tallyIn->tally_in_date : null,
            'supplier' => $this->tallyIn ? $this->tallyIn->supplier->name : null,
            'nomenclature' => $this->nomenclature,
            'lot_number' => $this->lot_number,
            'uom' => $this->uom ? $this->uom->name : null,
            'condition' => $this->condition ? $this->condition->code : null,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price
        ];
    }
}
