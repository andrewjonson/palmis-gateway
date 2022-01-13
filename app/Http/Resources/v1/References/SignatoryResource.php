<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;

class SignatoryResource extends JsonResource
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
            'name' => $this->name,
            'rank' => $this->rank,
            'afposmos' => $this->afposmos,
            'unit' => $this->unit,
            'position_office' => $this->position_office,
            'designation' => $this->designation,
        ];
    }
}
