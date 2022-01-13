<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\FpaoUnitRepositoryInterface;

class FpaoUnitTableSeeder extends Seeder
{
    public function __construct(FpaoUnitRepositoryInterface $fpaoUnitRepository)
    {
        $this->fpaoUnitRepository = $fpaoUnitRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['fpao_id' => 1, 'unit' => 'TRADOC'],
            (object)['fpao_id' => 1, 'unit' => 'ARMOR'],
            (object)['fpao_id' => 1, 'unit' => '3RCDG, ARESCOM'],
            (object)['fpao_id' => 1, 'unit' => 'F1RCDG, ARESCOMot'],
            (object)['fpao_id' => 1, 'unit' => '1FAU, ASPA'],
            (object)['fpao_id' => 1, 'unit' => '1FSFO, FCPA'],
            (object)['fpao_id' => 1, 'unit' => '1IMB, IMCOM'],
            (object)['fpao_id' => 1, 'unit' => '3ISU, AIR'],
            (object)['fpao_id' => 2, 'unit' => '2FSFO, FCPA'],
            (object)['fpao_id' => 2, 'unit' => '2RCDG, ARESCOM'],
            (object)['fpao_id' => 2, 'unit' => '2FAU, ASPA'],
            (object)['fpao_id' => 2, 'unit' => '5Sig Bn, ASR'],
            (object)['fpao_id' => 2, 'unit' => '5ID, PA'],
            (object)['fpao_id' => 2, 'unit' => 'TRF'],
            (object)['fpao_id' => 2, 'unit' => 'IGF'],
            (object)['fpao_id' => 2, 'unit' => '5ATG, TRADOC'],
            (object)['fpao_id' => 2, 'unit' => '2FSSU, ASCOM'],
            (object)['fpao_id' => 2, 'unit' => '14RCDG, ARESCOM'],
            (object)['fpao_id' => 2, 'unit' => '2ISU, AIR(P)'],
            (object)['fpao_id' => 2, 'unit' => '5IMB, IMCOM(P)'],
            (object)['fpao_id' => 3, 'unit' => 'SALBAT, AAR'],
            (object)['fpao_id' => 3, 'unit' => '1ADA, AAR'],
            (object)['fpao_id' => 3, 'unit' => 'T2ADA, AARRF'],
            (object)['fpao_id' => 3, 'unit' => 'HAAR'],
            (object)['fpao_id' => 3, 'unit' => 'SFR(A)'],
            (object)['fpao_id' => 3, 'unit' => '1BCT'],
            (object)['fpao_id' => 3, 'unit' => '3FAU, ASPA'],
            (object)['fpao_id' => 3, 'unit' => 'SOCOM, PA'],
            (object)['fpao_id' => 3, 'unit' => '1MLRS, AAR'],
            (object)['fpao_id' => 3, 'unit' => '2MLRS, AAR'],
            (object)['fpao_id' => 3, 'unit' => '7ID'],
            (object)['fpao_id' => 3, 'unit' => '7FAB, AAR'],
            (object)['fpao_id' => 3, 'unit' => '8FAB, AAR'],
            (object)['fpao_id' => 3, 'unit' => '9FAB, AAR'],
            (object)['fpao_id' => 3, 'unit' => 'LRR'],
            (object)['fpao_id' => 3, 'unit' => 'FSRR'],
            (object)['fpao_id' => 3, 'unit' => '7SigBn, ASR'],
            (object)['fpao_id' => 3, 'unit' => '3FSFO, FCPA'],
            (object)['fpao_id' => 3, 'unit' => '1IBMS, AAR'],
            (object)['fpao_id' => 3, 'unit' => '2IBMS, AAR'],
            (object)['fpao_id' => 3, 'unit' => '1st 1551st, AAR'],
            (object)['fpao_id' => 3, 'unit' => '2nd 1551st, AAR'],
            (object)['fpao_id' => 3, 'unit' => '1FSSU, ASCOM'],
            (object)['fpao_id' => 3, 'unit' => '7IMB, IMCOM(P)']
        ];

        foreach($seeds as $seed) {
            $this->fpaoUnitRepository->create([
                'fpao_id' => $seed->fpao_id,
                'unit' => $seed->unit,
                'created_by' => 1
            ]);
        }
    }
}
