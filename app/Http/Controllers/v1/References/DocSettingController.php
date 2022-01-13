<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\v1\References\DocSetting;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\References\DocSettingResource;
use App\Repositories\Interfaces\v1\References\DocSettingRepositoryInterface;

class DocSettingController extends Controller
{
    protected $rules = [
        'logo' => 'required|image|mimes:jpeg,jpg,png',
        'header' => 'required'
    ];

    public function __construct(
        DocSettingRepositoryInterface $docSettingRepository, 
        Request $request
    )
    {
        $this->modelRepository = $docSettingRepository;
        $this->resource = DocSettingResource::class;
        $this->modelName = 'DocSetting';

        parent::__construct($request);
    }

    public function getDocSetting()
    {
        $user = Auth::user()->team_id;
        
        try {
            $data = DocSetting::orderByDesc('id')->first();
            return new $this->resource($data);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        try {
            $headerLogo = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('header_logos'), $headerLogo);

            $docSettting = $this->modelRepository->create([
                'header' => $request->header,
                'logo' => $headerLogo
            ]);
            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        $this->validateRequest($request, $id);
        try {
            if (file_exists(public_path('/header_logos/'.$data->logo))) {
                unlink(public_path('/header_logos/'.$data->logo));
            }

            $headerLogo = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('header_logos'), $headerLogo);

            $docSettting = $this->modelRepository->create([
                'unit_id' => hashid_decode($request->unit_id),
                'header' => $request->header,
                'logo' => $headerLogo
            ], $id);
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
