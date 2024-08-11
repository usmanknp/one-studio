<?php

namespace Database\Seeders;

use Bouncer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class SystemConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin role
        $roles = [
            [
                'name' => 'admin',
                'title' => 'Administrator',
            ],
            [
                'name' => 'technician',
                'title' => 'Technician',
            ],
            [
                'name' => 'supervisor',
                'title' => 'Supervisor',
            ],
        
        ];
        
        foreach ($roles as $roleData) {
            Bouncer::role()->firstOrCreate($roleData);
        }

          // Create User (Admin)
          $user = new User;
          $user->uuid =Str::uuid();
          $user->name = "Admin";
          $user->email = "admin@admin.com";
          $user->locale = "en";
          $user->password = bcrypt('password');
          $user->status = 1;
          $user->save();
  
          //Assign Role
          $user->assign('admin');
  
          echo "Done";
    }
}
