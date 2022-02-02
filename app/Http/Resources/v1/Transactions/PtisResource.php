<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\PtisItemsResource;

class PtisResource extends JsonResource
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
            'to' => $this->to,
            'from' => $this->from,
            'turn_in_slip_nr' => $this->turn_in_slip_nr,
            'basis' => $this->basis,
            'remarks' => $this->remarks,
            'items' => PtisItemsResource::collection($this->items)
        ];
    }
}
