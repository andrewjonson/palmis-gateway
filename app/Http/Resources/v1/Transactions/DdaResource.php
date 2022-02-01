<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\DdaPackedResource;

class DdaResource extends JsonResource
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
            'depot' => $this->depot,
            'date' => $this->date,
            'lot_nr' => $this->lot_nr,
            'packed' => $this->packed,
            'fsn' => $this->fsn,
            'past_storage' => $this->past_storage,
            'current_storage' => $this->current_storage,
            'lot_received_from' => $this->lot_received_from,
            'date_last_inspected' => $this->date_last_inspected,
            'date_inspected' => $this->date_inspected,
            'sample_size' => $this->sample_size,
            'quantity_storage' => $this->quantity_storage,
            'box' => $this->box,
            'strapping' => $this->strapping,
            'marking' => $this->marking,
            'carton' => $this->carton,
            'others' => $this->others,
            'packs' => DdaPackedResource::collection($this->ddaPacks)
        ];
    }
}
