<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionSupplyRepositoryInterface;

class SupplyTableSeeder extends Seeder
{
    public function __construct(AmmunitionSupplyRepositoryInterface $supplyRepository)
    {
        $this->supplyRepository = $supplyRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'FIREPOWER', 'description' => 'FIREPOWER']
        ];

        foreach($seeds as $seed) {
            $this->supplyRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
