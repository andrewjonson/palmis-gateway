<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\References\AmmunitionNomenclatureResource;
use App\Repositories\Interfaces\v1\References\AmmunitionNomenclatureRepositoryInterface;

class AmmunitionNomenclatureController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionNomenclatureRepositoryInterface $ammunitionNomenclatureRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionNomenclatureRepository;
        $this->resource = AmmunitionNomenclatureResource::class;
        $this->modelName = 'AmmunitionNomenclature';

        parent::__construct($request);
    }

    /**
     * Store Ammunition Nomenclature
     * 
     * @param Illuminate\Http\Request
     * 
     */
    public function store(Request $request)
    {
        $request->merge([
            'ammunition_category_id' => hashid_decode($request->ammunition_category_id),
            'ammunition_size_caliber_id' => hashid_decode($request->ammunition_size_caliber_id),
            'ammunition_type_id' => hashid_decode($request->ammunition_type_id),
            'ammunition_uom_id' => hashid_decode($request->ammunition_uom_id),
            'ammunition_classification_id' => hashid_decode($request->ammunition_classification_id),
            'ammunition_supply_id' => hashid_decode($request->ammunition_supply_id),
            'ammunition_detail_id' => hashid_decode($request->ammunition_detail_id),
            'ammunition_head_stump_marking_id' => hashid_decode($request->ammunition_head_stump_marking_id),
            'ammunition_article_id' => hashid_decode($request->ammunition_article_id),
            'uacs_object_code_id' => hashid_decode($request->uacs_object_code_id)
        ]);

        try {
            $this->modelRepository->create($request->all());
            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

     /**
     * Update Ammunition Nomenclature
     * 
     * @param Illuminate\Http\Request
     * 
     */
    public function update(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);

        if (!$data) {
            throw new AuthorizationException;
        }
        
        $request->merge([
            'ammunition_category_id' => hashid_decode($request->ammunition_category_id),
            'ammunition_size_caliber_id' => hashid_decode($request->ammunition_size_caliber_id),
            'ammunition_type_id' => hashid_decode($request->ammunition_type_id),
            'ammunition_uom_id' => hashid_decode($request->ammunition_uom_id),
            'ammunition_classification_id' => hashid_decode($request->ammunition_classification_id),
            'ammunition_supply_id' => hashid_decode($request->ammunition_supply_id),
            'ammunition_detail_id' => hashid_decode($request->ammunition_detail_id),
            'ammunition_head_stump_marking_id' => hashid_decode($request->ammunition_head_stump_marking_id),
            'ammunition_article_id' => hashid_decode($request->ammunition_article_id),
            'uacs_object_code_id' => hashid_decode($request->uacs_object_code_id)
        ]);

        try {
            $data->update($request->all());
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_CREATED);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
