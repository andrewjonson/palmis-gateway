<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\StdItemResource;
use App\Http\Resources\v1\References\IssuanceDirectivePurposeResource;

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
            'purpose' => new IssuanceDirectivePurposeResource($this->issuanceDirectivePurpose),
            'date' => $this->date,
            'remarks' => $this->remarks,
            'items' => StdItemResource::collection($this->stdItems)
        ];
    }
}
