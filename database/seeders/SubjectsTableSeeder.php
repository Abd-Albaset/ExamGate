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
            ['name'       => 'economy',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'management',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'statistics',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'arabic',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'eng1',
            'college_id'    => 1,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 1],

            ['name'       => 'informatics1',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],

            ['name'       => 'marketing',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],

            ['name'       => 'accounting2',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],

            ['name'       => 'ecoMath',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'civilLaw',
            'college_id'    => 2,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],

            ['name'       => 'culture',
            'college_id'    => 1,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],

            ['name'       => 'eng2',
            'college_id'    => 1,
            'year'       => 1,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'corporationAcc',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'microAnalysis',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'finance',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'informatics2',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'commercialLaw',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'eng3',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 1],
            
            ['name'       => 'coinsAndBanks',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'macroAnalysis',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'publicFinance',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'operationsManagement',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'appliedStatistics',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2],
            
            ['name'       => 'eng4',
            'college_id'    => 2,
            'year'       => 2,
            'specialize' => 'none',
            'semester'   => 2]

        ];

        DB::table('subjects')->insert($subjects);
       
    }
}
