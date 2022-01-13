<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\ResponsibilityCodeRepositoryInterface;

class ResponsibilityCodeTableSeeder extends Seeder
{
    public function __construct(ResponsibilityCodeRepositoryInterface $responsibilityCodeRepository)
    {
        $this->responsibilityCodeRepository = $responsibilityCodeRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '3AB1221', 'description' => '3AB1221'],
            (object)['name' => '4AB1222', 'description' => '4AB1222'],
            (object)['name' => '5AB1223', 'description' => '5AB1223'],
        ];

        foreach($seeds as $seed) {
            $this->responsibilityCodeRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
