<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class DdaNrDefectiveResource extends JsonResource
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
            'crit' => $this->crit,
            'maj' => $this->maj,
            'min' => $this->min
        ];
    }
}
