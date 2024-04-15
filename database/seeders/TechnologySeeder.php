<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["HTML", "CSS", "SQL", "JavaScript", "PHP", "GIT", "Blade"];
        foreach ($names as $name) {
            $technology = new Technology;
            $technology->name = $name;
            $technology->save();
        }
    }
}
