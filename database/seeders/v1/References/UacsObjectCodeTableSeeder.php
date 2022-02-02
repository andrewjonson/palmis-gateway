<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Models\v1\References\UacsObjectCode;

class UacsObjectCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = [
            '1-06-01-010-00',
            '1-06-02-990-00',
            '1-06-03-040-00',
            '1-06-03-050-00',
            '1-06-05-100-00'
        ];

        $descriptions = [
            'Land',
            'Other Land Improvements',
            'Water Supply System',
            'Power Supply System',
            'Military, Police and Security Equipment'
        ];

        foreach($codes as $key => $code) {
            UacsObjectCode::create([
                'code' => $code,
                'description' => $descriptions[$key]
            ]);
        }
    }
}
