<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\WarehouseRepositoryInterface;

class WarehouseTableSeeder extends Seeder
{
    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'IGLOO TYPE', 'description' => 'IGLOO TYPE', 'location' => 'Camp Gen Servillano Aquino, Tarlac City (CGSA)', 'supply_unit' => 'AABN, 1LSG'],
            (object)['name' => 'Aboveground Magazine', 'description' => 'Aboveground Magazine', 'location' => 'Camp Gen Servillano Aquino, Tarlac City (CGSA)', 'supply_unit' => 'AABN, 1LSG'],
            (object)['name' => 'GS Warehouse', 'description' => 'GS Warehouse', 'location' => 'Camp Gen Servillano Aquino, Tarlac City (CGSA)', 'supply_unit' => 'AABN, 1LSG'],
            
        ];

        foreach($seeds as $seed) {
            $this->warehouseRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'location' => $seed->location,
                'supply_unit' => $seed->supply_unit,
                'created_by' => 1
            ]);
        }
    }
}
