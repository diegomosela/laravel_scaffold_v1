<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $role               = new \App\Models\Role;
        $role->id           = 1;
        $role->name         = 'Aluno';
        $role->created_at   = date('Y-m-d H:i:s');
        $role->save();

        $role               = new \App\Models\Role;
        $role->id           = 2;
        $role->name         = 'Professor';
        $role->created_at   = date('Y-m-d H:i:s');
        $role->save();
        
    	$user 				= new \App\Models\User;
    	$user->public_key 	= 'c4ca4238a0b923820dcc509a6f75849b';
    	$user->name 		= 'Professor Admin';
    	$user->username 	= 'admin';
    	$user->email 		= 'admin@admin.com';
    	$user->status 		= 1;
    	$user->role_id 		= 2;
    	$user->password 	= Hash::make( 'admin123' );
    	$user->created_at 	= date('Y-m-d H:i:s');
    	$user->save();

    }
}