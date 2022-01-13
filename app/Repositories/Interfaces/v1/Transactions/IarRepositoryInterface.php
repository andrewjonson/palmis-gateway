<?php

namespace App\Repositories\Interfaces\v1\Transactions;

interface IarRepositoryInterface
{
    public function getByTallyId($id);

    public function getIar($id);

}