<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Models\v1\References\AmmunitionArticle;

class AmmunitionArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmmunitionArticle::create([
            'name' => 'Sample article name',
            'description' => 'Sample article description'
        ]);
    }
}
