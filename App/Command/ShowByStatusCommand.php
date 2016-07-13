<?php namespace App\Command;

use App\Storage;
use App\Helpers;
use App\Output;

class ShowByStatusCommand 
{

	public $name = "Show by Status";
	public $description = "Show all existant contributors by status";
	public $command = "show_by_status";
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

		if( !empty( $contributors ) ) {

			$foundStatuses = [];

			//loop through contributors 
			foreach( $contributors as $key => $contributor ) {

				if( $contributor['status'] == $parsed['status'] ) {

					//store matching statuses from input
					$foundStatuses[] = $contributor;
					$this->output->info( '-- ' . $contributor['name'] . ' (' . $contributor['location'] . ')' );
				
				}

			}

			//output error if the status doesnt exist
			if( empty( $foundStatuses ) )
				$this->output->error( '-- There are no contributors with the status of ' . $parsed['status'] );

		} else {

			$this->output->error( '-- There are no contributors to display by status' );

		}

	}

	/**
	 * Parses input from STDIN to a reable array
	 * 
	 * @param  array $input  initial input array from STDIN
	 * @return array         array containing parsed location
	 */
	public function parse( $input ) {
		
		$item = explode( '", "', str_replace('show_by_status "','', trim( $input,'"' ) ) );
		
		if( array_key_exists( '0', $item ) )
			return [ 'status' => $item[0] ];
	}

}