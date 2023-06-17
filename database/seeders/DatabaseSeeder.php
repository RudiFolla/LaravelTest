<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Customer;
use App\Enum\UserRoleEnum;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Project Manager 1',
            'email' => 'project.manager@example.com',
            'role' => 'ProjectManager',
            'password'=>'projectmanager'
        ]);
        User::create([
            'id' => 2,
            'name' => 'Developer 1',
            'email' => 'developer@example.com',
            'role' => 'Developer',
            'password'=>'projectmanager'
        ]);
        Customer::create([
            'id' => 1,
            'name' => 'Customer'
        ]);
        Project::create([
            'id' => 1,
            'customer_id' => 1,
            'pm_id' => 1,
            'name' => 'First Project'
        ]);
        Task::create([
            'id' => 1,
            'title' => 'First Task',
            'project_id'=>1
        ]);
        $this->call([
            RoleSeeder::class
        ]);
    }
}
