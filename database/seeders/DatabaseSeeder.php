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


        $this->call(CollegesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'AbdAlbaset',
            'email' => 'abd@kernelX.com',
            'password' => Hash::make('000000') ,
            'role_id' => 1

        ]);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
