<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\SignatoryCoRepositoryInterface;

class SignatoryCoTableSeeder extends Seeder
{
    public function __construct(SignatoryCoRepositoryInterface $signatorycoRepository)
    {
        $this->signatorycoRepository = $signatorycoRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)[
                'signatory_id' => 1, 
                'co_id' => 2,
            ],
        ];

        foreach($seeds as $seed) {
            $this->signatorycoRepository->create([
                'signatory_id' => $seed->signatory_id,
                'co_id' => $seed->co_id,
            ]);
        }
    }
}
