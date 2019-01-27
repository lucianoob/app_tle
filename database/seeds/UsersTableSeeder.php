<?php

use App\User;
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
        $user1 = DB::table('users')->where('email', 'User@gmail.com')->exists();
        if(!$user1)
        {
            User::create([
                'id'    => 1,
                'name'    => 'User Test 1',
                'email'    => 'User@gmail.com',
                'password'   =>  Hash::make('User@1'),
                'remember_token' =>  str_random(10),
            ]);
        }
        $user2 = DB::table('users')->where('email', 'user2@gmail.com')->exists();
        if(!$user2)
        {
            User::create([
                'id'    => 2,
                'name'    => 'User Test 2',
                'email'    => 'user2@gmail.com',
                'password'   =>  Hash::make('User@2'),
                'remember_token' =>  str_random(10),
            ]);
        }
    }
}
