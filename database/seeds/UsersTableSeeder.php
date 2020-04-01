<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'      =>  'admin',
            'name'      =>  'admin',
            'email'     =>  'admin@solashi.com',
            'password'  =>  'solashi'
        ]);

        $user = User::first();
        $user->assignRole('super_admin');
    }
}
