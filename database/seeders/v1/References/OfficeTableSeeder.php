<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\OfficeRepositoryInterface;

class OfficeTableSeeder extends Seeder
{
    public function __construct(OfficeRepositoryInterface $officeRepository)
    {
        $this->officeRepository = $officeRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '1FPAO', 'description' => '1FPAO'],
            (object)['name' => '2FPAO', 'description' => '2FPAO'],
            (object)['name' => '3FPAO', 'description' => '3FPAO'],
            (object)['name' => '4FPAO', 'description' => '4FPAO'],
            (object)['name' => '5FPAO', 'description' => '5FPAO'],
            (object)['name' => '6FPAO', 'description' => '6FPAO'],
            (object)['name' => '7FPAO', 'description' => '7FPAO'],
            (object)['name' => '8FPAO', 'description' => '8FPAO'],
            (object)['name' => '9FPAO', 'description' => '9FPAO'],
            (object)['name' => '10FPAO', 'description' => '10FPAO'],
            (object)['name' => '11FPAO', 'description' => '11FPAO'],
            (object)['name' => '12FPAO', 'description' => '12FPAO'],
            (object)['name' => '14FPAO', 'description' => '14FPAO'],
            (object)['name' => '15FPAO', 'description' => '15FPAO'],
            (object)['name' => '16FPAO', 'description' => '16FPAO'],
            (object)['name' => '17FPAO', 'description' => '17FPAO'],
            (object)['name' => 'GSFPAO', 'description' => 'GSFPAO'],
          
        ];

        foreach($seeds as $seed) {
            $this->officeRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
