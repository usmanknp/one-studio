<?php

namespace Database\Seeders;

use Bouncer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          $collection_permission = collect([

            // Dashboard Permission
            ['name' => 'view_dashboard', 'title' => 'View dashboard'],
          
            // Classes Permission
            ['name' => 'view_class', 'title' => 'View class'],
            ['name' => 'create_class', 'title' => 'Create class'],
            ['name' => 'edit_class', 'title' => 'Edit class'],
            ['name' => 'delete_class', 'title' => 'Delete class'],

            // Offers Permission
            ['name' => 'view_offer', 'title' => 'View offer'],
            ['name' => 'create_offer', 'title' => 'Create offer'],
            ['name' => 'edit_offer', 'title' => 'Edit offer'],
            ['name' => 'delete_offer', 'title' => 'Delete offer'],

             // Instructors Permission
             ['name' => 'view_instructor', 'title' => 'View instructor'],
             ['name' => 'create_instructor', 'title' => 'Create instructor'],
             ['name' => 'edit_instructor', 'title' => 'Edit instructor'],
             ['name' => 'delete_instructor', 'title' => 'Delete instructor'],

             // Users Permission
             ['name' => 'view_user', 'title' => 'View user'],
             ['name' => 'create_user', 'title' => 'Create user'],
             ['name' => 'edit_user', 'title' => 'Edit user'],
             ['name' => 'delete_user', 'title' => 'Delete user']


        ]);

        foreach ($collection_permission as $key => $permission)
        {
            Bouncer::ability()->updateOrCreate(
                [
                    'name' => $permission['name']
                ],
                [
                    'title' => $permission['title'],
                ],
            );
        }

        $users = User::whereHas('roles', function($query) {
            $query->where('roles.name', '=', 'admin');
        })->get();

        foreach($users as $key => $user)
        {
            $user->assign('admin');
            foreach ($collection_permission as $key => $permission)
            {
                $user->disallow($permission['name']);
                $user->allow($permission['name']);
            }
        }

        echo "Done";
    }
}
