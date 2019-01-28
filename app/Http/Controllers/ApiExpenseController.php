<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiExpenseController extends Controller
{
    public function index()
    {
        $expenses = DB::table('expenses')
            ->select('expenses.id', 'users.name as user', 'expenses.description', 'expenses.date', 'expenses.time', 'expenses.price', 'expenses.tags')
            ->join('users', 'users.id', '=', 'expenses.user_id')
            ->get();
        return json_encode($expenses, false);
    }

    public function index_user($id)
    {
        $expenses = DB::table('expenses')
            ->select('expenses.id', 'expenses.description', 'expenses.date', 'expenses.time', 'expenses.price', 'expenses.tags')
            ->join('users', 'users.id', '=', 'expenses.user_id')
            ->where('user_id', $id)
            ->get();
        return $expenses;
    }

    public function show(Expense $expense)
    {
        $user = DB::table('users')
            ->where('id', $expense["user_id"])
            ->get()->first();
        $json = json_decode($expense, TRUE);
        $json['user'] = $user->name;
        $json = json_encode($json);
        return $json;
    }

    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->fill($request->all());
        $expense->save();
        return $expense;
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $expense->fill($request->all());
        $expense->save();

        return response()->json($expense);
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);

        if (!$expense) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        $expense->delete();
    }
}
