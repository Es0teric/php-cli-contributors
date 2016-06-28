<?php

use App\Helpers;

class OptionParserTest extends PHPUnit_Framework_TestCase {

	public function __construct() {

		//lets instantiate the helper class for CLI parsing
		$this->helper = new Helpers;

	}

	/**
	 * Handles input for single param with double quotes
	 * 
	 * @return string $input input to be typed by the command line
	 */
	public function sendInputAddContributorSingleOption() {

		$input = 'add_contributor --name="John Wall"';
		return $input;

	}

	/**
	 * Handles input for multiple params with double quotes
	 * @return string $input input to be typed on the command line
	 */
	public function sendInputAddContributorMultipleOptions() {
		$input = 'add_contributor --name="John Wall" --location="Seattle, Washington" --status="unassigned"';

		return $input;
	}

	/**
	 * Handles input for single param with single quotes
	 * 
	 * @return string $input input to be typed on the command line
	 */
	public function sendInputAddContributorSingleOptionSingleQuotes() {
		$input = "add_contributor --name='John Wall'";

		return $input;
	}

	/**
	 * Handles input for multiple param with single quotes
	 * 
	 * @return string $input input to be typed on the command line
	 */
	public function sendInputAddContributorMultipleOptionsSingleQuotes() {
		$input = "add_contributor --name='John Wall' --location='Seattle, Washington' --status='unassigned'";

		return $input;
	}

	public function test_single_option_gets_parsed() {
		
		$singleParaminput = $this->sendInputAddContributorSingleOption();
		return $this->assertArrayHasKey('name', $this->helper->parseCliInput( $singleParaminput ) );

	}

	public function test_multiple_options_gets_parsed() {

		$multipleParamInput = $this->sendInputAddContributorMultipleOptions();
		return $this->assertArrayHasKey( 'location', $this->helper->parseCliInput( $multipleParamInput ) );

	}

	public function test_explode_input_single_options() {
		
		$explodedArray = explode( " ", $this->sendInputAddContributorSingleOption() );
		return $this->assertTrue( is_array( $explodedArray ) );

	}

	public function test_single_option_array_not_null() {

		return $this->assertFalse( empty( $this->helper->parseCliInput( $this->sendInputAddContributorSingleOption() ) ) );
	
	}


}