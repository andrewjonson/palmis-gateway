<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\ManufacturerRepositoryInterface;

class ManufacturerTableSeeder extends Seeder
{
    public function __construct(ManufacturerRepositoryInterface $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'EXPAL SYS', 'description' => 'EXPAL SYS'],
            (object)['name' => 'ARSENAL JSC', 'description' => 'ARSENAL JSC'],
            (object)['name' => 'RES (PTY) LTD', 'description' => 'RES (PTY) LTD']
        ];

        foreach($seeds as $seed) {
            $this->manufacturerRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
