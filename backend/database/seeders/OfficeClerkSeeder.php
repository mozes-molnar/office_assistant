<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeClerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('office_clerk')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'description' => 'Lorem ipsum dolor sit amet.',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'description' => 'Ut magna dolor, vestibulum sit amet ante eget, scelerisque fringilla arcu.',
            ],
            [
                'name' => 'Mark Johnson',
                'email' => 'mark@example.com',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
            ],
            [
                'name' => 'Anna Taylor',
                'email' => 'anna@example.com',
                'description' => 'Fusce vel enim sed ante convallis fringilla. Integer pretium justo quis mauris suscipit, eu mollis mauris malesuada.',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david@example.com',
                'description' => 'Nullam suscipit tellus in convallis pretium. Nullam dictum sapien vel justo bibendum, et ultricies sapien pharetra.',
            ],
            [
                'name' => 'Emily Wilson',
                'email' => 'emily@example.com',
                'description' => 'Sed vitae ultricies lorem, eget convallis urna. Morbi vitae justo eget neque fermentum ullamcorper.',
            ],
        ]);
    }
}