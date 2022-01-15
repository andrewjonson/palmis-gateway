<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionArticleRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionArticleResource;
use Illuminate\Http\Request;

class AmmunitionArticleController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionArticleRepositoryInterface $ammunitionArticleRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionArticleRepository;
        $this->resource = AmmunitionArticleResource::class;
        $this->modelName = 'AmmunitionArticle';

        parent::__construct($request);
    }
}
