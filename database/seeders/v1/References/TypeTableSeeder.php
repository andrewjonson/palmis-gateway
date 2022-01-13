<?php

namespace Database\Seeders\v1\References;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\v1\References\AmmunitionTypeRepositoryInterface;

class TypeTableSeeder extends Seeder
{
    public function __construct(AmmunitionTypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            (object)['name' => 'Shot', 'description' => 'Shot'],
            (object)['name' => 'Rubber Bullet', 'description' => 'Rubber Bullet'],
            (object)['name' => 'Ball', 'description' => 'Ball'],
            (object)['name' => 'LR', 'description' => 'LR'],
            (object)['name' => 'AP', 'description' => 'AP'],
            (object)['name' => 'Blank', 'description' => 'Blank'],
            (object)['name' => 'Match', 'description' => 'Match'],
            (object)['name' => 'Ball, Linked', 'description' => 'Ball, Linked'],
            (object)['name' => 'API', 'description' => 'API'],
            (object)['name' => 'API, Linked', 'description' => 'API, Linked'],
            (object)['name' => 'Tracer', 'description' => 'Tracer'],
            (object)['name' => 'Incendiary', 'description' => 'Incendiary'],
            (object)['name' => 'Spotter Tracer', 'description' => 'Spotter Tracer'],
            (object)['name' => 'Ball, M193', 'description' => 'Ball, M193'],
            (object)['name' => 'Ball, M193, Linked', 'description' => 'Ball, M193, Linked'],
            (object)['name' => 'Ball, M855/SS109', 'description' => 'Ball, M855/SS109'],
            (object)['name' => 'Ball, M855/SS109, Linked', 'description' => 'Ball, M855/SS109, Linked'],
            (object)['name' => 'Match, Linked', 'description' => 'Match, Linked'],
            (object)['name' => 'Blank, Linked', 'description' => 'Blank, Linked'],
            (object)['name' => 'HE', 'description' => 'HE'],
            (object)['name' => 'HEI', 'description' => 'HEI'],
            (object)['name' => 'AA', 'description' => 'AA'],
            (object)['name' => 'BL and T', 'description' => 'BL and T'],
            (object)['name' => 'HEI, Linked', 'description' => 'HEI, Linked'],
            (object)['name' => 'TP-T', 'description' => 'TP-T'],
            (object)['name' => 'HEI-T', 'description' => 'HEI-T'],
            (object)['name' => 'SAPHEI-T', 'description' => 'SAPHEI-T'],
            (object)['name' => 'Flare', 'description' => 'Flare'],
            (object)['name' => 'HEI-T, Linked', 'description' => 'HEI-T, Linked'],
            (object)['name' => 'SAPHEI-T, Linked', 'description' => 'SAPHEI-T, Linked'],
            (object)['name' => 'Subcaliber', 'description' => 'Subcaliber'],
            (object)['name' => 'CS', 'description' => 'CS'],
            (object)['name' => 'HEDP', 'description' => 'HEDP'],
            (object)['name' => 'HE-SD', 'description' => 'HE-SD'],
            (object)['name' => 'HEDP, Linked', 'description' => 'HEHEDP, LinkedDP'],
            (object)['name' => 'HE, Linked', 'description' => 'HE, Linked'],
            (object)['name' => 'Practice', 'description' => 'Practice'],
            (object)['name' => 'HEAT', 'description' => 'HEAT'],
            (object)['name' => 'Thermobaric', 'description' => 'Thermobaric'],
            (object)['name' => 'HEIT-SD', 'description' => 'HEIT-SD'],
            (object)['name' => 'AP-T', 'description' => 'AP-T'],
            (object)['name' => 'HE-T', 'description' => 'HE-T'],
            (object)['name' => 'CS, Linked', 'description' => 'CS, Linked'],
            (object)['name' => 'HEP', 'description' => 'HEP'],
            (object)['name' => 'HESH', 'description' => 'HESH'],
            (object)['name' => 'TP', 'description' => 'TP'],
            (object)['name' => 'HESH', 'description' => 'HESH'],
            (object)['name' => 'Smoke', 'description' => 'Smoke'],
            (object)['name' => 'HE, LRBB', 'description' => 'HE, LRBB'],
            (object)['name' => 'Illum', 'description' => 'Illum'],
            (object)['name' => 'HE, ERBT', 'description' => 'HE, ERBT'],
            (object)['name' => 'Charge, Propelling', 'description' => 'Charge, Propelling'],
            (object)['name' => 'PD', 'description' => 'PD'],
            (object)['name' => 'VT', 'description' => 'VT'],
            (object)['name' => 'Nose', 'description' => 'Nose'],
            (object)['name' => 'Tail', 'description' => 'Tail'],
            (object)['name' => 'for Rocket, 2.75in', 'description' => 'for Rocket, 2.75in'],
            (object)['name' => 'Booster', 'description' => 'Booster'],
            (object)['name' => 'C4', 'description' => 'C4'],
            (object)['name' => 'TNT', 'description' => 'TNT'],
            (object)['name' => 'Shaped, Pentolite', 'description' => 'Shaped, Pentolite'],
            (object)['name' => 'Dynamite', 'description' => 'Dynamite'],
            (object)['name' => 'Flake', 'description' => 'Flake'],
            (object)['name' => 'Sheet', 'description' => 'Sheet'],
            (object)['name' => 'Cruciform', 'description' => 'Cruciform'],
            (object)['name' => 'Bangalore, Torpedo', 'description' => 'Bangalore, Torpedo'],
            (object)['name' => 'Cap, Blasting', 'description' => 'Cap, Blasting'],
            (object)['name' => 'Cord, Det', 'description' => 'Cord, Det'],
            (object)['name' => 'Firing Device', 'description' => 'Firing Device'],
            (object)['name' => 'Igniter', 'description' => 'Igniter'],
            (object)['name' => 'Fuse', 'description' => 'Fuse'],
            (object)['name' => 'Smoke', 'description' => 'Smoke'],
            (object)['name' => 'Offensive', 'description' => 'Offensive'],
            (object)['name' => 'Simulator', 'description' => 'Simulator'],
            (object)['name' => 'Riot Control', 'description' => 'Riot Control'],
            (object)['name' => 'Stun', 'description' => 'Stun'],
            (object)['name' => 'HE w/ BT', 'description' => 'HE w/ BT'],
            (object)['name' => 'Laser Guided', 'description' => 'Laser Guided'],
            (object)['name' => 'Motor', 'description' => 'Motor'],
            (object)['name' => 'Warhead', 'description' => 'Warhead'],
            (object)['name' => 'LDGP', 'description' => 'LDGP'],
            (object)['name' => 'Fragmentation', 'description' => 'Fragmentation'],
            (object)['name' => 'GP', 'description' => 'GP'],
            (object)['name' => 'Aircraft', 'description' => 'Aircraft'],
            (object)['name' => 'Surface', 'description' => 'Surface'],
            (object)['name' => 'Personnel Distress', 'description' => 'Personnel Distress']
        ];

        foreach($seeds as $seed) {
            $this->typeRepository->create([
                'name' => $seed->name,
                'description' => $seed->description,
                'created_by' => 1
            ]);
        }
    }
}
