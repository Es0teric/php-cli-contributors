<?php namespace App;

class Helpers 
{

	/**
	 * Parses CLI input from command params by stripping quotes in values and assigning them to a single array 
	 * 
	 * @param  string $input user input from stdin
	 * @return array         parsed input with values that have stripped inner quotes
	 */
	public function parseCliInput( $input ) {

		//regex to parse input for params
		preg_match_all('/--(?P<opt>.*?)=(?P<value>".*?")/', $input, $m);

		//parse input for multiple array key values
		if( is_array( $m['opt'] ) ) {
			
			$arr = [];

			//cleans strings inside of array values
			$arr['value'] = array_map(function($v) {

				return $this->stripQuotes( $v );

			}, $m['value']);

			//combine cleaned array strings and merge array key/values together
			return array_combine( $m['opt'] , $arr['value'] );

		}


	}

	/**
	 * Strips quotes from string
	 * 
	 * @param  string $value string containing quotes to be stripped
	 * @return string        string with stripped quotes
	 */
	public function stripQuotes( $value ) {

		//return stripped quotes from string
		return str_replace(['"', "'"], '', $value);

	}


}