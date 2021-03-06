<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('rewards', function(Blueprint $table) 
            {
                $table->increments('id');
                $table->integer('m_id');
                $table->string('user_id');
                $table->string('decal');
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
            Schema::drop('rewards');
	}

}
