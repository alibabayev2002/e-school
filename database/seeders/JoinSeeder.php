<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Join;

class JoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Join::create([
            "student_id"=>1,
            "subject"=>1
        ]);
    }
}
