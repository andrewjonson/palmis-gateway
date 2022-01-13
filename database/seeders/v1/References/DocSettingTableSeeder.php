<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\DocSettingRepositoryInterface;

class DocSettingTableSeeder extends Seeder
{
    public function __construct(DocSettingRepositoryInterface $docSettingRepository)
    {
        $this->docSettingRepository = $docSettingRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['header' => '<p style="text-align:center;">HEADQUARTERS<br>POL AND QUARTER MASTER COMPANY<br>1st Supply Battalion, 1LSG, ASCOM, PA<br>Fort Bonifacio, Metro Manila</p>'],
            (object)['header' => '<p style="text-align:center;">HEADQUARTERS<br>POL AND QUARTER MASTER COMPANY<br>1st Supply Battalion, 1LSG, ASCOM, PA<br>Fort Bonifacio, Metro Manila</p>'],
            (object)['header' => '<p style="text-align:center;"><span style="font-family:Arial, Helvetica, sans-serif;">HEADQUARTERS</span><br><span style="font-family:Arial, Helvetica, sans-serif;">POL AND QUARTER MASTER COMPANY</span><br><span style="font-family:Arial, Helvetica, sans-serif;">1st Supply Battalion, 1LSG, ASCOM, PA</span><br><span style="font-family:Arial, Helvetica, sans-serif;">Fort Bonifacio, Metro Manila</span></p>']        
        ];

        foreach($seeds as $seed) {
            $this->docSettingRepository->create([
                'header' => $seed->header,
                'logo' => '123456.jpg',
                'created_by' => 1
            ]);
        }
    }
}
