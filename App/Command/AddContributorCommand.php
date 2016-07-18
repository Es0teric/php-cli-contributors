<?php namespace App\Command;

use App\Helpers;
use App\Storage;
use App\Output;

class AddContributorCommand
{

	public $name = "Add Contributor";
	public $description = "add a new contributor, status optional ('assigned' or 'unassigned', defaults to 'unassigned').";
	public $command = "add_contributor";
	public $params = false;

	public function __construct() {

		//instantiate helpers class
		$this->helper = new Helpers();

		//init storage
		$this->storage = new Storage();

		//init output
		$this->output = new Output();

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	/**
	 * Handles adding contributor data
	 * 
	 * @param  string $input user input from STDIN
	 * 
	 * @return void
	 */
	protected function handle( $input ) {

		//first, lets parse output from STDIN
		$params = $this->parse( $input );

		if( $params['name'] !== 'add_contributor' && $params['location'] !== 'Not Provided' ) {

			//then lets assign vars to contain each individual var from parsed input
			if( array_key_exists( 'name', $params ) )
				$name = $params['name'];
			else
				$name = false;

			//defaults to not provided if its not specified
			if( array_key_exists( 'location', $params ) )
				$location = $params['location'];
			else
				$location = 'Not provided';

			//if status is not created, defaults to unassigned
			if( array_key_exists( 'status', $params ) )
				$status = $params['status'];
			else
				$status = 'unassigned';

			
			//lets check contributor data for duplicates before storing
			$this->storage->storeContributor( $name, $location, $status );

		} else {

			$this->output->error( '-- A name and location is required' );

		}

	}

	public function parse( $input ) {

		return $this->helper->parseForStorage( $input );

	}

}