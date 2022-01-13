<?php

namespace App\Repositories\Interfaces\v1\Transactions;

interface TallyInRepositoryInterface
{
    public function getTally($request);

    public function printTally($id);
    
    public function filterTally($stock_disposition, $category_id);
}