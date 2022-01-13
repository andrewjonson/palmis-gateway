<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\EndUserRepositoryInterface;

class EndUserTableSeeder extends Seeder
{
    public function __construct(EndUserRepositoryInterface $endUserRepository)
    {
        $this->endUserRepository = $endUserRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '101Bde', 'description' => '101Bde'],
            (object)['name' => '102Bde', 'description' => '102Bde'],
            (object)['name' => '103Bde', 'description' => '103Bde'],
            (object)['name' => '5IB', 'description' => '5IB'],
            (object)['name' => '10IB', 'description' => '10IB'],
            (object)['name' => '18IB ', 'description' => '18IB '],
            (object)['name' => '44IB', 'description' => '44IB'],
            (object)['name' => '51IB', 'description' => '51IB'],
            (object)['name' => '53IB', 'description' => '53IB'],
            (object)['name' => '55IB', 'description' => '55IB'],
            (object)['name' => '64IB', 'description' => '64IB'],
            (object)['name' => '97IB', 'description' => '97IB'],
            (object)['name' => '11DRC', 'description' => '11DRC'],
            (object)['name' => '12DRC', 'description' => '12DRC'],
            (object)['name' => '14DRC', 'description' => '14DRC'],
            (object)['name' => '1MIB', 'description' => '1MIB'],
            (object)['name' => '1CMO Bn', 'description' => '1CMO Bn'],
            (object)['name' => 'HHSBn', 'description' => 'HHSBn'],
            (object)['name' => 'SSBn', 'description' => 'SSBn'],
            (object)['name' => '1DTS', 'description' => '1DTS'],
            (object)['name' => 'TFZ', 'description' => 'TFZ'],
            (object)['name' => '201IBde', 'description' => '201IBde'],
            (object)['name' => '202IBde', 'description' => '202IBde'],
            (object)['name' => '203IBde', 'description' => '203IBde'],
            (object)['name' => '1IBn', 'description' => '1IBn'],
            (object)['name' => '4IBn', 'description' => '4IBn'],
            (object)['name' => '16IBn', 'description' => '16IBn']
        ];

        foreach($seeds as $seed) {
            $this->endUserRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
