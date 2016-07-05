<?php

use App\Storage;
use App\Helpers;
use App\Command\ShowByLocationCommand as ShowByLocation;

class ShowByLocationTest extends PHPUnit_Framework_TestCase
{
	public function __construct() {

		$this->showByLocation = new ShowByLocation();

	}


	public function test_show_by_location() {

		$input = 'show_by_location "North Dakota"';
		$contributorsArray = $this->showByLocation->run( $input );

		//$this->assertTrue( is_array( $contributorsArray ) );

	}

}