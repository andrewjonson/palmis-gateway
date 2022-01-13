<?php

namespace App\Http\Resources\v1\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardIdResource extends JsonResource
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
            'item' => $this->stockCard->inventory->description,
            'quantity' => $this->quantity,
        ];
    }
}
