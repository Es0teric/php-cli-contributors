<?php

use App\Helpers;
use App\Storage;
use App\Command\DeleteContributorCommand as DeleteContributor;
use App\Command\ShowAllContributorsCommand as ShowAllContributors;

class DeleteContributorTest extends PHPUnit_Framework_TestCase 
{

	public function __construct() {

		$this->helper = new Helpers();
		$this->storage = new Storage();
		$this->deleteContributor = new DeleteContributor();
		$this->showAllContributors = new ShowAllContributors();

	}

	public function test_del_contributor() {

		$allContributors = $this->storage->listContributors(true);
		$contributor = $this->deleteContributor->run( 'del_contributor "Kay Bailey"' );
		var_dump( array_diff( $allContributors, $contributor ) );

	}

}