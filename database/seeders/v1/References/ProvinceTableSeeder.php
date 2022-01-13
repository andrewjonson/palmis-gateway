<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('csv/philippine_provinces.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
