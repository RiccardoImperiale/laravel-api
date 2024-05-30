<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $projects = [
            [
                'type_id' => 2,
                'title' => 'iPhone 15 Website',
                'slug' => 'iPhone-15-Website',
                'description' => 'lorem description project 1 ipsum sum pronobis opus cementitio',
                'image' => null,
                'live_link' => 'https://iphone15webclone.netlify.app/',
                'code_link' => 'https://github.com/RiccardoImperiale/iPhone-website-clone',
            ],

        ];

        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->type_id = $project['type_id'];
            $newProject->title = $project['title'];
            $newProject->slug = $project['slug'];
            $newProject->description = $project['description'];
            $newProject->image = $project['image'];
            $newProject->live_link = $project['live_link'];
            $newProject->code_link = $project['code_link'];
            $newProject->save();
        }

        // for ($i = 0; $i < 10; $i++) {
        //     $project = new Project();
        //     $project->title = $faker->words(4, true);
        //     $project->slug = Str::of($project->title)->slug('-');
        //     $project->description = $faker->text(400);
        //     $project->image = $faker->imageUrl(600, 300, 'projects', true, $project->title, true, 'jpg');
        //     $project->save();
        // }
    }
}
