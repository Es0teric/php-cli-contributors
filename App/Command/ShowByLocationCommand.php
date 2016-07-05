<?php namespace App\Command;

use App\Storage;
use App\Helpers;
use App\Output\Output;

class ShowByLocationCommand 
{

	public $name = "Show by Location";
	public $description = "Show all existant contributors by location";
	public $command = "show_by_location";
	public $params = false;

	public function __construct() {

		$this->storage = new Storage();
		$this->helper = new Helpers();
		$this->output = new Output();

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	public function handle( $input ) {

		$contributors = $this->storage->listContributors(true);
		$parsed = $this->parse( $input );

		if( !empty( $contributors ) ) {

			$foundLocations = [];

			foreach( $contributors as $key => $contributor ) {

				if( $contributor['location'] == $parsed['location'] ) {

					$foundLocations[] = $contributor;
					$this->output->info( '-- ' . $contributor['name'] . ' (' . $contributor['status'] . ')' );
				
				}

			}

		} else {

			$this->output->error( '-- There are no contributors to display by location' );

		}

	}


	public function parse( $input ) {
		
		$item = explode( '", "', str_replace('show_by_location "','', trim( $input,'"' ) ) );
		
		if( array_key_exists( '0', $item ) )
			return [ 'location' => $item[0] ];
	}
}