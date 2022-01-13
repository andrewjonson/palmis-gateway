<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Models\v1\Transactions\Iar;
use App\Models\v1\Transactions\TallyIn;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Transactions\IarRepositoryInterface;

class IarRepository extends BaseRepository implements IarRepositoryInterface
{
    public function __construct(Iar $model, TallyIn $tallyIn)
    {
        $this->model = $model;
        $this->tallyIn = $tallyIn;
    }

    /**
     * 
     */
    public function getByTallyId($id)
    {
        return $this->tallyIn->where('id', $id)->first();
    }

    /**
     * 
     */
    public function getIar($id)
    {
        return $this->model->where('tally_in_id', $id)->first();
    }
}