<?php

namespace App\Http\Resources\v1\Reports;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Transactions\TallyOutResource;

class TallyOutReportResource extends JsonResource
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
            'title' => 'TALLY OUT REPORT',
            'item' => TallyOutResource::collection($this->ris),
            'received_from_id' => '',
            'received_by_id' => '',
            'header' => 'By 2021, a word-class Army that is a source of national pride.',
            'footer' => 'Honor. Patriotism. Duty'
        ];
    }
}
