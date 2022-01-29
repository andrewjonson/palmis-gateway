<?php

namespace App\Http\Resources\v1\References;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\References\AmmunitionUomResource;
use App\Http\Resources\v1\References\AmmunitionTypeResource;
use App\Http\Resources\v1\References\UacsObjectCodeResource;
use App\Http\Resources\v1\References\AmmunitionDetailResource;
use App\Http\Resources\v1\References\AmmunitionSupplyResource;
use App\Http\Resources\v1\References\AmmunitionArticleResource;
use App\Http\Resources\v1\References\AmmunitionCategoryResource;
use App\Http\Resources\v1\References\AmmunitionSizeCaliberResource;
use App\Http\Resources\v1\References\AmmunitionSizeCalliberResource;
use App\Http\Resources\v1\References\AmmunitionClassificationResource;
use App\Http\Resources\v1\References\AmmunitionHeadStumpMarkingResource;

class AmmunitionNomenclatureResource extends JsonResource
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
            'ammunition_name' => $this->ammunition_name,
            'ammunition_category' => new AmmunitionCategoryResource($this->ammunitionCategory),
            'ammunition_size_caliber' => new AmmunitionSizeCaliberResource($this->ammunitionSizeCaliber),
            'ammunition_type' => new AmmunitionTypeResource($this->ammunitionType),
            'ammunition_uom' => new AmmunitionUomResource($this->ammunitionUom),
            'ammunition_classification' => new AmmunitionClassificationResource($this->ammunitionClassification),
            'ammunition_supply' => new AmmunitionSupplyResource($this->ammunitionSupply),
            'ammunition_detail' => new AmmunitionDetailResource($this->ammunitionDetail),
            'ammunition_head_stump_marking' => new AmmunitionHeadStumpMarkingResource($this->ammunitionHeadStumpMarking),
            'ammunition_article' => new AmmunitionArticleResource($this->ammunitionArticle),
            'uacs_object_code' => new UacsObjectCodeResource($this->uacsObjectCode)
        ];
    }
}
