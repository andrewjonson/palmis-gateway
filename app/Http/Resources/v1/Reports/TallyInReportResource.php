<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Reports\HeaderFooter;
use App\Http\Resources\v1\Reports\ToggleResource;
use App\Http\Resources\v1\References\SupplierResource;
use App\Http\Resources\v1\References\SignatoryResource;
use App\Http\Resources\v1\Transactions\TallyInResource;
use App\Http\Resources\v1\References\DocSettingResource;
use App\Http\Resources\v1\Reports\ToggleSignatoryReportResource;

class TallyInReportResource extends JsonResource
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
            'title' => 'TALLY-IN',
            'tally' => new ToggleResource($this->tallyIn),
            'received_from_signatory' => new SupplierResource($this->tallyIn->supplier),
            'received_by_signatory' => new ToggleSignatoryReportResource($this->receivedBySignatory),
            'noted_by_signatory' => new ToggleSignatoryReportResource($this->notedBySignatory),
            'doc_setting' => new DocSettingResource($this->docSetting),
            'header' => 'By 2021, a word-class Army that is a source of national pride.',
            'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
