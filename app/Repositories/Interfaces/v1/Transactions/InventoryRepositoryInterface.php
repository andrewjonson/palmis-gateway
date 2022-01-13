<?php

namespace App\Repositories\Interfaces\v1\Transactions;

interface InventoryRepositoryInterface
{
    public function getTallyId($id);

    public function getInventory($request);

    public function searchLotNr($lotNr);
}