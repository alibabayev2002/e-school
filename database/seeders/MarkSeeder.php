<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mark;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mark::insert([
            "subject_id" => 3,
            "student_id" => 5,
            "mark" => "4",
            "date" => date('Y-m-d'),
        ]);
    }
}
