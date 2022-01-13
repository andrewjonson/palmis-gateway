<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\SupplierResource;
use App\Http\Resources\v1\Transactions\InventoryResource;

class TallyInResource extends JsonResource
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
            'tally_in_nr' => $this->tally_in_nr,
            'supplier' => $this->supplier ? new SupplierResource($this->supplier) : null,
            'supplier_name' => $this->supplier_name,
            'supplier_designation' => $this->supplier_designation,
            'stock_disposition' => $this->stock_disposition,
            'tally_in_date' => $this->tally_in_date,
            'is_iar' => $this->is_iar,
            'created_at' => $this->created_at->format('d M Y'),
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at->format('d M Y'),
            'updated_by' => $this->updated_by,
            'inventory' => InventoryResource::collection($this->inventory)
        ];
    }
}
