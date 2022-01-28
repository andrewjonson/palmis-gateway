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
            'stock_number' => $this->lot_number,
            'uom' => AmmunitionUom::find($this->ammunitionNomenclature->ammunition_uom_id)->name,
            'unit_value' => $this->unit_price,
            'temp_balance_qty' => $this->temp_balance_qty,
            'condition' => $this->condition->code,
            'total_amount' => $this->unit_price * $this->temp_balance_qty
        ];
    }
}
