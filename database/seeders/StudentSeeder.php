<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Students;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Students::insert(
            [
                "full_name"=>"ali babayev"
            ]
        );
    }
}
