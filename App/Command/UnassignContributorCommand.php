<?php

require_once( dirname( __DIR__ ) . '/Helpers.php' );
require_once( dirname( __DIR__ ) . '/Storage.php' );
require_once( dirname( __DIR__ ) . '/Output.php' );


class UnassignContributorCommand 
{

	public $name = "Mark contributor as unassigned";
	public $description = "Change existing contributor data to unassigned if assigned";
	public $command = "unassign_contributor";
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

		$parsedInput = $this->parse( $input );

		$contributors = $this->storage->listContributors( true );

		if( $parsedInput['name'] !== 'unassign_contributor' ) {

			if( !empty( $contributors ) ) {

				$foundContributor = [];

				foreach( $contributors as $contributor ) {

					if( $contributor['name'] == $parsedInput['name'] ) {

						$foundContributor[] = $contributor;
						$this->storage->unassignContributor( $parsedInput['name'] );

					}

				}

				if( empty( $foundContributor ) )
					$this->output->error( '-- There is no contributor with this name to unassign.' );

			}
		
		} else {

			$this->output->error( "-- A contributor name is required. \r\n" );

		}

	}

	public function parse( $input ) {

		$item = explode( '", "', str_replace('unassign_contributor "','', trim( $input,'"' ) ) );
		
		if( array_key_exists( '0', $item ) )
			return [ 'name' => $item[0] ];

	}

}