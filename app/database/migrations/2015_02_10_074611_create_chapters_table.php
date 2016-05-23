<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('chapters', function(Blueprint $table) 
            {
                $table->increments('id');
                $table->integer('m_id');
                $table->string('title');
                $table->integer('chapternumber');
                $table->text('body');
                $table->integer('isQuestions');
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
		Schema::drop('chapters');
	}

}
