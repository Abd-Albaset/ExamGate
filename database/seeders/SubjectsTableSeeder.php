<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subjects = [
            ['name'       => 'economy'],

            ['name'       => 'management'],

            ['name'       => 'statistics'],

            ['name'       => 'arabic'],

            ['name'       => 'eng1'],

            ['name'       => 'informatics1'],

            ['name'       => 'marketing'],

            ['name'       => 'accounting2'],

            ['name'       => 'ecoMath'],

            ['name'       => 'civilLaw'],

            ['name'       => 'culture'],

            ['name'       => 'eng2'],

            ['name'       => 'corporationAcc'],

            ['name'       => 'microAnalysis'],

            ['name'       => 'finance'],

            ['name'       => 'informatics2'],

            ['name'       => 'commercialLaw'],

            ['name'       => 'eng3'],

            ['name'       => 'coinsAndBanks'],

            ['name'       => 'macroAnalysis'],

            ['name'       => 'publicFinance'],

            ['name'       => 'operationsManagement'],

            ['name'       => 'appliedStatistics'],

            ['name'       => 'eng4']

        ];

        DB::table('subjects')->insert($subjects);

    }
}
