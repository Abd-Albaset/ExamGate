<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\College;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Subject::truncate();


       //$this->call(CollegesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        DB::table('users')->insert([
            [
                'name' => 'AbdAlbaset',
                'email' => 'abd@kernelX.com',
                'password' => Hash::make('000000') ,
                'role_id' => 1
            ],
            [
                'name' => 'instructor',
                'email' => 'instructor@kernelX.com',
                'password' => Hash::make('000000') ,
                'role_id' => 2
            ]
        ]);

//        for ($i = 1; $i <= 10 ; $i++) {
//            DB::table('questions')->insert([
//                'subject_id' => 1,
//                'session' => '2020_2',
//                'number' => $i,
//                'q-text' => 'test test test'
//            ]);
//        }
//
//        for ($j = 0; $j <= 10 ; $j++) {
//            DB::table('answers')->insert([
//                [
//                'question_id' => 1,
//                'label' => 'A',
//                'a-text' => 'eco pri',
//                'IsCorrect' => 1
//                ],
//                [
//                    'question_id' => 1,
//                    'label' => 'B',
//                    'a-text' => 'eco pri',
//                    'IsCorrect' => 0
//                ],[
//                    'question_id' => 1,
//                    'label' => 'C',
//                    'a-text' => 'eco pri',
//                    'IsCorrect' => 0
//                ],[
//                    'question_id' => 1,
//                    'label' => 'D',
//                    'a-text' => 'eco pri',
//                    'IsCorrect' => 0
//                ]
//            ]);
//        }





        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
