<?php

use App\Helpers;
use App\Storage;
use App\Command\ShowAllContributorsCommand as ShowAllContributors;

class ShowAllContributorsTest extends PHPUnit_Framework_TestCase 
{
	
	public function __construct() {

		$this->storage = new Storage();
		$this->helper = new Helpers();
		$this->showAllContributors = new ShowAllContributors();

	}

	public function sendInputForAlphaSort() {

		$input = "show_all sort_alpha";
		return $input;

	}

	public function sendInputForLocationSort() {

		$input = "show_all sort_location";
		return $input;

	}

	/**
	 * Asserts that arrays were properly sorted
	 * 
	 * @return void
	 */
	public function test_input_sort_alpha() {

		$input = explode( " ", $this->sendInputForAlphaSort() );

		$contributorsNotSorted = $this->storage->listContributors( true );
		$contributorsSorted = $this->showAllContributors->run( $input, true );
		
		$this->assertFalse( json_encode( $contributorsNotSorted ) === json_encode( $contributorsSorted ) ); 

	}


	/**
	 * Asserts that arrays were properly sorted by location
	 * 
	 * @return void
	 */
	public function test_input_sort_location() {

		$input = explode( " ", $this->sendInputForLocationSort() );

		$contributorsNotSorted = $this->storage->listContributors( true );
		$contributorsSorted = $this->showAllContributors->run( $input, true );
		
		$this->assertFalse( json_encode( $contributorsNotSorted ) === json_encode( $contributorsSorted ) ); 

	}

}