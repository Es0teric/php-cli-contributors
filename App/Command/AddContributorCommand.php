<?php namespace App\Command;

use App\Helpers;
use App\Storage;

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
	public function handle( $input ) {

		//first, lets parse output from STDIN
		$params = $this->helper->parseCliInput( $input );

		//then lets assign vars to contain each individual var from parsed input
		if( array_key_exists( 'name', $params ) )
			$name = $params['name'];
		else
			$name = false;

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

	}

}