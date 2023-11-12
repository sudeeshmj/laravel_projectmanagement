<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
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
                'project_id' => 1,
                'name' => 'Database Design',
                'status'=>1
            ],
            [   'project_id' => 1,
                'name' => 'Coding',
                'status'=>1
            ],
            [   'project_id' => 1,
                'name' => 'Testing',
                'status'=>0
            ],
            [   'project_id' => 1,
                'name' => 'Live Integration',
                'status'=>0
            ],
            [
                'project_id' => 2,
                'name' => 'Business Requirement Analysis',
                'status'=>1
            ],
            [
                'project_id' => 2,
                'name' => 'Database Design',
                'status'=>1
            ],
            [   'project_id' => 2,
                'name' => 'Coding',
                'status'=>1
            ],
            [   'project_id' => 2,
                'name' => 'Testing',
                'status'=>0
            ],
            [   'project_id' => 2,
                'name' => 'Live Integration',
                'status'=>0
            ],
            [   'project_id' => 2,
                'name' => 'Technical Documentation',
                'status'=>0
             ],
            [   'project_id' => 3,
            'name' => 'Upgradation Analysis',
            'status'=>1
            ],
            [   'project_id' => 3,
            'name' => 'Program Modification',
            'status'=>1
            ],
            [   'project_id' => 3,
            'name' => 'Technical Documentation',
            'status'=>0
            ],
        ];
        Task::insert($data);
    }
}
