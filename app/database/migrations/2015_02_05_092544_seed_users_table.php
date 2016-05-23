<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            $now = date('Y-m-d H:i:s');

            DB::table('users')->insert(
                array(
                    'email' => 'eric.christensen94@gmail.com',
                    'fname' => 'Eric',
                    'lname' => 'Christensen',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));
            
            DB::table('users')->insert(
                array(
                    'email' => 'alexander.thuresson@gmail.com',
                    'fname' => 'Alexander',
                    'lname' => 'Thuresson',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));

            DB::table('users')->insert(
                array(
                    'email' => 'leomagnusson90@gmail.com',
                    'fname' => 'Leo',
                    'lname' => 'Magnusson',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));

            DB::table('users')->insert(
                array(
                    'email' => 'albin.hammarstrom95@gmail.com',
                    'fname' => 'Albin',
                    'lname' => 'Hammarström',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));
            
            DB::table('users')->insert(
                array(
                    'email' => 'linda.wannero@gmail.com',
                    'fname' => 'Linda',
                    'lname' => 'Wannerö',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));

            DB::table('users')->insert(
                array(
                    'email' => 'oliverhm94@gmail.com',
                    'fname' => 'Oliver',
                    'lname' => 'Möller',
                    'isAdmin' => 1,
                    'created_at' => $now,
                    'updated_at' => $now
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            DB::table('users')->delete();
	}

}
