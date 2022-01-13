<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\SignatoryRepositoryInterface;

class SignatoryTableSeeder extends Seeder
{
    public function __construct(SignatoryRepositoryInterface $signatoryRepository)
    {
        $this->signatoryRepository = $signatoryRepository;
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
                'pmcode' => '1', 
                'name' => 'FLORDELIZA C BOLHAYON',
                'rank' => 'LTC QMS',
                'designation' => 'CO',
                'unit' => '1Sbn, 1LSG, ASCOM, PA',
                'position_office' => 'ASCOM',
                'afposmos' => 'GSC'
            ],
            (object)[
                'pmcode' => '2', 
                'name' => 'ANTHONY C GOBOY',
                'rank' => 'Sgt (QMS)',
                'designation' => 'QM',
                'unit' => 'Whse NCOIC PA',
                'position_office' => 'Whse NCOIC',
                'afposmos' => ' '
            ],
            (object)[
                'pmcode' => '3', 
                'name' => 'ARIS BASALLO',
                'rank' => 'Civilian',
                'designation' => 'Representative',
                'unit' => '1Sbn',
                'position_office' => 'NEALLA ENT',
                'afposmos' => ' '
            ],
        ];

        foreach($seeds as $seed) {
            $this->signatoryRepository->create([
                'pmcode' => $seed->pmcode,
                'name' => $seed->name,
                'rank' => $seed->rank,
                'designation' => $seed->designation,
                'unit' => $seed->unit,
                'position_office' => $seed->position_office,
                'afposmos' => $seed->afposmos,
                'created_by' => 1
            ]);
        }
    }
}
