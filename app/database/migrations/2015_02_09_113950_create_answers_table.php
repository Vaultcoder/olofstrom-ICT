<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('answers', function(Blueprint $table) 
            {
                $table->increments('id');
                $table->integer('m_id');
                $table->integer('c_id');
                $table->integer('q_id');
                $table->integer('correct');
                $table->string('body');
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
		Schema::drop('answers');
	}

}
