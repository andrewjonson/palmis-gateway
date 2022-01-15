<?php

namespace App\Http\Resources\v1\Transactions;

use App\Models\v1\References\AmmunitionUom;
use App\Models\v1\References\AmmunitionArticle;
use Illuminate\Http\Resources\Json\JsonResource;

class RpciItemResource extends JsonResource
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
            'articles' => AmmunitionArticle::find($this->ammunitionNomenclature->ammunition_article_id)->name,
            'description' => $this->ammunitionNomenclature->ammunition_name,
            'stock_number' => $this->quantity,
            'uom' => AmmunitionUom::find($this->ammunitionNomenclature->ammunition_uom_id)->name,
            'unit_value' => $this->total_amount,
            'temp_balance_qty' => $this->temp_balance_qty,
        ];
    }
}
