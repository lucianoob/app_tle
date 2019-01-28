<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('expenses')) {
          Schema::create('expenses', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('user_id')->unsigned();
              $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
              $table->string('description');
              $table->date('date');
              $table->string('time');
              $table->decimal('price', 6, 2);
              $table->string('tags');
              $table->timestamps();
          });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
