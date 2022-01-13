<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;

class ToggleIarReportResource extends JsonResource
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
            'date' => $this->iar->date,
            'reference' => $this->iar->iar_nr,
            'receipt_qty' => $this->quantity,
            'issue_qty' => $this->stockCard ? $this->stockCard->issuanceDirectiveItem->quantity : Null,
            'office' => $this->iar->office->description,
            'balance' => $this->temp_balance_qty,
            'nr_days_consume' => 'None'
        ];
    }
}
