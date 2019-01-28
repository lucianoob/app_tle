<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id', 'description', 'date', 'time', 'price', 'tags'
    ];
}
