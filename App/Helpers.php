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
		if( is_array( $m['opt'] ) && !empty( $m['opt'] ) ) {
			
			$arr = [];

			//cleans strings inside of array values
			$arr['value'] = array_map(function($v) {

				return $this->stripQuotes( $v );

			}, $m['value']);

			//combine cleaned array strings and merge array key/values together
			return array_combine( $m['opt'] , $arr['value'] );

		} else {

			$items = explode( '", "', str_replace('add_contributor ','', trim( $input,'"' ) ) );

			//lets check if the user is passing in params through input
			if( !empty( $items ) ) {

				//loop through each item in the explode to strop quotes
				foreach( $items as $item ) {
					$newArray[] = $this->stripQuotes( $item ); 
				}

				//manually assign each individual key to each var
				if( array_key_exists( '0', $newArray ) )
					$name = $newArray[0];
				else
					$name = false;

				if( array_key_exists( '1', $newArray ) )
					$location = $newArray[1];
				else
					$location = false;

				if( array_key_exists( '2' , $newArray ) )
					$status = $newArray[2];
				else
					$status = false;

				//return array with appropriate key/values
				return [ 
					'name' => $name, 
					'location' => $location, 
					'status' => $status 
				];

			}

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