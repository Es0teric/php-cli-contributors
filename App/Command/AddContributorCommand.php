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
		$this->helper = new Helpers;

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	public function handle( $input ) {

		$params = $this->helper->parseCliInput( $input );
		var_dump( $params );
		
	}

}