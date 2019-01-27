<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  protected $fillable = [
      'user_id', 'description', 'date', 'price', 'tags'
  ];
}
