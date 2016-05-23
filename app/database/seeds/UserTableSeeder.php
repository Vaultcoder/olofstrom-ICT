<?php
 
class UserTableSeeder extends Seeder {
 
  public function run()
  {
      User::create(array(
        'email' => 'psyduck.gul@gmail.com',
        'fname' => 'Eric',
        'lname'  => 'Christensen'
      ));
	  
      User::create(array(
        'email' => 'leomagnusson90@gmail.com',
        'fname' => 'Leo',
        'lname'  => 'Magnusson'
      ));

         User::create(array(
        'email' => 'Alexander.Thuresson@gmail.com',
        'fname' => 'Alexander',
        'lname'  => 'Thuresson'
      ));
  }

}