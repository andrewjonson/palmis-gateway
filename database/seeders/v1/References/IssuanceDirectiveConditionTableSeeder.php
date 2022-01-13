<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\IssuanceDirectiveConditionRepositoryInterface;

class IssuanceDirectiveConditionTableSeeder extends Seeder
{
    public function __construct(IssuanceDirectiveConditionRepositoryInterface $issuanceDirectiveConditionRepository)
    {
        $this->issuanceDirectiveConditionRepository = $issuanceDirectiveConditionRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Loan Basis', 'description' => 'Loan Basis'],
            (object)['name' => 'Turn-in 100% Cartridge cases (for stationary training)', 'description' => 'Turn-in 100% Cartridge cases (for stationary training)'],
            (object)['name' => 'Turn-in 80% Cartridge cases (for non-stationary training)', 'description' => 'Turn-in 80% Cartridge cases (for non-stationary training)']
        ];

        foreach($seeds as $seed) {
            $this->issuanceDirectiveConditionRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
