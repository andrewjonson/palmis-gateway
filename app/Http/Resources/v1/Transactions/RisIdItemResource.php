<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use App\Http\Resources\v1\Transactions\RisItemResource;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;
use App\Http\Resources\v1\References\ToggleFpaoUnitResource;
use App\Http\Resources\v1\Transactions\IssuanceDirectiveItemResource;

class RisIdItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $unit = new Unit;
        // $fetchPamu = $unit->getToggleUnitName(hashid_encode($this->issuanceDirective->pamu_id));
        return [
            'id' => hashid_encode($this->id),
            // 'division' => $fetchPamu->{'original'}['data'],
            'division' => new ToggleFpaoUnitResource($this->issuanceDirective),
            'entity_name' => 'PA',
            'office' => 'ISDC',
            'fund_cluster' => 'PA Modernization Fund',
            'ris_nr' => $this->ris_nr,
            'status' => $this->status,

            // 'issuance_directive' => new IssuanceDirectiveResource($this->issuanceDirective)
            'item' => RisItemResource::collection(IssuanceDirectiveItem::where('issuance_directive_id', $this->issuance_directive_id)->get())
        ];
    }
}
