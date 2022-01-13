<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionNomenclatureRepositoryInterface;

class AmmunitionNomenclatureTableSeeder extends Seeder
{
    public function __construct(AmmunitionNomenclatureRepositoryInterface $ammunitionNomenclatureRepository)
    {
        $this->ammunitionNomenclatureRepository = $ammunitionNomenclatureRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)[
                'ammunition_name' => 'Ctg, 76mm: AP-T, M338', 
                'ammunition_category_id' => 4,
                'ammunition_size_caliber_id' => 1,
                'ammunition_type_id' => 41,
                'ammunition_uom_id' => 1,
                'ammunition_classification_id' => 1,
                'ammunition_supply_id' => 1
            ],
            (object)[
                'ammunition_name' => 'Ctg, 76mm: AP-T, M339', 
                'ammunition_category_id' => 4,
                'ammunition_size_caliber_id' => 1,
                'ammunition_type_id' => 41,
                'ammunition_uom_id' => 1,
                'ammunition_classification_id' => 1,
                'ammunition_supply_id' => 1
            ],
            (object)[
                'ammunition_name' => 'Ctg, 76mm, ARMD C HESH', 
                'ammunition_category_id' => 4,
                'ammunition_size_caliber_id' => 1,
                'ammunition_type_id' => 41,
                'ammunition_uom_id' => 1,
                'ammunition_classification_id' => 1,
                'ammunition_supply_id' => 1
            ],
            (object)[
                'ammunition_name' => 'Ctg, 76mm, ARMD C HESH, L29A3', 
                'ammunition_category_id' => 4,
                'ammunition_size_caliber_id' => 1,
                'ammunition_type_id' => 41,
                'ammunition_uom_id' => 1,
                'ammunition_classification_id' => 1,
                'ammunition_supply_id' => 1
            ],
        ];

        foreach($seeds as $seed) {
            $this->ammunitionNomenclatureRepository->create([
                'ammunition_name' => $seed->ammunition_name,
                'ammunition_category_id' => $seed->ammunition_category_id,
                'ammunition_size_caliber_id' => $seed->ammunition_size_caliber_id,
                'ammunition_type_id' => $seed->ammunition_type_id,
                'ammunition_uom_id' => $seed->ammunition_uom_id,
                'ammunition_classification_id' => $seed->ammunition_classification_id,
                'ammunition_supply_id' => $seed->ammunition_supply_id,
                'created_by' => 1
            ]);
        }
    }
}
