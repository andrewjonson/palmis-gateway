<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionSizeCaliberRepositoryInterface;

class AmmunitionSizeCaliberTableSeeder extends Seeder
{
    public function __construct(AmmunitionSizeCaliberRepositoryInterface $ammunitionSizeCaliberRepository)
    {
        $this->ammunitionSizeCaliberRepository = $ammunitionSizeCaliberRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => '76mm', 'description' => '76mm'],
            (object)['name' => '20 Gauge', 'description' => '20 Gauge'],
            (object)['name' => 'Cal.22', 'description' => 'Cal.22'],
            (object)['name' => 'Cal.30', 'description' => 'Cal.30'],
            (object)['name' => 'Cal.32', 'description' => 'Cal.32'],
            (object)['name' => 'Cal.38', 'description' => 'Cal.38'],
            (object)['name' => 'Cal.308', 'description' => 'Cal.308'],
            (object)['name' => 'Cal.45', 'description' => 'Cal.45'],
            (object)['name' => 'Cal.40', 'description' => 'Cal.40'],
            (object)['name' => '40mm', 'description' => '40mm'],
            (object)['name' => '105mm', 'description' => '105mm'],
            (object)['name' => '155mm', 'description' => '155mm'],
            (object)['name' => '5.56mm', 'description' => '5.56mm'],
            (object)['name' => '7.62mm', 'description' => '7.62mm']
        ];

        foreach($seeds as $seed) {
            $this->ammunitionSizeCaliberRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
