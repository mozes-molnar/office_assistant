<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'office_clerk_id' => 1,
                'description' => 'Találkozó megszervezése az ügyféllel a projekt részleteiről.',
            ],
            [
                'office_clerk_id' => 2,
                'description' => 'Előkészíteni a jelentést a projekt megvalósításáról.',
            ],
            [
                'office_clerk_id' => 3,
                'description' => 'Megbeszélést tartani a csapat tagjaival a következő lépésekről.',
            ],
            [
                'office_clerk_id' => 4,
                'description' => 'Ellenőrizni az adminisztratív feladatokat és dokumentumokat.',
            ],
            [
                'office_clerk_id' => 5,
                'description' => 'Kapcsolatot tartani a beszállítókkal és partnerekkel.',
            ],
            [
                'office_clerk_id' => 6,
                'description' => 'Közreműködni az üzleti partnerekkel folytatott tárgyalásokban.',
            ],
            [
                'office_clerk_id' => 1,
                'description' => 'Dokumentálni az ügyfél igényeit és visszajelzéseit.',
            ],
            
        ]);
    }
}