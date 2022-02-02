<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Eloquent\v1\References\FpaoRepository;
use App\Repositories\Eloquent\v1\References\FssuRepository;
use App\Repositories\Eloquent\v1\References\MakeRepository;
use App\Repositories\Eloquent\v1\References\TypeRepository;
use App\Repositories\Eloquent\v1\Transactions\DdaRepository;
use App\Repositories\Eloquent\v1\Transactions\IarRepository;
use App\Repositories\Eloquent\v1\Transactions\RisRepository;
use App\Repositories\Eloquent\v1\Transactions\StdRepository;
use App\Repositories\Eloquent\v1\References\DetailRepository;
use App\Repositories\Eloquent\v1\References\OfficeRepository;
use App\Repositories\Eloquent\v1\References\RegionRepository;
use App\Repositories\Eloquent\v1\References\SupplyRepository;
use App\Repositories\Eloquent\v1\Reports\IarReportRepository;
use App\Repositories\Eloquent\v1\Transactions\PtisRepository;
use App\Repositories\Eloquent\v1\References\CountryRepository;
use App\Repositories\Eloquent\v1\References\EndUserRepository;
use App\Repositories\Eloquent\v1\Dashboard\DashboardRepository;
use App\Repositories\Eloquent\v1\References\CategoryRepository;
use App\Repositories\Eloquent\v1\References\FpaoUnitRepository;
use App\Repositories\Eloquent\v1\References\MunicityRepository;
use App\Repositories\Eloquent\v1\References\ProvinceRepository;
use App\Repositories\Eloquent\v1\References\SupplierRepository;
use App\Repositories\Interfaces\v1\EloquentRepositoryInterface;
use App\Repositories\Eloquent\v1\References\ConditionRepository;
use App\Repositories\Eloquent\v1\References\SignatoryRepository;
use App\Repositories\Eloquent\v1\References\WarehouseRepository;
use App\Repositories\Eloquent\v1\Transactions\StdItemRepository;
use App\Repositories\Eloquent\v1\Transactions\TallyInRepository;
use App\Repositories\Eloquent\v1\References\DocSettingRepository;
use App\Repositories\Eloquent\v1\Reports\TallyInReportRepository;
use App\Repositories\Eloquent\v1\Transactions\TallyOutRepository;
use App\Repositories\Eloquent\v1\References\FundClusterRepository;
use App\Repositories\Eloquent\v1\References\SignatoryCoRepository;
use App\Repositories\Eloquent\v1\Transactions\DdaPackedRepository;
use App\Repositories\Eloquent\v1\Transactions\InventoryRepository;
use App\Repositories\Eloquent\v1\Transactions\PtisItemsRepository;
use App\Repositories\Eloquent\v1\Transactions\StockCardRepository;
use App\Repositories\Eloquent\v1\References\ManufacturerRepository;
use App\Repositories\Eloquent\v1\References\NomenclatureRepository;
use App\Repositories\Eloquent\v1\Reports\StockCardReportRepository;
use App\Repositories\Eloquent\v1\References\AmmunitionUomRepository;
use App\Repositories\Eloquent\v1\References\ServicingFpaoRepository;
use App\Repositories\Eloquent\v1\References\UserWarehouseRepository;
use App\Repositories\Eloquent\v1\References\AmmunitionTypeRepository;
use App\Repositories\Eloquent\v1\References\ClassificationRepository;
use App\Repositories\Eloquent\v1\References\UacsObjectCodeRepository;
use App\Repositories\Eloquent\v1\Transactions\DdaNrDefectsRepository;
use App\Repositories\Interfaces\v1\References\FpaoRepositoryInterface;
use App\Repositories\Interfaces\v1\References\FssuRepositoryInterface;
use App\Repositories\Interfaces\v1\References\MakeRepositoryInterface;
use App\Repositories\Interfaces\v1\References\TypeRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionDetailRepository;
use App\Repositories\Eloquent\v1\References\AmmunitionSupplyRepository;
use App\Repositories\Interfaces\v1\Transactions\DdaRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IarRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StdRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionArticleRepository;
use App\Repositories\Eloquent\v1\References\UnitOfMeasurementRepository;
use App\Repositories\Eloquent\v1\Transactions\DdaNrDefectivesRepository;
use App\Repositories\Interfaces\v1\References\DetailRepositoryInterface;
use App\Repositories\Interfaces\v1\References\OfficeRepositoryInterface;
use App\Repositories\Interfaces\v1\References\RegionRepositoryInterface;
use App\Repositories\Interfaces\v1\References\SupplyRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\IarReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\PtisRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionCategoryRepository;
use App\Repositories\Eloquent\v1\References\ResponsibilityCodeRepository;
use App\Repositories\Interfaces\v1\References\CountryRepositoryInterface;
use App\Repositories\Interfaces\v1\References\EndUserRepositoryInterface;
use App\Repositories\Eloquent\v1\Transactions\IssuanceDirectiveRepository;
use App\Repositories\Interfaces\v1\Dashboard\DashboardRepositoryInterface;
use App\Repositories\Interfaces\v1\References\CategoryRepositoryInterface;
use App\Repositories\Interfaces\v1\References\FpaoUnitRepositoryInterface;
use App\Repositories\Interfaces\v1\References\MunicityRepositoryInterface;
use App\Repositories\Interfaces\v1\References\ProvinceRepositoryInterface;
use App\Repositories\Interfaces\v1\References\SupplierRepositoryInterface;
use App\Repositories\Eloquent\v1\Reports\IssuanceDirectiveReportRepository;
use App\Repositories\Eloquent\v1\Transactions\StockCardReferenceRepository;
use App\Repositories\Interfaces\v1\References\ConditionRepositoryInterface;
use App\Repositories\Interfaces\v1\References\SignatoryRepositoryInterface;
use App\Repositories\Interfaces\v1\References\WarehouseRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StdItemRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyInRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionSizeCaliberRepository;
use App\Repositories\Interfaces\v1\References\DocSettingRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\TallyInReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionNomenclatureRepository;
use App\Repositories\Eloquent\v1\References\AmmunitionSizeCalliberRepository;
use App\Repositories\Interfaces\v1\References\FundClusterRepositoryInterface;
use App\Repositories\Interfaces\v1\References\SignatoryCoRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaPackedRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Eloquent\v1\Transactions\IssuanceDirectiveItemRepository;
use App\Repositories\Interfaces\v1\References\ManufacturerRepositoryInterface;
use App\Repositories\Interfaces\v1\References\NomenclatureRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\StockCardReportRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionClassificationRepository;
use App\Repositories\Eloquent\v1\References\IssuanceDirectivePurposeRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionUomRepositoryInterface;
use App\Repositories\Interfaces\v1\References\ServicingFpaoRepositoryInterface;
use App\Repositories\Interfaces\v1\References\UserWarehouseRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionTypeRepositoryInterface;
use App\Repositories\Interfaces\v1\References\ClassificationRepositoryInterface;
use App\Repositories\Interfaces\v1\References\UacsObjectCodeRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectsRepositoryInterface;
use App\Repositories\Eloquent\v1\References\AmmunitionHeadStumpMarkingRepository;
use App\Repositories\Eloquent\v1\References\IssuanceDirectiveConditionRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionDetailRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionSupplyRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionArticleRepositoryInterface;
use App\Repositories\Interfaces\v1\References\UnitOfMeasurementRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectivesRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionCategoryRepositoryInterface;
use App\Repositories\Interfaces\v1\References\ResponsibilityCodeRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\IssuanceDirectiveReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardReferenceRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionSizeCaliberRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionNomenclatureRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionSizeCalliberRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionClassificationRepositoryInterface;
use App\Repositories\Interfaces\v1\References\IssuanceDirectivePurposeRepositoryInterface;
use App\Repositories\Interfaces\v1\References\AmmunitionHeadStumpMarkingRepositoryInterface;
use App\Repositories\Interfaces\v1\References\IssuanceDirectiveConditionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
    
        //References
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(MakeRepositoryInterface::class, MakeRepository::class);
        $this->app->bind(UnitOfMeasurementRepositoryInterface::class, UnitOfMeasurementRepository::class);
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);
        $this->app->bind(ConditionRepositoryInterface::class, ConditionRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(SignatoryRepositoryInterface::class, SignatoryRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(NomenclatureRepositoryInterface::class, NomenclatureRepository::class);
        $this->app->bind(ClassificationRepositoryInterface::class, ClassificationRepository::class);
        $this->app->bind(SupplyRepositoryInterface::class, SupplyRepository::class);
        $this->app->bind(DetailRepositoryInterface::class, DetailRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(ManufacturerRepositoryInterface::class, ManufacturerRepository::class);
        $this->app->bind(ServicingFpaoRepositoryInterface::class, ServicingFpaoRepository::class);
        $this->app->bind(FundClusterRepositoryInterface::class, FundClusterRepository::class);
        $this->app->bind(OfficeRepositoryInterface::class, OfficeRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(MunicityRepositoryInterface::class, MunicityRepository::class);
        $this->app->bind(AmmunitionCategoryRepositoryInterface::class, AmmunitionCategoryRepository::class);
        $this->app->bind(AmmunitionClassificationRepositoryInterface::class, AmmunitionClassificationRepository::class);
        $this->app->bind(AmmunitionDetailRepositoryInterface::class, AmmunitionDetailRepository::class);
        $this->app->bind(AmmunitionNomenclatureRepositoryInterface::class, AmmunitionNomenclatureRepository::class);
        $this->app->bind(AmmunitionSizeCaliberRepositoryInterface::class, AmmunitionSizeCaliberRepository::class);
        $this->app->bind(AmmunitionSupplyRepositoryInterface::class, AmmunitionSupplyRepository::class);
        $this->app->bind(AmmunitionTypeRepositoryInterface::class, AmmunitionTypeRepository::class);
        $this->app->bind(AmmunitionUomRepositoryInterface::class, AmmunitionUomRepository::class);
        $this->app->bind(IssuanceDirectivePurposeRepositoryInterface::class, IssuanceDirectivePurposeRepository::class);
        $this->app->bind(IssuanceDirectiveConditionRepositoryInterface::class, IssuanceDirectiveConditionRepository::class);
        $this->app->bind(FpaoRepositoryInterface::class, FpaoRepository::class);
        $this->app->bind(FssuRepositoryInterface::class, FssuRepository::class);
        $this->app->bind(FpaoUnitRepositoryInterface::class, FpaoUnitRepository::class);
        $this->app->bind(UserWarehouseRepositoryInterface::class, UserWarehouseRepository::class);
        $this->app->bind(ResponsibilityCodeRepositoryInterface::class, ResponsibilityCodeRepository::class);
        $this->app->bind(DocSettingRepositoryInterface::class, DocSettingRepository::class);
        $this->app->bind(AmmunitionHeadStumpMarkingRepositoryInterface::class, AmmunitionHeadStumpMarkingRepository::class);
        $this->app->bind(SignatoryCoRepositoryInterface::class, SignatoryCoRepository::class);
        $this->app->bind(EndUserRepositoryInterface::class, EndUserRepository::class);
        $this->app->bind(AmmunitionArticleRepositoryInterface::class, AmmunitionArticleRepository::class);
        $this->app->bind(UacsObjectCodeRepositoryInterface::class, UacsObjectCodeRepository::class);

        //Transaction
        $this->app->bind(TallyInRepositoryInterface::class, TallyInRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class, InventoryRepository::class);
        $this->app->bind(IarRepositoryInterface::class, IarRepository::class);
        $this->app->bind(StockCardRepositoryInterface::class, StockCardRepository::class);
        $this->app->bind(IssuanceDirectiveRepositoryInterface::class, IssuanceDirectiveRepository::class);
        $this->app->bind(IssuanceDirectiveItemRepositoryInterface::class, IssuanceDirectiveItemRepository::class);
        $this->app->bind(RisRepositoryInterface::class, RisRepository::class);
        $this->app->bind(TallyOutRepositoryInterface::class, TallyOutRepository::class);
        $this->app->bind(StockCardReferenceRepositoryInterface::class, StockCardReferenceRepository::class);

        //Report
        $this->app->bind(TallyInReportRepositoryInterface::class, TallyInReportRepository::class);
        $this->app->bind(IarReportRepositoryInterface::class, IarReportRepository::class);
        $this->app->bind(IssuanceDirectiveReportRepositoryInterface::class, IssuanceDirectiveReportRepository::class);
        $this->app->bind(StockCardReportRepositoryInterface::class, StockCardReportRepository::class);

        //Dashboard
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
    
        //STD
        $this->app->bind(StdRepositoryInterface::class, StdRepository::class);
        $this->app->bind(StdItemRepositoryInterface::class, StdItemRepository::class);

        //DDA
        $this->app->bind(DdaRepositoryInterface::class, DdaRepository::class);
        $this->app->bind(DdaPackedRepositoryInterface::class, DdaPackedRepository::class);
        $this->app->bind(DdaNrDefectsRepositoryInterface::class, DdaNrDefectsRepository::class);
        $this->app->bind(DdaNrDefectivesRepositoryInterface::class, DdaNrDefectivesRepository::class);

        //PTIS
        $this->app->bind(PtisRepositoryInterface::class, PtisRepository::class);
        $this->app->bind(PtisItemRepositoryInterface::class, PtisItemsRepository::class);
    }
}