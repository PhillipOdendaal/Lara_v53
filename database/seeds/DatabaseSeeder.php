<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //factory(App\User::class, 1)->create();
        //factory(App\Task::class, 1)->create();
        
        $int = mt_rand(1262055681,1262055681);
        $randomInt = rand (0,10);
        $randomStr = str_random(100);
        $randomFloat = rand(0, 10) / 10;
        $randomDate = date("Y-m-d",$int);
        $randomBool = (bool)rand(0,1);
        
        DB::table('Tasks')->insert([
            'pk_id' => $randomInt,
            'title' => 'Task title',
            'due_date' => $randomDate,
            'estimated_hours' => $randomFloat,
            'project' => $randomInt,
            //'project_data' => 'json snapshot',
        ]);
        
        DB::table('Projects')->insert([
            'pk_id' => $randomInt,
            'description' => 'Project description',
            'start_date' => $randomDate,
            'end_date' => null,
            'is_billable' => $randomBool,
            'is_active' => $randomBool,
            //'task_set' => 'json snapshot',
        ]);
        
        //$this->call(UsersTableSeeder::class);
        //$this->call(TasksTableSeeder::class);
        //$this->call(ProjectsTableSeeder::class);

    }
}
