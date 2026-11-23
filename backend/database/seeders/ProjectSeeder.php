<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        $recruitmentData = [
            [
                'project_id' => 'rec-1',
                'no' => 1,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Roster Crews for November FC M.Champion and TB.Trans Zhou Shan',
                'principal' => 'IMC-Trinity Bermuda',
                'pic' => 'Dina',
                'activities' => 'The Crews headed to Guinea on 7th November 2026',
                'stages' => [1, 1, 1, 1, 1, 1, 1],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-2',
                'no' => 2,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Repration of Crews TB.Trans Yantai MST-URGENT',
                'principal' => 'IMC-Trinity Bermuda',
                'pic' => 'Dina/Ingga',
                'activities' => 'Proposed crews and keep searching the Master Canadidates with experiances Z-Peller and Towing Tug with Experiaces Africa more preferable',
                'stages' => [1, 1, 1, 1, 0, 0, 0],
                'remark' => 'Difficulities to find Master Tug with experiaces Towing and Z-Peller,also Language barrier'
            ],
            [
                'project_id' => 'rec-3',
                'no' => 3,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Roaster Crews for December FC.M.Fortune and TB.Trans Zhou Shan',
                'principal' => 'IMC-Trinity Bermuda',
                'pic' => 'Dina/Ingga',
                'activities' => 'Prepare the list of Crews Change for December 2026 with look for new crews and rejoin crews',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-4',
                'no' => 4,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Crews Change for October JT FC1/JT FC2/JT TUG3/JT TUG4',
                'principal' => 'Monsoon-Bohai',
                'pic' => 'Dina/Herindra',
                'activities' => 'Crews Change for October postpone and will plan in November,for the list of Roster Complated and Waitig for the Ticket Issue and also the Sea Contract',
                'stages' => [1, 1, 1, 1, 1, 1, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-5',
                'no' => 5,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Opportunities for Position 2nd Officer of MV ULTRA COEGA deadline End of November 2026 salary 3600-3800$ solo join CBA 9M+/-1',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Keep saerching of 2nd Officer for fill up that candidates-URGENT',
                'stages' => [1, 1, 0, 0, 0, 0, 0],
                'remark' => 'A lot of Candiates already proposed and still unqualified with the client request'
            ],
            [
                'project_id' => 'rec-6',
                'no' => 6,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => '4E for Ultra Belegue and Ultra Agulhas complated',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => '4E-Sukamto waiting for the schedule of departure and 4E-Ramadan Adi.S waiting for complated documentations and schedule for departure',
                'stages' => [1, 1, 1, 1, 1, 0, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-7',
                'no' => 7,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'COLEMAN START-Conatiner Ship look for OILER and 4E join in China',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-8',
                'no' => 8,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'ORCHARD STAR-Container,AB/MB/OLR estimation join beginning of Dec 2026',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-9',
                'no' => 9,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'MV ULTRA BENGUELA AB join in Dec SALARY 1751$',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-10',
                'no' => 10,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'MV ULTRA COEGA AB join in Dec SALARY 1363$ in Singapore',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-11',
                'no' => 11,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'MV ULTRA AGULAHS 2E estimation join in Sinagpore in Mid Dec 2026,salary 4896$',
                'principal' => 'Monsoon-WestNav',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-12',
                'no' => 12,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Fitter for SPV in Egypth Operation or middle East BGP estimation join on 15th November 2026 Salary 1800$-2000$',
                'principal' => 'Monsoon-BGP',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 1, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-13',
                'no' => 13,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'MV Capricorn 5 NEED MASTER SPB EX AFRICA URGENT Join asap',
                'principal' => 'SKY LINE',
                'pic' => 'Dina',
                'activities' => 'Look for the suitable candidates',
                'stages' => [1, 1, 0, 0, 0, 0, 0],
                'remark' => 'Still look for the suitable Candidates'
            ],
            [
                'project_id' => 'rec-14',
                'no' => 14,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'MV Capricorn 2 AB Repetation just wait for schedule departure',
                'principal' => 'SKY LINE',
                'pic' => 'Dina',
                'activities' => 'the Candidates just wait for the Ticket and Sea Contract',
                'stages' => [1, 1, 1, 1, 1, 1, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-15',
                'no' => 15,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Crews change Novemeber for MV Capricorn 5,1 and MV BLUE WAVE Complated',
                'principal' => 'SKY LINE',
                'pic' => 'Dina',
                'activities' => 'the Crews headed to Guinea on 7th November 2026 and 6th November 2026',
                'stages' => [1, 1, 1, 1, 1, 1, 1],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-16',
                'no' => 16,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'a lot of opportunities and available position they offers,we still look for the suitable candidates for fill up that position',
                'principal' => 'CHH and others China Clients',
                'pic' => 'Dina',
                'activities' => 'Keep going to propose the candidates',
                'stages' => [1, 0, 0, 0, 0, 0, 0],
                'remark' => 'Try to find suitable candidates as per they request'
            ],
            [
                'project_id' => 'rec-17',
                'no' => 17,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'STS-Arrange the set of crewsof FC and TUG for STS,PROCESS THE INTERVIEW and will continou tomorrow',
                'principal' => 'STS',
                'pic' => 'Herindra/Ingga',
                'activities' => 'The Candidates already interview and continou tomorrow',
                'stages' => [1, 1, 1, 1, 0, 0, 0],
                'remark' => 'Still look for the available candidates'
            ],
            [
                'project_id' => 'rec-18',
                'no' => 18,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Set a crews for FC the Yuan Peng Crews Batch 1',
                'principal' => 'Yuan Peng',
                'pic' => 'Herindra/Lifia',
                'activities' => 'The 1st Batch already interview just wait the ship come to indonesia',
                'stages' => [1, 1, 1, 1, 1, 0, 1],
                'remark' => 'waiting so long for the ship come to indonesia'
            ],
            [
                'project_id' => 'rec-19',
                'no' => 19,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Set a crews for FC the Yuan Peng Crews Batch 2',
                'principal' => 'Yuan Peng',
                'pic' => 'Herindra/Lifia',
                'activities' => 'The list of Crews List Yuang Peng FC 2 on process',
                'stages' => [1, 1, 0, 0, 0, 0, 0],
                'remark' => 'waiting so long for the ship come to indonesia'
            ],
            [
                'project_id' => 'rec-20',
                'no' => 20,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Set a crews for TB.MICHELA join in Paiton',
                'principal' => 'LPR',
                'pic' => 'Herindra/Halya',
                'activities' => 'The Crews joined already in Paiton compalted',
                'stages' => [1, 1, 1, 1, 1, 1, 1],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-21',
                'no' => 21,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Crews Change for Sea Safe 006&008 on process',
                'principal' => 'SEA SAFE',
                'pic' => 'Herindra/Halya',
                'activities' => 'The Crews for SS 006 tomorrow will interview',
                'stages' => [1, 1, 1, 1, 0, 0, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-22',
                'no' => 22,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Crews Change for Sea Safe 006&008 on process',
                'principal' => 'SEA SAFE',
                'pic' => 'Herindra/Lifia',
                'activities' => 'SS 008 BSN will signed contract tomorrow and waiting schedule for departure',
                'stages' => [1, 1, 1, 1, 1, 1, 0],
                'remark' => 'No issue'
            ],
            [
                'project_id' => 'rec-23',
                'no' => 23,
                'division' => 'recruitment',
                'date' => '2026-11-11',
                'name' => 'Crews Change For JP 17 MST and 2nd Officer',
                'principal' => 'JAYA PERKASA SAMODERA',
                'pic' => 'Herindra/Halya',
                'activities' => 'MST and 2nd Officer waiting schedule for on board and will arrange to join in TG.Priok',
                'stages' => [1, 1, 1, 1, 1, 1, 0],
                'remark' => 'No issue'
            ]
        ];

        foreach ($recruitmentData as $item) {
            Project::create($item);
        }

        // ADM Division placeholder projects (15 slots)
        for ($i = 1; $i <= 15; $i++) {
            Project::create([
                'project_id' => "adm-{$i}",
                'no' => $i,
                'division' => 'adm',
                'date' => '2026-11-11',
                'name' => '',
                'principal' => '',
                'pic' => '',
                'activities' => '',
                'stages' => [0, 0, 0, 0, 0, 0, 0],
                'remark' => ''
            ]);
        }
    }
}
