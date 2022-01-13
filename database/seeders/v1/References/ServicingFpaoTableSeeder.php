<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\ServicingFpaoRepositoryInterface;

class ServicingFpaoTableSeeder extends Seeder
{
    public function __construct(ServicingFpaoRepositoryInterface $servicingFpaoRepository)
    {
        $this->servicingFpaoRepository = $servicingFpaoRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '1fpao', 'description' => '1FPAO'],
            (object)['name' => '2fpao', 'description' => '2FPAO'],
            (object)['name' => '3fpao', 'description' => '3FPAO'],
            (object)['name' => '4fpao', 'description' => '4FPAO'],
            (object)['name' => '5fpao', 'description' => '5FPAO'],
            (object)['name' => '6fpao', 'description' => '6FPAO'],
            (object)['name' => '7fpao', 'description' => '7FPAO'],
            (object)['name' => '8fpao', 'description' => '8FPAO'],
            (object)['name' => '9fpao', 'description' => '9FPAO'],
            (object)['name' => '10fpao', 'description' => '10FPAO'],
            (object)['name' => '11fpao', 'description' => '11FPAO'],
            (object)['name' => '12fpao', 'description' => '12FPAO'],
            (object)['name' => '14fpao', 'description' => '14FPAO'],
            (object)['name' => '15fpao', 'description' => '15FPAO'],
            (object)['name' => '16fpao', 'description' => '16FPAO'],
            (object)['name' => '17fpao', 'description' => '17FPAO'],
        ];

        foreach($seeds as $seed) {
            $this->servicingFpaoRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
