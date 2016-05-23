<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Google' => array(
            'client_id'     => '183143884727-iagidt78pi7jp5d6rdgs46ksn6ktddrg.apps.googleusercontent.com',
            'client_secret' => 'CE4-hoKpZ9EpXJuJ-ToIYsmi',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),	

	)

);