<?php

use App\Helpers;
use App\Storage;
use App\Command\AssignContributorCommand as AssignContributor;

class AssignContributorTest extends PHPUnit_Framework_TestCase 
{
	
	public function __construct() {

		$this->storage = new Storage();
		$this->helper = new Helpers();
		$this->assignContributor = new AssignContributor();

	}

	public function sendInputAssignContributor() {
		$input = 'assign_contributor "Illa J"';
		return $input;
	}

	public function test_assign_contributor() {

		$this->assignContributor->run( $this->sendInputAssignContributor() );

	}

}
