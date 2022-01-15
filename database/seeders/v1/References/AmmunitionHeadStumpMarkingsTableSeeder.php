<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Models\v1\References\AmmunitionHeadStumpMarking;

class AmmunitionHeadStumpMarkingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmmunitionHeadStumpMarking::create([
            'name' => 'Sample Head stump name',
            'description' => 'Sample Heaq stump description'
        ]);
    }
}
