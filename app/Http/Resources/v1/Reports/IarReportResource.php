<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Reports\HeaderFooter;
use App\Http\Resources\v1\Transactions\IarResource;
use App\Http\Resources\v1\References\SignatoryResource;
use App\Http\Resources\v1\References\DocSettingResource;
use App\Http\Resources\v1\Reports\ToggleSignatoryReportResource;

class IarReportResource extends JsonResource
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
            'title' => 'INVENTORY ACCEPTANCE REPORT',
            'entity_name' => $this->iar->entity_name,
            'date' => $this->iar->date,
            'po_nr' => $this->iar->po_nr,
            'supplier' => $this->iar->tallyIn->supplier->name,
            'iar_nr' => $this->iar->iar_nr,
            'invoice_nr' => $this->iar->invoice_nr,
            'invoice_date' => $this->iar->invoice_date,
            'fund_cluster' => $this->iar->fundCluster->name,
            'requisitioning_office_id' => $this->iar->office->description,
            'responsibility_center_code_id' => $this->iar->office->description,
            'iar' => new ToggleResource($this->iar),
            'doc_setting' => new DocSettingResource($this->docSetting),
            'acceptance_signatory' => new ToggleSignatoryReportResource($this->acceptanceSignatory),
            'inspection_signatory' => new ToggleSignatoryReportResource($this->inspectionSignatory),
            'header' => 'By 2021, a word-class Army that is a source of national pride.',
            'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
