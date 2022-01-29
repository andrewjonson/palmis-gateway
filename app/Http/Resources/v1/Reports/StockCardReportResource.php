<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Reports\ToggleIarReportResource;
use App\Http\Resources\v1\Reports\ToggleSignatoryReportResource;
use App\Http\Resources\v1\Transactions\StockCardReferenceResource;

class StockCardReportResource extends JsonResource
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
            'title' => 'STOCK CARD REPORT',
            'entity_name' => $this->stockCard->inventory->tallyIn->iar->entity_name,
            'stock_nr' => $this->stockCard->stock_card_nr,
            'desciption' => $this->stockCard->inventory->description,
            'item' => $this->stockCard->inventory->ammunitionNomenclature->ammunitionClassification->name,
            'uom' => $this->stockCard->inventory->ammunitionNomenclature->ammunitionUom->name,
            'fund_cluster' => $this->stockCard->inventory->tallyIn->iar->fundCluster->name,
            're_order_point' => 'None',
            // 'iar' => new ToggleIarReportResource($this->stockCard->inventory),
            'item' => StockCardReferenceResource::collection($this->stockCard->stockCardReference),
            'received_from_id' => new ToggleSignatoryReportResource($this->receivedFromSignatory),
            'received_by_id' => new ToggleSignatoryReportResource($this->receivedBySignatory),
            'header' => 'By 2021, a word-class Army that is a source of national pride.',
            'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
