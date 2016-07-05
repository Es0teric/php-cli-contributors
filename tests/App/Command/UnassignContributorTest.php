<?php

use App\Helpers;
use App\Storage;
use App\Command\UnassignContributorCommand as UnassignContributor;

class UnassignContributorTest extends PHPUnit_Framework_TestCase 
{
	
	public function __construct() {

		$this->storage = new Storage();
		$this->helper = new Helpers();
		$this->unassignContributor = new UnassignContributor();

	}

	public function sendInputUnassignContributor() {
		$input = 'unassign_contributor "Illa J"';
		return $input;
	}

	public function test_unassign_contributor() {

		$this->unassignContributor->run( $this->sendInputUnassignContributor() );

	}

}
