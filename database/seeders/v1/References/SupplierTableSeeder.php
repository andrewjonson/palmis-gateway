<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\SupplierRepositoryInterface;

class SupplierTableSeeder extends Seeder
{
    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
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
            (object)['name' => 'RES (PTY) LTD', 'description' => 'RES (PTY) LTD'],
            (object)['name' => 'Ammo Tech', 'description' => 'Ammo Tech'],
            (object)['name' => 'Arm Global DI', 'description' => 'Arm Global DI'],
            (object)['name' => 'Armscor', 'description' => 'Armscor'],
            (object)['name' => 'CBC', 'description' => 'CBC'],
            (object)['name' => 'JOAVI', 'description' => 'JOAVI'],
            (object)['name' => 'NOLCOM', 'description' => 'NOLCOM'],
            (object)['name' => 'RENOV', 'description' => 'RENOV'],
            (object)['name' => 'EOD, VSC', 'description' => 'EOD, VSC']
        ];

        foreach($seeds as $seed) {
            $this->supplierRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
