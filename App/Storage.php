<?php namespace App;


/** 
 * Output folder is also known as "view" folder
 * once any of these return true, then call output file and output text accordingly
 */

use App\Helpers;
use App\Output\Output;

class Storage {
	
    protected $data = [];
    public $file = [];

    public function __construct() {

    	$this->helper = new Helpers();
    	$this->output = new Output();

    }

    /**
     * Stores contributor data into data array
     * 
     * @param  string $name     contributor name to be stored
     * @param  string $location location of contributor to be stored
     * @param  string $status   status of contributor: assigned|unassigned
     * 
     * @return array  $merged     merged data to return
     */
	public function storeContributor( $name, $location, $status ) {

		//retrieve current data array from json file
		$file = $this->readDataFile();

		//store current input into this array
		$original[] = [
			'name' => $name,
			'location' => $location,
			'status' => $status
		];

		//lets check if the data.json file is empty
		if( !empty( $file ) ) {

			//now we loop through each array to make sure that there is no duplicate data being added
			foreach( $file as $key => $item ) {

				//check against the name of the array list and the name thats being passed in
				if( $item['name'] == $name ) {

					//store duplicate array key index inside of this var
					$dupeArrayIndexes[] = $key;
					$this->output->warning('Uh oh, the contributor ' . $item['name'] . ' already exists!');
				
				} else {

					//this is the array that we will save
					$cleanedArray[] = $item;
				
				}

			}

			//merge the original array with current STDIN data with the clean array that contains no duplicates
			$merged = array_merge( $cleanedArray, $original );

			//lets write to the data file
			$this->writeDataToFile( $merged );

			//return the merged data
			return $merged;

		} else {

			//we are going to be writing new data now
			$this->writeDataToFile( $original);
			return $original;
		}


	}

	/**
	 * Writes current data in terminal session to json file
	 * 
	 * @param  array 	$data   data to save
	 * @param  boolean  $update if false, the user is not removing an array key to update the data
	 * @return void
	 */
	public function writeDataToFile( $data, $update = false ) {

		if( !empty( $data ) ) {

			//store initial data array
			$fileData = $data;

			//lets pop the last item in the array so we can notify the user what was saved
			$lastItem = array_pop( $data );

			//lets save the data into the json file
			$fileSave = file_put_contents( __DIR__ . '/data.json', json_encode( $fileData ) );
			
			//lets check if the file saves correctly before outputting a success message
			if( $fileSave === false ) 
				$this->output->error( 'Uh oh!! The file failed to save.. please check file permissions' );
			elseif( $update === false )
				$this->output->info("-- Contributor " . $lastItem['name'] . " added!");
			

		}

	}

	/**
	 * Removes data file when terminal session is destroyed
	 * 
	 * @return void
	 */
	public function removeDataFile() {

		if( file_exists( __DIR__ . '/data.json' ) )
			unlink( __DIR__ . '/data.json' );

	}

	/**
	 * Reads data.json file and returns the contents in a PHP array
	 * 
	 * @throws Exception when file does not exist or cannot be retrieved due to file permissions
	 * @return array $data json decoded array of data
	 */
	public function readDataFile() {

		if( file_exists( __DIR__ . '/data.json' ) ) {

			$data = json_decode( file_get_contents( __DIR__ . '/data.json' ), true );
			return $data;

		} else {

			//$this->output->error('Uh oh! It seems that the data file doesnt exist, creating it now...');
			file_put_contents( __DIR__ . '/data.json' , []);

		}

	}

	/**
	 * Returns list of contributors from data array
	 * 
	 * @param  boolean 	$returnArray  returns array list representation and not terminal output if true for unit testing
	 * @return array 				  data array containing list of contributors to return if $returnArray is set
	 */
	public function listContributors( $returnArray = false ) {

		//lets read the data file
		$data = $this->readDataFile();

		//lets check if the data file contains items
		if( !empty( $data ) ) {

			//lets see if returnArray is set so we can either return a list of contributors or its array
			//representation
			if( $returnArray == false ) {
				
				//now we output the contributors
				foreach( $data as $item ) {
					$this->output->info('-- ' . $item['name'] . ' (' . $item['location'] . ', ' . $item['status'] . ') ');
				}

			} else {

				//return array for unit testing
				return $data;

			}

		} else {

			$this->output->error('Oh no... there are no contributors to show yet... go ahead and add some');
			
		}

	}


	/**
	 * Removes contributor from data array
	 * 
	 * @param  int $index index key of the array belonging to the contributor to be removed
	 * @return void
	 */
	public function removeContributor( $index ) {

		//we need to grab the list of contributors that exist again
		$file = $this->listContributors(true);

		//then we check against the index to make sure that the contributor does infact, exist
		if( array_key_exists( $index , $file ) ) {

			//we then store the array inside of this so we can prompt the user that it was infact removed
			$contributor = $file[$index];
			
			unset( $file[$index] );
			$this->writeDataToFile( $file, true );
			$this->output->info( '-- Contributor ' . $contributor['name'] . ' was removed!' );

		} else {

			$this->output->error('-- This contributor was already removed.');

		}


	}

	/**
	 * Changes status of contributor to "assigned" in data array when contributor name is provided
	 * 
	 * @param  string $name contributor's name to be assigned
	 * @return void
	 */
	public function assignContributor( $name ) {

		$list = $this->listContributors( true );

		foreach( $list as $key => $item ) {

			if( $item['name'] == $name ) {

				if( $item['status'] !== 'assigned' ) {

					$item['status'] = 'assigned';
					$this->output->info( '-- The contributor ' . $name . ' has been updated!' );

				} else {

					$this->output->warning( '-- The contributor ' . $name . ' is already assigned.' ); 

				}

			}

			$updatedArray[] = $item;

		}

		$this->writeDataToFile( $updatedArray, true );
		
	}

	/**
	 * Changes status of contributor to "unassigned" in data array when contributor name is provided
	 * 
	 * @param  string $name  contributor name to be unassigned
	 * @return void
	 */
	public function unassignContributor( $name ) {

		$list = $this->listContributors( true );

		foreach( $list as $key => $item ) {

			if( $item['name'] == $name ) {

				if( $item['status'] !== 'unassigned' ) {

					$item['status'] = 'unassigned';
					$this->output->info( '-- The contributor ' . $name . ' has been updated!' );

				} else {

					$this->output->warning( '-- The contributor ' . $name . ' is already unassigned.' ); 

				}

			}

			$updatedArray[] = $item;

		}

		$this->writeDataToFile( $updatedArray, true );

	}

}