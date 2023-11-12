<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Ecommerce Web Application',
                'status'=>1
            ],
            [
                'name' => 'Ecommerce Mobile Application',
                'status'=>1
            ],
            [
                'name' => 'PHP Upgradation',
                'status'=>1
            ],
            [
                'name' => 'Zoom Clone',
                'status'=>0
            ],
        ];
        Project::insert($data);
    }
}
