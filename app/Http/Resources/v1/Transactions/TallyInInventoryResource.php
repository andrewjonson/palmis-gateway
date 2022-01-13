<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\SupplierResource;
use App\Http\Resources\v1\Transactions\InventoryResource;

class TallyInInventoryResource extends JsonResource
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
            'is_iar' => $this->is_iar,
            'supplier' => $this->supplier ? new SupplierResource($this->supplier) : null,
            'inventory' => $this->inventory ? InventoryResource::collection($this->inventory) : null
        ];
    }
}
