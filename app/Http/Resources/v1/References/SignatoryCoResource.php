<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;

class SignatoryCoResource extends JsonResource
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
            'id' => hashid_encode($this->signatory->id),
            'name' => $this->signatory->name,
            'rank' => $this->signatory->rank,
            'afposmos' => $this->signatory->afposmos,
            'unit' => $this->signatory->unit,
            'position_office' => $this->signatory->position_office,
            'designation' => $this->signatory->designation,
            'co' => $this->co_id ? new SignatoryResource($this->co) : null
        ];
    }
}
