<?php

namespace Database\Seeders;

use App\Models\WorkModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = ['Doctor', 'Teacher', 'Accountant', 'Project Manager', 'Content Writer', 'Human Resource', 'Nurse', 'Wrestler', 'Athlete', 'Entrepenuer', 'SoftWare Engineer'];

        foreach ($works as $work) {
            WorkModel::create(['name' => $work]);
        }
    }
}
