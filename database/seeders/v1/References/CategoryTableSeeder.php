<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionCategoryRepositoryInterface;

class CategoryTableSeeder extends Seeder
{
    public function __construct(AmmunitionCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Bombs', 'description' => 'Bombs', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Demolition Materials', 'description' => 'Demolition Materials', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Grenade Launcher', 'description' => 'For Grenade Launchers', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Guns', 'description' => 'For Guns', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Howitzers', 'description' => 'For Howitzers', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Mortars', 'description' => 'For Mortars', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Recoilless Rifles ', 'description' => 'For Recoilless Rifles', 'type' => 'EXPENDABLE'],
            (object)['name' => 'For Rocket Launcher Light', 'description' => 'For Rocket Launcher Light', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Grenades', 'description' => 'Grenades', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Land Mine', 'description' => 'Land Mines', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Pyrothechnics', 'description' => 'Pyrothechnics', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Propellants', 'description' => 'Propellants', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Rockets', 'description' => 'Rockets', 'type' => 'EXPENDABLE'],
            (object)['name' => 'Small Arms', 'description' => 'Small Arms', 'type' => 'EXPENDABLE'],
        ];

        foreach ($seeds as $seed){
            $this->categoryRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'type' => $seed->type,
                'created_by' => 1
            ]);
        }
    }
}
