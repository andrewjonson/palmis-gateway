<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\FssuRepositoryInterface;

class FssuTableSeeder extends Seeder
{
    public function __construct(FssuRepositoryInterface $fssuRepository)
    {
        $this->fssuRepository = $fssuRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '1FSSU', 'description' => '1FSSU'],
            (object)['name' => '2FSSU', 'description' => '2FSSU'],
            (object)['name' => '4FSSU', 'description' => '4FSSU'],
            (object)['name' => '5FSSU', 'description' => '5FSSU'],
            (object)['name' => '6FSSU', 'description' => '6FSSU'],
            (object)['name' => '7FSSU', 'description' => '7FSSU'],
            (object)['name' => '8FSSU', 'description' => '8FSSU'],
            (object)['name' => '9FSSU', 'description' => '9FSSU'],
            (object)['name' => '10FSSU', 'description' => '10FSSU'],
            (object)['name' => '11FSSU', 'description' => '11FSSU'],
            (object)['name' => '12FSSU', 'description' => '12FSSU'],
            (object)['name' => '15FSSU', 'description' => '15FSSU'],
            (object)['name' => '15FSSU', 'description' => '15FSSU'],
            (object)['name' => 'SupBn, 1LSG', 'description' => 'SupBn, 1LSG'],
            (object)['name' => 'AABn, 1LSG', 'description' => 'AABn, 1LSG'],
        ];

        foreach($seeds as $seed) {
            $this->fssuRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
