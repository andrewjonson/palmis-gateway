<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class StdItemResource extends JsonResource
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
            'lot_number' => $this->inventory->lot_number,
            'nomenclature' => $this->inventory->ammunitionNomenclature->ammunition_name,
            'qty' => $this->inventory->quantity,
            'cognizant_fpao' => $this->cognizantFpao->name,
            'receiving_fpao' => $this->receivingFpao->name,
            'cognizant_fssu' => $this->cognizantFssu->name,
            'receiving_fssu' => $this->receivingFssu->name
        ];
    }
}
