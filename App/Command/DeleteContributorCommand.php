<?php namespace App\Command;

use App\Storage;
use App\Helpers;
use App\Output\Output;

class DeleteContributorCommand 
{

	public $name = "Delete Contributor";
	public $description = "Removes a contributor by name.";
	public $command = "del_contributor";
	public $params = false;

	public function __construct() {

		$this->helper = new Helpers();
		$this->storage = new Storage();
		$this->output = new Output();

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	/**
	 * Handles input from STDIN
	 * 
	 * @param  array   $input     	 user input from STDIN
	 * @param  boolean $sortCheck 	 if true, unit testing is running
	 * @return array   $contributors returns when unit test needs a list of arrays instead of terminal output
	 */
	public function handle( $input ) {

		//lets parse the input first
		$parsedInput = $this->parse( $input );

		//now we grab the array list version of the contributors list
		$contributors = $this->storage->listContributors( true );

		//if its empty, we proceed.. if not, we spit an error back to the terminal
		if( !empty( $contributors ) ) {

			$indexKey = '';

			foreach( $contributors as $key => $contributor ) {

				//we then grab the array key of the name that matches the input so we can unset it
				if( $contributor['name'] == $parsedInput['name'] )
					$indexKey = $key;

			}

			//and remove contributor in the storage class now processes it
			$this->storage->removeContributor( $indexKey );

		} else {

			$this->output->error( '-- Uh Oh! there are no contributors to remove!' );

		}

	}

	public function parse( $input ) {

		return $this->helper->parseForRemoval( $input );

	}

}