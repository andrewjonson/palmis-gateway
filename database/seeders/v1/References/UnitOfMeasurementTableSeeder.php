<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionUomRepositoryInterface;

class UnitOfMeasurementTableSeeder extends Seeder
{
    public function __construct(AmmunitionUomRepositoryInterface $unitOfMeasurementRepository)
    {
        $this->unitOfMeasurementRepository = $unitOfMeasurementRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Rounds', 'description' => 'Rounds'],
            (object)['name' => 'Each', 'description' => 'Each'],
            (object)['name' => 'Meter', 'description' => 'Meter'],
            (object)['name' => 'Foot', 'description' => 'Foot'],
            (object)['name' => 'Piece', 'description' => 'Piece'],
            (object)['name' => 'Pair', 'description' => 'Pair']
        ];

        foreach($seeds as $seed) {
            $this->unitOfMeasurementRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
