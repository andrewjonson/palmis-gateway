<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\v1\References\FpaoTableSeeder;
use Database\Seeders\v1\References\FssuTableSeeder;
use Database\Seeders\v1\References\TypeTableSeeder;
use Database\Seeders\v1\References\OfficeTableSeeder;
use Database\Seeders\v1\References\RegionTableSeeder;
use Database\Seeders\v1\References\SupplyTableSeeder;
use Database\Seeders\v1\References\CountryTableSeeder;
use Database\Seeders\v1\References\EndUserTableSeeder;
use Database\Seeders\v1\References\CategoryTableSeeder;
use Database\Seeders\v1\References\FpaoUnitTableSeeder;
use Database\Seeders\v1\References\MunicityTableSeeder;
use Database\Seeders\v1\References\ProvinceTableSeeder;
use Database\Seeders\v1\References\SupplierTableSeeder;
use Database\Seeders\v1\References\ConditionTableSeeder;
use Database\Seeders\v1\References\SignatoryTableSeeder;
use Database\Seeders\v1\References\WarehouseTableSeeder;
use Database\Seeders\v1\References\DocSettingTableSeeder;
use Database\Seeders\v1\References\FundClusterTableSeeder;
use Database\Seeders\v1\References\SignatoryCoTableSeeder;
use Database\Seeders\v1\References\ManufacturerTableSeeder;
use Database\Seeders\v1\References\ServicingFpaoTableSeeder;
use Database\Seeders\v1\References\ClassificationTableSeeder;
use Database\Seeders\v1\References\UnitOfMeasurementTableSeeder;
use Database\Seeders\v1\References\ResponsibilityCodeTableSeeder;
use Database\Seeders\v1\References\AmmunitionSizeCaliberTableSeeder;
use Database\Seeders\v1\References\AmmunitionNomenclatureTableSeeder;
use Database\Seeders\v1\References\IssuanceDirectivePurposeTableSeeder;
use Database\Seeders\v1\References\IssuanceDirectiveConditionTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClassificationTableSeeder::class);
        $this->call(SupplyTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(UnitOfMeasurementTableSeeder::class);
        $this->call(ServicingFpaoTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(RegionTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(MunicityTableSeeder::class);
        $this->call(ManufacturerTableSeeder::class);
        $this->call(ConditionTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(FssuTableSeeder::class);
        $this->call(FpaoTableSeeder::class);
        $this->call(FundClusterTableSeeder::class);
        $this->call(IssuanceDirectivePurposeTableSeeder::class);
        $this->call(IssuanceDirectiveConditionTableSeeder::class);
        $this->call(AmmunitionSizeCaliberTableSeeder::class);
        $this->call(FpaoUnitTableSeeder::class);
        $this->call(AmmunitionNomenclatureTableSeeder::class);
        $this->call(EndUserTableSeeder::class);
        $this->call(DocSettingTableSeeder::class);
        $this->call(OfficeTableSeeder::class);
        $this->call(ResponsibilityCodeTableSeeder::class);
        $this->call(SignatoryTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(SignatoryCoTableSeeder::class);
    }
}