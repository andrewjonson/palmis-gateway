<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\DdaNrDefectResource;
use App\Http\Resources\v1\Transactions\DdaNrDefectiveResource;

class DdaPackedResource extends JsonResource
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
            'condition_ammunition_item' => $this->condition_ammunition_item,
            'packed_type' => $this->packed_type,
            'nr_defects' => new DdaNrDefectResource($this->ddaNrDefect),
            'nr_defectives' => new DdaNrDefectiveResource($this->ddaNrDefective)
        ];
    }
}
