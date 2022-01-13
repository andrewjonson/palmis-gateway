<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\FpaoRepositoryInterface;

class FpaoTableSeeder extends Seeder
{ 
    public function __construct(FpaoRepositoryInterface $fpaoRepository)
    {
        $this->fpaoRepository = $fpaoRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '1FPAO', 'serial_location_office' => '1FPAO'],
            (object)['name' => '2FPAO', 'serial_location_office' => '2FPAO'],
            (object)['name' => '3FPAO', 'serial_location_office' => '3FPAO'],
            (object)['name' => '4FPAO', 'serial_location_office' => '4FPAO'],
            (object)['name' => '5FPAO', 'serial_location_office' => '5FPAO'],
            (object)['name' => '6FPAO', 'serial_location_office' => '6FPAO'],
            (object)['name' => '7FPAO', 'serial_location_office' => '7FPAO'],
            (object)['name' => '8FPAO', 'serial_location_office' => '8FPAO'],
            (object)['name' => '9FPAO', 'serial_location_office' => '9FPAO'],
            (object)['name' => '10FPAO', 'serial_location_office' => '10FPAO'],
            (object)['name' => '11FPAO', 'serial_location_office' => '11FPAO'],
            (object)['name' => '12FPAO', 'serial_location_office' => '12FPAO'],
            (object)['name' => '14FPAO', 'serial_location_office' => '14FPAO'],
            (object)['name' => '15FPAO', 'serial_location_office' => '15FPAO'],
            (object)['name' => '16FPAO', 'serial_location_office' => '16FPAO'],
            (object)['name' => '17FPAO', 'serial_location_office' => '17FPAO'],
            (object)['name' => 'GSFPAO', 'serial_location_office' => 'GSFPAO'],
          
        ];

        foreach($seeds as $seed) {
            $this->fpaoRepository->create([
                'name' => $seed->name,
                'serial_location_office' => $seed->serial_location_office,
                'created_by' => 1
            ]);
        }
    }
}

