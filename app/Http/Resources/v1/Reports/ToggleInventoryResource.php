<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class ToggleInventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $amount = $this->quantity * $this->unit_price;
        return [
            'id' => hashid_encode($this->id),
            'description' => $this->description,
            'uom' => $this->ammunitionNomenclature->ammunitionUom->name,
            'unit_price' => $this->unit_price,
            'lot_number' => $this->lot_number,
            'condition' => $this->condition->code,
            'manufacturer' => $this->manufacturer->description,
            'quantity' => $this->quantity,
            'amount' => $amount
        ];
    }
}
