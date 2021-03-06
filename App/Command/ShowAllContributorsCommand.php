<?php

require_once( dirname( __DIR__ ) . '/Helpers.php' );
require_once( dirname( __DIR__ ) . '/Storage.php' );
require_once( dirname( __DIR__ ) . '/Output.php' );

class ShowAllContributorsCommand 
{

	public $name = "Show All Contributors";
	public $description = "show all extant contributors sorted by optional criteria.";
	public $command = "show_all";
	public $params = [ "sort_alpha", "sort_location", "sort_status" ];

	public function __construct() {

		$this->helper = new Helpers();
		$this->storage = new Storage();
		$this->output = new Output();

	}

	public function run( $input ) {
		$this->handle( $input );
	}

	/**
	 * Handles input from STDIN
	 * 
	 * @param  array   $input     	 user input from STDIN
	 * @param  boolean $sortCheck 	 if true, unit testing is running
	 * @return array   $contributors returns when unit test needs a list of arrays instead of terminal output
	 */
	protected function handle( $input, $sortCheck = false ) {
		
		//lets save the initial list of contributors
		$contributors = $this->storage->listContributors( true );

		//lets check if contributors array contains any data
		if( !empty( $contributors ) ) {

			//lets check if the user is not sending extra params for sorting
			if( count( $input ) == 1 ) {

				return $this->storage->listContributors();

			} else {

				//add switch/case depending on the array key that explode has
				switch( $input[1] ) {

					//alphabetical sorting
					case "sort_alpha" :

						//sort the contributors array
						$alphaSort = asort( $contributors );

						//if sort is susccessful, lets either check if we are unit testing or do some output
						if( $alphaSort === true ) {

							//if this is true, then unit testing is occuring
							if( $sortCheck === false ) {

								//outputs user info into terminal
								foreach( $contributors as $item ) {

									$this->output->info( '-- ' . $item['name'] . ' (' . $item['location'] . ', ' . $item['status'] . ')' );

								}

							} else {

								//returns list of array of contributors
								return $contributors;

							}

						}

					break;

					case "sort_location":

						$locationSort = usort( $contributors, function( $a, $b ) {
							 return strcmp( $a["location"], $b["location"] );
						});

						if( $locationSort == true ) {

							if( $sortCheck == false ) {

								foreach( $contributors as $item ) {
									$this->output->info( '-- ' . $item['name'] . ' (' . $item['location'] . ', ' . $item['status'] . ')' );
								}

							} else {

								//returns list of array of contributors
								return $contributors;

							}

						}
					
					break;

				}

			}

		} else {

			$this->output->error( "-- There are currently no contributors to show.\r\n" );

		}

	}

}