<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\StdItemResource;

class StdResource extends JsonResource
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
            'std_number' => $this->std_number,
            'authority' => $this->authority,
            'purpose' => $this->purpose,
            'date' => $this->date,
            'items' => StdItemResource::collection($this->stdItems)
        ];
    }
}
