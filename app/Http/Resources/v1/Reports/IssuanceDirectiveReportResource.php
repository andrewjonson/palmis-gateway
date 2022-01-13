<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Reports\ToggleResource;
use App\Http\Resources\v1\References\SignatoryResource;
use App\Http\Resources\v1\References\DocSettingResource;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;
use App\Http\Resources\v1\Reports\ToggleIdReportResource;
use App\Http\Resources\v1\Reports\ToggleSignatoryReportResource;

class IssuanceDirectiveReportResource extends JsonResource
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
            'title' => 'ISSUANCE DIRECTIVE',
            'authority' => $this->issuanceDirective->authority,
            'issuance_directive_nr' => $this->issuanceDirective->issuance_directive_nr,
            'pamu' => $this->issuanceDirective->pamuFpaoUnit->unit,
            'cognizant_fpao' => $this->issuanceDirective->cognizantFpao->name,
            'servicing_fpao' => $this->issuanceDirective->servicingFpao->name,
            'cognizant_fssu' => $this->issuanceDirective->fssu->name,
            'date' => $this->issuanceDirective->date,
            'end_user' => $this->issuanceDirective->endUserFpaoUnit->unit,
            'issuance_directive_item' => ToggleIdReportResource::collection($this->issuanceDirectiveItems),
            'prepared_by_signatory' => new ToggleSignatoryReportResource($this->preparedBySignatory),
            'approved_by_signatory' => new ToggleSignatoryReportResource($this->approvedBySignatory),
            'doc_setting' => new DocSettingResource($this->docSetting),
            'header' => 'By 2021, a word-class Army that is a source of national pride.',
            'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
