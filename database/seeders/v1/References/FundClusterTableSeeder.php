<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\FundClusterRepositoryInterface;

class FundClusterTableSeeder extends Seeder
{
    public function __construct(FundClusterRepositoryInterface $fundClusterRepository)
    {
        $this->fundClusterRepository = $fundClusterRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Regular Agency Fund', 'description' => 'Regular Agency Fund'],
            (object)['name' => 'PA Modernization Fun', 'description' => 'PA Modernization Fun'],
            (object)['name' => 'Inter-Agency Trust Fund', 'description' => 'Inter-Agency Trust Fund'],
            (object)['name' => 'Internally Generated Fund', 'description' => 'Internally Generated Fund'],
            (object)['name' => 'BCDA Fund', 'description' => 'BCDA Fund']
        ];

        foreach($seeds as $seed) {
            $this->fundClusterRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
