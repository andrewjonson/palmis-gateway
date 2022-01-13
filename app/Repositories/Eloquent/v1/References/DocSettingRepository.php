<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\DocSetting;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\DocSettingRepositoryInterface;

class DocSettingRepository extends BaseRepository implements DocSettingRepositoryInterface
{
    public function __construct(DocSetting $model)
    {
        $this->model = $model;
    }
}