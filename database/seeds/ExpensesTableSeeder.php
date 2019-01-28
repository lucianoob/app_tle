<?php

use App\Expense;
use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user1 = DB::table('expenses')->where('user_id', '1')->exists();
      if(!$user1)
      {
          Expense::create([
              'id'    => 1,
              'user_id'    => 1,
              'description'    => 'Expenses with food at work.',
              'date'    => date("Y-m-d"),
              'time'    => date("H:i"),
              'price'   =>  220.34,
              'tags' =>  'work food',
          ]);
      }
      $user2 = DB::table('expenses')->where('user_id', '2')->exists();
      if(!$user2)
      {
          Expense::create([
              'id'    => 2,
              'user_id'    => 2,
              'description'    => 'Fuel costs.',
              'date'    => date("Y-m-d"),
              'time'    => date("H:i"),
              'price'   => 510.25,
              'tags' =>  'car fuel',
          ]);
      }
    }
}
