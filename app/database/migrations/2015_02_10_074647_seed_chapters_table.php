<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedChaptersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            // $now = date('Y-m-d H:i:s');
            
            // DB::table('chapters')->insert(
            //     array(
            //         'm_id' => 1,
            //         'title' => 'Test1',
            //         'chapternumber' => 4,
            //         'body' => 'Jag snusar',
            //         'isQuestions' => 1,
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('chapters')->insert(
            //     array(
            //         'm_id' => 1,
            //         'title' => 'Test2',
            //         'chapternumber' => 3,
            //         'body' => 'Jag röker',
            //         'isQuestions' => 0,
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('chapters')->insert(
            //     array(
            //         'm_id' => 1,
            //         'title' => 'Test3',
            //         'chapternumber' => 1,
            //         'body' => 'Jag kollar',
            //         'isQuestions' => 0,
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('chapters')->insert(
            //     array(
            //         'm_id' => 1,
            //         'title' => 'Test4',
            //         'chapternumber' => 2,
            //         'body' => 'Jag blundar',
            //         'isQuestions' => 0,
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('chapters')->delete();
	}

}
