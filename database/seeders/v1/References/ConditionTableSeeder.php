<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\ConditionRepositoryInterface;

class ConditionTableSeeder extends Seeder
{
    public function __construct(ConditionRepositoryInterface $conditionRepository)
    {
        $this->conditionRepository = $conditionRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['code' => 'A SERVICEABLE', 'description' => 'Issuance without classification. This category includes all new, used, repaired, reconditioned material which are serviceable and issuable to all customers without limitation and restriction. Normal requirements at time of issue for additional packaging do not constitute a restriction. '],
            (object)['code' => 'B SERVICEABLE', 'description' => 'Issuance without classification. This category includes all new, used, repaired, reconditioned material which are serviceable and issuable for their areas by reason of its limited usefulness or short service life acceptance.'],
            (object)['code' => 'C SERVICEABLE', 'description' => 'Priority for issue. Applies to items which are serviceable and issuable to selected customers, but which must be issued before condition A and B materiel to avoid loss as a usable asset.'],
            (object)['code' => 'D SERVICEABLE', 'description' => 'Test/Modification. This category applies to items in serviceable inventory which are directed by HPA or Higher Headquarters to be tested, altered, modified, converted or disassembled. This does not include items which can be inspected or tested within normal outloading time immediately prior to issue.'],
            (object)['code' => 'E UNSERVICEABLE', 'description' => 'Limited restoration. This category applies to materiel which involves only limited expense or effort to restore to serviceable condition and which is accomplished in the storage activity. Limited expense or effort is defined as that which is allowed for expenditure by the care and preservation activity under current policies. Restoration of materiel in this category normally includes but is not limited to dipping, cleaning, spraying, application of preservatives, painting, masking, packing, masking, packing, boxing, crafting, packaging, wrapping or reprocessing.'],
            (object)['code' => 'F UNSERVICEABLE', 'description' => 'Repairable. This category applies to economically repairable materiel'],
            (object)['code' => 'G UNSERVICEABLE', 'description' => 'Incomplete. This category includes materiel requiring additional parts or components to complete the end items prior to issue. It also applies to major end items are complete with all specified components and meet the prescribe serviceability standards but lack Basic Issue List Item (BILI).'],
            (object)['code' => 'H UNSERVICEABLE', 'description' => 'Condemned. This category includes materiel classified by inspection, teardown analysis or engineering decision to be uneconomically repairable and of no use to the government, except for value of materiel content. This applies to all items of the AFP owned inventory.'],
            (object)['code' => 'I', 'description' => 'Not to be assigned'],
            (object)['code' => 'J SUSPENDED', 'description' => 'In stock. This category applies to materiel in stock which have been suspended from issue pending condition classification or analysis where the true conditions are not known. It includes items not proof accepted, ammunition items awaiting evaluation of test results, and the ammunition items that are overdue for test. It includes returns unclassified as to condition Code E.'],
            (object)['code' => 'K SUSPENDED', 'description' => 'Returned. This category applies to materiel which have been returned from customers and users and are suspended from issue pending, inspection and/or condition classification. It includes items that have been identified by stock number and item name, but not examined for condition.'],
            (object)['code' => 'L SUSPENDED', 'description' => 'Litigation. This category includes assets received from procurement or . other sources which contain shortage, overages, defects or other conditions requiring negotiation or litigation with procurement sources or common carriers to determine responsibility of liability for corrective action. This also include assets held in a frozen status pending the result of a report of survey.'],
            (object)['code' => 'M SUSPENDED', 'description' => 'In work. This category applies to materiel identified on inventory control record but which has been delivered to and accepted by an Army of AFP maintenance facility.'],
            (object)['code' => 'N SUSPENDED', 'description' => 'Suitable for emergency combat use only. Ammunition stocks suspended from issue except emergency combat use.']
        ];

        foreach($seeds as $seed) {
            $this->conditionRepository->create([
                'code' => $seed->code,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
