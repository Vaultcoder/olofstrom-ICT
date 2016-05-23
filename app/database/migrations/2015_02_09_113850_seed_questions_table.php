<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            // $now = date('Y-m-d H:i:s');
            
            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Går från hus till hus men kommer aldring in?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
            
            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Har hatt och fot men saknar huvud och sko?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));

            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Heter det en rak kurva eller ett rak kurva?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));

            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Jag fyllde 12år igår, nästa år fyller jag 14år. När fyller jag år?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));

            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Ju fler du tar desto fler lämnar du bakom dig?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));

            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'Ju mer man fyller mig desto lättare blir jag, Vad kan det vara?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));

            // DB::table('questions')->insert(
            //     array(
            //         'm_id' => 1,
            //         'c_id' => 1,
            //         'body' => 'När säger amerikanerna god natt?',
            //         'created_at' => $now,
            //         'updated_at' => $now
            // ));
	}

	public function down()
	{
		DB::table('questions')->delete();
	}

}
