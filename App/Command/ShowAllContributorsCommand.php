<?php namespace App\Command;

use App\Helpers;
use App\Storage;

class ShowAllContributorsCommand {

	public $name = "Show All Contributors";
	public $description = "show all extant contributors sorted by optional criteria.";
	public $command = "show_all";
	public $params = [ "sort_alpha", "sort_location", "sort_status" ];

	public function __construct() {

		$this->helpers = new Helpers();
		$this->storage = new Storage();

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	public function handle( $input ) {

		var_dump( $this->storage->readDataFile() );

	}

}