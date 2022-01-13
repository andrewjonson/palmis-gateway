<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionClassificationRepositoryInterface;

class ClassificationTableSeeder extends Seeder
{
    public function __construct(AmmunitionClassificationRepositoryInterface $classificationRepository)
    {
        $this->classificationRepository = $classificationRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'ammunition', 'description' => 'Ammunition'],
            (object)['name' => 'firearms', 'description' => 'Firearms'],
            (object)['name' => 'firearms spares', 'description' => 'Firearms Spares']
        ];

        foreach($seeds as $seed) {
            $this->classificationRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
