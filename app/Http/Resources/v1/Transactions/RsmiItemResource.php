<?php

namespace App\Http\Resources\v1\Transactions;

use App\Models\v1\Transactions\Inventory;
use App\Models\v1\References\ResponsibilityCode;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\ResponsibilityCodeResource;
use App\Http\Resources\v1\Transactions\RsmiRecapitulationResource;
use App\Http\Resources\v1\References\AmmunitionNomenclatureResource;

class RsmiItemResource extends JsonResource
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
            'ris_number' => $this->stockCard->issuanceDirectiveItem ? $this->stockCard->issuanceDirectiveItem->issuanceDirective->ris()->pluck('ris_nr')->first() : $this->stockCard->stdItem->std->ris()->pluck('ris_nr')->first(),
            'responsibility_center_code' => new ResponsibilityCodeResource($this->iar->responsibilityCode),
            'stock_number' => $this->lot_number,
            'item' => $this->ammunitionNomenclature->ammunition_name,
            'uom' => $this->ammunitionNomenclature->ammunitionUom->name,
            'quantity_issued' => $this->stockCard->issuanceDirectiveItem ? $this->stockCard->issuanceDirectiveItem->quantity : $this->stockCard->stdItem->quantity,
            'unit_cost' => $this->unit_price,
            'amount' => $this->stockCard->issuanceDirectiveItem ? number_format($this->stockCard->issuanceDirectiveItem->quantity * $this->unit_price, 2) : number_format($this->stockCard->stdItem->quantity * $this->unit_price, 2),
            'recapitulation' => RsmiRecapitulationResource::collection(Inventory::where('id', $this->id)->get())
        ];
    }
}
