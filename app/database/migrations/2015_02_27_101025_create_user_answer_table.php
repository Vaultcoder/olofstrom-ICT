<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('user_answer', function(Blueprint $table) 
            {
                $table->increments('id');
                $table->integer('m_id');
                $table->integer('c_id');
                $table->integer('q_id');
                $table->integer('a_id');
                $table->integer('user_id');
                $table->integer('correct');
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_answer');
	}

}
