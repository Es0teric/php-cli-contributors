<?php

use App\Helpers;
use App\Command\AddContributorCommand as AddContributor;

/**
 * Test class for parsing stdin options/arguments after the command
 * 
 */
class OptionParserTest extends PHPUnit_Framework_TestCase 
{

	public function __construct() {

		//lets instantiate the helper class for CLI parsing
		$this->helper = new Helpers();

		$this->addContributor = new AddContributor();

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

	public function sendInputForExplodeSingleParam() {

		$input = 'add_contributor "John Wall"';
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

	/**
	 * Test if single option/argument after command gets parsed
	 * 
	 * @return void
	 */
	public function test_single_option_gets_parsed() {
		
		$singleParaminput = $this->sendInputAddContributorSingleOption();
		$this->assertArrayHasKey('name', $this->addContributor->parse( $singleParaminput ) );

	}

	/**
	 * Test if multiple options/arguments after command get parsed
	 * 
	 * @return void
	 */
	public function test_multiple_options_gets_parsed() {

		$multipleParamInput = $this->sendInputAddContributorMultipleOptions();
		$this->assertArrayHasKey( 'location', $this->addContributor->parse( $multipleParamInput ) );

	}

	/**
	 * Test if explode works on initial command to seperate it from options/arguments
	 * 
	 * @return void
	 */
	public function test_explode_input_single_options() {
		
		$explodedArray = explode( " ", $this->sendInputAddContributorSingleOption() );
		$this->assertTrue( is_array( $explodedArray ) );

	}

	/**
	 * Test if single option/argument after command gets parsed and array is not null as well as strings get quotes stripped
	 * 
	 * @return void
	 */
	public function test_single_option_array_not_null() {

		$this->assertFalse( empty( $this->addContributor->parse( $this->sendInputAddContributorSingleOption() ) ) );
	
	}

	/**
	 * Test if multiple options/arguments after command gets parsed and array is not null as well as strings get quotes stripped
	 * 
	 * @return void
	 */	
	public function test_multiple_option_array_not_null() {
		$this->assertFalse( empty( $this->addContributor->parse( $this->sendInputAddContributorMultipleOptions() ) ) );
	}

	public function test_parser_without_long_params() {

		$output = $this->addContributor->parse( $this->sendInputForExplodeSingleParam() );
		$this->assertTrue( is_array( $output ) );

	}

}