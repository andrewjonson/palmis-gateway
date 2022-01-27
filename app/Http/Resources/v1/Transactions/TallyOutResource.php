<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class TallyOutResource extends JsonResource
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
            'quantity' => $this->item->quantity,
            'nomenclature' => new LotNumberResource($this->item->stockCard->inventory),
            'ui' => $this->item->stockCard->inventory->ammunitionNomenclature->ammunitionUom->name,
            'remarks' => $this->item->remarks,
            // 'received_from_signatory' => '',
            // 'received_by_signatory' => '',
            // 'noted_by_signatory' => '',
            // 'doc_setting' => '',
            // 'header' => 'By 2021, a word-class Army that is a source of national pride.',
            // 'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
