<?php

namespace Tests\Unit;

use App\Expense;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ExpenseTest extends TestCase
{
    public function testExpenseIndex()
    {
        $this->json('GET', '/api/expenses', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testExpenseIndexUser()
    {
        $this->json('GET', '/api/expenses/user/1', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testExpenseShow()
    {
        $this->json('GET', '/api/expenses/1', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    public function testExpenseStore()
    {

        $response = $this->json('POST', '/api/expenses/',
            [
                'user_id'    => 1,
                'description'    => 'Test01 Expenses.',
                'date'    => date("Y-m-d"),
                'time'    => date("H:i"),
                'price'   =>  100,
                'tags' =>  'test01',
            ])
            ->assertResponseStatus('201')
            ->seeJson([
                'user_id' => 1,
            ]);
    }

    public function testExpenseUpdate()
    {
        $last_expense = DB::table('expenses')->where('user_id', '1')->orderBy('id', 'DESC')->first();

        $this->json('PUT', '/api/expenses/'.$last_expense->id,
            [
                'description'    => 'Test02 Expenses.',
                'date'    => date("Y-m-d"),
                'time'    => date("H:i"),
                'price'   =>  200,
                'tags' =>  'test02',
            ])
            ->assertResponseOk();
    }

    public function testExpenseDelete()
    {
        $last_expense = DB::table('expenses')->where('user_id', '1')->orderBy('id', 'DESC')->first();

        $this->json('DELETE', '/api/expenses/'.$last_expense->id)
            ->assertResponseOk();
    }
}
