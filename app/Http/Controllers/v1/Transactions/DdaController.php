<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\v1\Transactions\Inventory;
use App\Http\Resources\v1\Transactions\DdaResource;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\Interfaces\v1\Transactions\DdaRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaPackedRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectsRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectivesRepositoryInterface;

class DdaController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        DdaRepositoryInterface $ddaRepository,
        DdaPackedRepositoryInterface $ddaPackedRepository,
        DdaNrDefectsRepositoryInterface $ddaNrDefectRepository,
        DdaNrDefectivesRepositoryInterface $ddaNrDefectiveRepository
    )
    {
        $this->ddaRepository = $ddaRepository;
        $this->ddaPackedRepository = $ddaPackedRepository;
        $this->ddaNrDefectRepository = $ddaNrDefectRepository;
        $this->ddaNrDefectiveRepository = $ddaNrDefectiveRepository;
    }

    public function createDda(Request $request)
    {
        $inventory = Inventory::where('lot_number', $request->lot_nr)->first();
        
        if (!$inventory) {
            return $this->failedResponse('Lot Number does not exist', BAD_REQUEST);
        }

        $dda = $this->ddaRepository->create($request->all());
        foreach($request->outer_packed as $outer_packed) {
            $ddaPacked = $this->ddaPackedRepository->create([
                'condition_ammunition_item' => $outer_packed['condition_ammunition_item'],
                'packed_type' => 'Outer Packed',
                'dda_id' => $dda->id
            ]);

            foreach($outer_packed['nr_defects'] as $nr_defect) {
                $this->ddaNrDefectRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }

            foreach($outer_packed['nr_defectives'] as $nr_defective) {
                $this->ddaNrDefectiveRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }
        }

        foreach($request->inner_packed as $inner_packed) {
            $ddaPacked = $this->ddaPackedRepository->create([
                'condition_ammunition_item' => $inner_packed['condition_ammunition_item'],
                'packed_type' => 'Inner Packed',
                'dda_id' => $dda->id
            ]);

            foreach($inner_packed['nr_defects'] as $nr_defect) {
                $this->ddaNrDefectRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }

            foreach($inner_packed['nr_defectives'] as $nr_defective) {
                $this->ddaNrDefectiveRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }
        }

        foreach($request->complete_packed as $complete_packed) {
            $ddaPacked = $this->ddaPackedRepository->create([
                'condition_ammunition_item' => $complete_packed['condition_ammunition_item'],
                'packed_type' => 'Complete Packed',
                'dda_id' => $dda->id
            ]);

            foreach($complete_packed['nr_defects'] as $nr_defect) {
                $this->ddaNrDefectRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }

            foreach($complete_packed['nr_defectives'] as $nr_defective) {
                $this->ddaNrDefectiveRepository->create([
                    'dda_packed_id' => $ddaPacked->id,
                    'crit' => $nr_defect['crit'],
                    'maj' => $nr_defect['maj'],
                    'min' => $nr_defect['min']
                ]);
            }
        }

        return $this->successResponse('DDA Created Successfully', DATA_CREATED);
    }

    public function getDda(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->ddaRepository->search($keyword, $rowsPerPage);
            return DdaResource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function getDdaById($id)
    {
        $id = hashid_decode($id);
        $dda = $this->ddaRepository->find($id);
        return new DdaResource($dda);
    }
}
