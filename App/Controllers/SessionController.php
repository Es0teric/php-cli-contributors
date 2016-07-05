<?php namespace App\Controllers;

use App\Storage;
use App\Output\Output;

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

    	$this->storage->removeDataFile();

    }
}