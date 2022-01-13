<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class ToggleSignatoryReportResource extends JsonResource
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
            'name' => $this->rank.' '.$this->name.' '.'('.$this->afposmos.') '.'PA',
            'designation' => $this->designation.'/'.$this->position_office
        ];
    }
}
