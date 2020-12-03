<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        User::all()->each(function ($user) use ($roles) {
            /*if ($user->id == 1) {
                $user->roles()->attach(['role_id'=>1, 'user_id' => 1]);
            } else {
                $user->roles()->attach($roles->random(1)->pluck('id'));
            }*/
            $user->roles()->attach(
                $roles->random(1)->pluck('id')
            );
        });
    }
}
