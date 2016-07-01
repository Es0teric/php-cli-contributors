<?php namespace App;


/** 
 * Output folder is also known as "view" folder
 * once any of these return true, then call output file and output text accordingly
 */

use App\Helpers;

class Storage {
	
    protected $data;
    public $appDir;

    public function __construct() {

    	$this->data = [];
    	$this->helper = new Helpers();
    	$this->appDir = './App/';

    }

    /**
     * Stores contributor data into data array
     * 
     * @param  string $name     contributor name to be stored
     * @param  string $location location of contributor to be stored
     * @param  string $status   status of contributor: assigned|unassigned
     * 
     * @return array  $data     stored data to return
     */
	public function storeContributor( $name, $location, $status ) {

		$this->data[] = [
			'name' => $name,
			'location' => $location,
			'status' => $status
		];

		//$uniqueArray = array_unique( $this->data, SORT_REGULAR );

		$currentData = $this->readDataFile();

		if( !empty( $currentData ) ) {

			$merge = array_merge( $this->data, $currentData );
			$this->writeDataToFile( $merge );
			return $merge;

		} else {

			$this->writeDataToFile( $this->data );
			return $this->data;

		}

	}

	/**
	 * Writes current data in terminal session to json file
	 * 
	 * @return void
	 */
	public function writeDataToFile( $data ) {

		if( !empty( $data ) ) {

				
			//lets save the data into the json file
			file_put_contents( __DIR__ . '/data.json', json_encode( $data ) );
			
			//lets now loop through the list of new contributors that were added and notify the user
			/*foreach( $this->data as $item ) {
				$this->helper->info("Contributor " . $item['name'] . " added!");
			}*/
			

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

			//$this->helper->error('Uh oh! It seems that the data file doesnt exist, creating it now...');
			file_put_contents( __DIR__ . '/data.json' , []);

		}

	}

	/**
	 * Gets data array and returns it
	 * 
	 * @return array $data array of data that was created from storeContributor()
	 */
	public function getData() {

		$data = $this->readDataFile();

		return $data;
	
	}

	/**
	 * Checks current contributor array for any existing data
	 * 
	 * @param  string $name     contributor name to be checked
	 * @param  string $location contributor location
	 * @param  string $status   contributor status
	 * 
	 * @return void
	 */
	public function checkContributor( $name, $location, $status ) {

		$original = [
			'name' => $name,
			'location' => $location,
			'status' => $status
		];

		$existingData = $this->readDataFile();

		if( empty( $existingData ) || !file_exists( __DIR__ . '/data.json' ) ) {

			$this->storeContributor( $original['name'], $original['location'], $original['status'] );

		} else {

			//lets loop through the list of items to make sure there are no duplicates before inserting new data
			foreach( $existingData as $item ) {

				if( $item['name'] == $original['name'] )
					$this->helper->error('Uh oh, the contributor ' . $item['name'] . ' already exists!');
				else
					$this->storeContributor( $original['name'], $original['location'], $original['status'] );
					

			}


		}

	}

	/**
	 * Clears data array from current memory until user restarts the script
	 * 
	 * @return array $data empty array
	 */
	public function clearData() {

		return $this->data = [];

	}


	/**
	 * Returns list of contributors from data array
	 * 
	 * @return array data array containing list of contributors
	 */
	public function listContributors() {

		//lets read the data file
		$data = $this->readDataFile();

		//lets check if the data file contains items
		if( !empty( $data ) || file_exists( __DIR__ . '/data.json' ) )
			return $data;
		else
			$this->helper->error('Oh no... Either the file doesnt exist or it exists, but its empty');

	}

	/**
	 * Removes contributor data from data array
	 * 
	 * @param  string $name name of contributor to be removed
	 * @return boolean                  [description]
	 */
	public function removeContributor( $name ) { }

	/**
	 * Changes status of contributor to "assigned" in data array when contributor name is provided
	 * 
	 * @param  string $name contributor's name to be assigned
	 * @return boolean                  [description]
	 */
	public function assignContributor( $name ) { }

	/**
	 * Changes status of contributor to "unassigned" in data array when contributor name is provided
	 * 
	 * @param  string $name  contributor name to be unassigned
	 * @return boolean       [description]
	 */
	public function unassignContributor( $name ) { }

}