<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\IssuanceDirectivePurposeRepositoryInterface;

class IssuanceDirectivePurposeTableSeeder extends Seeder
{
    public function __construct(IssuanceDirectivePurposeRepositoryInterface $issuanceDirectivePurposeRepository)
    {
        $this->issuanceDirectivePurposeRepository = $issuanceDirectivePurposeRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Training', 'description' => 'Training'],
            (object)['name' => 'Combat Replenishment', 'description' => 'Combat Replenishment'],
            (object)['name' => 'Fun Shoot', 'description' => 'Fun Shoot'],
            (object)['name' => 'Functional Test', 'description' => 'Functional Test'],
            (object)['name' => 'Basic Load', 'description' => 'Basic Load']
        ];

        foreach($seeds as $seed) {
            $this->issuanceDirectivePurposeRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
