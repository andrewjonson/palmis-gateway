<?php

namespace App\Http\Resources\v1\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\v1\References\ServicingFpao;
use App\Http\Resources\v1\References\TypeResource;
use App\Http\Resources\v1\References\DetailResource;
use App\Http\Resources\v1\References\RegionResource;
use App\Http\Resources\v1\References\CountryResource;
use App\Http\Resources\v1\References\CategoryResource;
use App\Http\Resources\v1\References\MunicityResource;
use App\Http\Resources\v1\References\ProvinceResource;
use App\Http\Resources\v1\References\ConditionResource;
use App\Http\Resources\v1\References\WarehouseResource;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;
use App\Http\Resources\v1\References\ManufacturerResource;
use App\Http\Resources\v1\References\NomenclatureResource;
use App\Http\Resources\v1\References\AmmunitionUomResource;
use App\Http\Resources\v1\References\ServicingFpaoResource;
use App\Http\Resources\v1\References\AmmunitionTypeResource;
use App\Http\Resources\v1\References\ClassificationResource;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;
use App\Http\Resources\v1\References\AmmunitionDetailResource;
use App\Http\Resources\v1\References\UnitOfMeasurementResource;
use App\Http\Resources\v1\References\AmmunitionCategoryResource;
use App\Http\Resources\v1\References\AmmunitionNomenclatureResource;
use App\Http\Resources\v1\References\AmmunitionClassificationResource;

class InventoryResource extends JsonResource
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
            'ammunition_nomenclature' => new AmmunitionNomenclatureResource($this->ammunitionNomenclature),
            'references' => $this->iar ? $this->iar->iar_nr : null,
            'description' => $this->description,
            'uom' => $this->ammunitionNomenclature->ammunitionUom->name,
            'lot_number' => $this->lot_number,
            'quantity' => $this->quantity,
            'date_manufactured' => $this->date_manufactured,
            'date_accepted' => $this->date_accepted,
            'manufacturer' => new ManufacturerResource($this->manufacturer),
            'made' => new CountryResource($this->country),
            'unit_price' => $this->unit_price,
            'total_amount' => $this->total_amount,
            'condition' => new ConditionResource($this->condition),
            'warehouse' => new WarehouseResource($this->warehouse),
            'is_accepted' => $this->is_accepted
        ];  
    }
}
