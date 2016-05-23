<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            // $now = date('Y-m-d H:i:s');
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'Lärande',
            //         'description' => 'Du lär dig om lärande',
            //         'decal' => '1.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'Skapande',
            //         'description' => 'Du lär dig om skapande',
            //         'decal' => '2.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'PHP',
            //         'description' => 'Du lär dig om PHP',
            //         'decal' => '3.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'Python',
            //         'description' => 'Du lär dig om python',
            //         'decal' => '4.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'Ruby',
            //         'description' => 'Du lär dig om Ruby',
            //         'decal' => '5.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('modules')->insert(
            //     array(
            //         'name' => 'c++',
            //         'description' => 'Du lär dig om c++',
            //         'decal' => '6.jpg',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
	}

	public function down()
	{
		DB::table('users')->delete();
	}

}
