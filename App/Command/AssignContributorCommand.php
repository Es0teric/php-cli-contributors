<?php

require_once( dirname( __DIR__ ) . '/Helpers.php' );
require_once( dirname( __DIR__ ) . '/Storage.php' );
require_once( dirname( __DIR__ ) . '/Output.php' );

class AssignContributorCommand 
{

	public $name = "Mark contributor as assigned";
	public $description = "Change existing contributor data to assigned if not assigned";
	public $command = "assign_contributor";
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

		if( $parsedInput['name'] !== 'assign_contributor' ) {

			$contributors = $this->storage->listContributors( true );

			if( !empty( $contributors ) ) {

				$foundContributor = [];

				foreach( $contributors as $contributor ) {

					if( $contributor['name'] == $parsedInput['name'] ) {

						$foundContributor[] = $contributor;
						$this->storage->assignContributor( $parsedInput['name'] );

					}

				}

				if( empty( $foundContributor ) )
					$this->output->error( '-- There is no contributor with this name to assign.' );

			}

		} else {

			$this->output->error("-- A name is required to assign a contributor. \r\n");

		}

	}

	public function parse( $input ) {

		$item = explode( '", "', str_replace('assign_contributor "','', trim( $input,'"' ) ) );
		
		if( array_key_exists( '0', $item ) )
			return [ 'name' => $item[0] ];

	}

}