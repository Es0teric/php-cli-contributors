<?php

require_once( dirname( __DIR__ ) . '/Output.php' );
require_once( dirname( __DIR__ ) . '/Storage.php' );

class SessionController 
{

	public function __construct() {
		
		//lets init the storage class so we can clear data on this session
		$this->storage = new Storage();

		//lets init the output class to show messages in the terminal
		$this->output = new Output();

	}

	/**
	 * Destroys current CLI session
	 * 
	 * @return void
	 */
    public function destroy() {

    	$this->output->info('-- Goodbye!');
    	session_destroy();
    	exit();

    }
}