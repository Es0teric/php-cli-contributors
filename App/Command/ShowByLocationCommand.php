<?php namespace App\Command;

use App\Storage;
use App\Helpers;
use App\Output;

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

	protected function handle( $input ) {

		$contributors = $this->storage->listContributors(true);
		$parsed = $this->parse( $input );

		if( $parsed['location'] !== 'show_by_location' ) {

			//lets check if contributors array is empty
			if( !empty( $contributors ) ) {

				$foundLocations = [];

				//lets loop through that list of contributors to get matching results of locations
				foreach( $contributors as $key => $contributor ) {

					if( $contributor['location'] == $parsed['location'] ) {

						//lets store the locations that were found in this array in case we want to return it
						$foundLocations[] = $contributor;

						//output for found contributors matching the location
						$this->output->info( '-- ' . $contributor['name'] . ' (' . $contributor['status'] . ')' );
					
					}

				}

				//nothing was found
				if( empty( $foundLocations ) )
					$this->output->error( '-- There are no contributors with the location of ' . $parsed['location'] );

			}

		} else {

			$this->output->error( "-- A location name is required.\r\n" );

		}

	}

	/**
	 * Parses input from STDIN to a reable array
	 * 
	 * @param  array $input  initial input array from STDIN
	 * @return array         array containing parsed location
	 */
	public function parse( $input ) {
		
		$item = explode( '", "', str_replace('show_by_location "','', trim( $input,'"' ) ) );
		
		if( array_key_exists( '0', $item ) )
			return [ 'location' => $item[0] ];
	}
}