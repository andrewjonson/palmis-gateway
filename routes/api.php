<?php

require_once __DIR__ . '/Resource.php';

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api/'.config('app.version').'/sumis'], function() use($router) {
    // References
    resource('/supplier', 'References\SupplierController', $router);
    resource('/make', 'References\MakeController', $router);
    resource('/unit-of-measurement', 'References\UnitOfMeasurementController', $router);
    resource('/warehouse', 'References\WarehouseController', $router);
    resource('/condition', 'References\ConditionController', $router);
    resource('/country', 'References\CountryController', $router);
    resource('/signatory', 'References\SignatoryController', $router);
    resource('/manufacturer', 'References\ManufacturerController', $router);
    resource('/servicing-fpao', 'References\ServicingFpaoController', $router);
    resource('/fund-cluster', 'References\FundClusterController', $router);
    resource('/office', 'References\OfficeController', $router);
    resource('/region', 'References\RegionController', $router);
    resource('/province', 'References\ProvinceController', $router);
    resource('/municity', 'References\MunicityController', $router);
    resource('/issuance-directive-purpose', 'References\IssuanceDirectivePurposeController', $router);
    resource('/issuance-directive-condition', 'References\IssuanceDirectiveConditionController', $router);
    resource('/fpao', 'References\FpaoController', $router);
    resource('/fssu', 'References\FssuController', $router);

    resource('/fpao-unit', 'References\FpaoUnitController', $router);
    $router->get('/fpaounit/get-unit/{id}', 'v1\References\FpaoUnitController@filterUnit');

    resource('/user-warehouse', 'References\UserWarehouseController', $router);
    resource('/responsibility-code', 'References\ResponsibilityCodeController', $router);
    resource('/doc-setting', 'References\DocSettingController', $router);

    $router->group(['prefix' => 'ammunition'], function() use($router) {
        resource('/category', 'References\AmmunitionCategoryController', $router);
        $router->get('/category-search', 'v1\References\AmmunitionCategoryController@search');
        resource('/classification', 'References\AmmunitionClassificationController', $router);
        resource('/detail', 'References\AmmunitionDetailController', $router);
        resource('/nomenclature', 'References\AmmunitionNomenclatureController', $router);
        resource('/size-caliber', 'References\AmmunitionSizeCaliberController', $router);
        resource('/supply', 'References\AmmunitionSupplyController', $router);
        resource('/type', 'References\AmmunitionTypeController', $router);
        resource('/uom', 'References\AmmunitionUomController', $router);
        resource('/head-stump-marking', 'References\AmmunitionHeadStumpMarkingController', $router);
    });

    //transactions
    //Tally In
    $router->post('/tally-in/store', 'v1\Transactions\TallyInController@bulkStoreTallyIn');
    $router->get('/tally-in', 'v1\Transactions\TallyInController@getTallyIn');
    $router->get('/print-tally-in/{id}', 'v1\Transactions\TallyInController@printTallyIn');
    $router->get('/filter-tally', 'v1\Transactions\TallyInController@getFilterTally');
    $router->post('/update-directive-item', 'v1\Transactions\RisController@updateDirectiveItems');
    $router->put('/tally/update-tally-in/{id}', 'v1\Transactions\TallyInController@update');
    $router->delete('/tally/delete-tally-in/{id}', 'v1\Transactions\TallyInController@deleteTallyIn');
    
    //Report
    $router->get('/report/tally-in/{id}', 'v1\Reports\TallyInReportController@getReportTallyIn');
    $router->get('/report/iar/{id}', 'v1\Reports\IarReportController@getReportIar');
    $router->get('/report/issuance-directive/{id}', 'v1\Reports\IssuanceDirectiveReportController@getReportIssuanceDirective');
    $router->get('/report/stock-card/{id}', 'v1\Reports\StockCardReportController@getReportStockCard');
    
    // IAR
    $router->group(['prefix' => 'iar'], function() use($router) {
        $router->post('/create/{id}', 'v1\Transactions\IarController@create');
        $router->get('/get-inventory/{id}', 'v1\Transactions\IarController@getInventoryByTallyId');
        $router->get('/tally-inventory/{id}', 'v1\Transactions\IarController@getByTallyId');
        $router->get('/get-list', 'v1\Transactions\IarController@getIarList');
    });

    // Stock Card
    $router->get('/stockcard/getlist', 'v1\Transactions\StockCardController@getList');
    $router->get('/stockcard/get-by-id/{id}', 'v1\Transactions\StockCardController@getStockCardById');

    //Issuance
    $router->group(['prefix' => 'issuance'], function() use($router) {
        $router->get('/get-stockcard', 'v1\Transactions\StockCardController@getList');
        $router->post('/create', 'v1\Transactions\IssuanceDirectiveController@bulkStore');
        $router->get('/get-issuance', 'v1\Transactions\IssuanceDirectiveController@getIssuanceDirective');
        $router->get('/get-by-id/{id}', 'v1\Transactions\IssuanceDirectiveController@getIssuanceById');
        $router->post('/create-item', 'v1\Transactions\IssuanceDirectiveController@createItem');
        $router->delete('/delete-item/{id}', 'v1\Transactions\IssuanceDirectiveController@deleteItem');
        $router->put('/update/{id}', 'v1\Transactions\IssuanceDirectiveController@updateIssuanceDirective');
        $router->delete('/delete/{id}', 'v1\Transactions\IssuanceDirectiveController@deleteIssuanceDirective');
    });
    
    //Inventory
    $router->get('/inventory', 'v1\Transactions\InventoryController@get');
    $router->get('/inventory/search-lotnr', 'v1\Transactions\InventoryController@searchLotNr');

    // Doc Settings
    $router->get('/toggle-signatory', 'v1\References\SignatoryController@toggleSignatory');
    $router->get('/toggle-doc-setting', 'v1\References\DocSettingController@getDocSetting');

    // RIS
    $router->get('/ris/get-list', 'v1\Transactions\RisController@getRisList');
    $router->get('/ris/search/{id}', 'v1\Transactions\RisController@getRisById');

    //Issuance Directive Item
    $router->put('/id-item/update', 'v1\Transactions\IssuanceDirectiveItemController@updateIdItem');

    //Dashboard
    $router->get('/dashboard/per-pamu/{id}', 'v1\Dashboard\DashboardController@getListNomenclaturePerPamu');
});