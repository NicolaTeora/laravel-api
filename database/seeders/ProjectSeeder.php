<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_id = Type::all()->pluck('id')->toArray();
        $type_id[] = null;

        for ($i = 0; $i < 5; $i++) {
            $project = new Project;
            $project->type_id = $faker->randomElement($type_id);
            $project->title = $faker->name();
            $project->description = $faker->paragraph(1);
            $project->save();
        }
    }
}
