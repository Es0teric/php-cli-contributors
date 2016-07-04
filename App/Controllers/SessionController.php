<?php namespace App\Controllers;

use App\Storage;

class SessionController 
{

	public function __construct() {
		
		//lets init the storage class so we can clear data on this session
		$this->storage = new Storage();

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