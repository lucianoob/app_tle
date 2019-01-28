<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    public function list() {
        return view('expenses');
    }

    public function edit(Request $request){
        return view('expenses');
    }
}
