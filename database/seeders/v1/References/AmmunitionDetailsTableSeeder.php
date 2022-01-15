<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Models\v1\References\AmmunitionDetail;

class AmmunitionDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmmunitionDetail::create([
            'name' => 'Sample detail name',
            'description' => 'Sample detail description'
        ]);
    }
}
