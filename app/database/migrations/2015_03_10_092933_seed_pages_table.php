<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            $now = date('Y-m-d H:i:s');
            
            DB::table('pages')->insert(
                array(
                    'title' => 'Om Applikationen',
                    'body' => 'Denna applikationen är till för att hjälpa lärare att lära sig med om hur teknik kan komma till 
                    hans inom skolan och lärande. Man får tillfälle att läsa in sig på IKT och testa sig själv med test. Men kan 
                    även göra pedagogiska uppdrag senare.',
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
		DB::table('pages')->delete();
	}

}
