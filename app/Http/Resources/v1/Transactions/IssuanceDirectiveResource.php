<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\FpaoResource;
use App\Http\Resources\v1\References\FssuResource;
use App\Http\Resources\v1\References\ToggleFpaoUnitResource;
use App\Http\Resources\v1\References\IssuanceDirectivePurposeResource;
use App\Http\Resources\v1\References\IssuanceDirectiveConditionResource;

class IssuanceDirectiveResource extends JsonResource
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
            'issuance_directive_nr' => $this->issuance_directive_nr,
            'authority' => $this->authority,
            'pamu' => new ToggleFpaoUnitResource($this->pamuFpaoUnit),
            'cognizant_fpao' => new FpaoResource($this->cognizantFpao),
            'cognizant_fssu' => new FssuResource($this->fssu),
            'servicing_fpao' => new FpaoResource($this->servicingFpao),
            'date' => $this->date,
            'end_user' => new ToggleFpaoUnitResource($this->endUserFpaoUnit),
            'issuance_directive_purpose' => new IssuanceDirectivePurposeResource($this->issuancePurpose),
            'issuance_directive_condition_id' => new IssuanceDirectiveConditionResource($this->issuanceCondition),
            'item' => IssuanceDirectiveItemResource::collection($this->issuanceDirectiveItem),
            'is_released' => $this->is_released
        ];
    }
}
