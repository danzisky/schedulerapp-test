<?php

namespace Database\Seeders;

use App\Models\Consultant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultant::create([
            'name' => 'Johnny Drille',
        ]);
        Consultant::create([
            'name' => 'Justina Ludwig',
        ]);
    }
}
