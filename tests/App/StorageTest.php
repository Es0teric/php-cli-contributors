<?php

use App\Helpers;
use App\Storage;
use Faker\Factory as Faker;
use App\Command\AddContributorCommand as AddContributor;

class StorageTest extends PHPUnit_Framework_TestCase 
{


	public function __construct() {

		//lets init helpers class
		$this->helper = new Helpers();

		//lets init the storage class as well
		$this->storage = new Storage();

		//we will use this to mimic user input
		$this->faker = Faker::create();

		//lets init the addContributor object
		$this->addContributor = new AddContributor();

	}

	/**
	 * Create list of input
	 * 
	 * @return array $input list of generated add_contributor command params
	 */
	public function sendInputAddContributorUsingArray() {

		//store input array
		$input = [];

		//use faker to generate data
		$input = [
			'add_contributor --name="' . $this->faker->name . '" --location="' . $this->faker->state . '" --status="assigned"',
			'add_contributor --name="' . $this->faker->name . '" --location="' . $this->faker->state . '" --status="assigned"',
			'add_contributor --name="' . $this->faker->name . '" --location="' . $this->faker->state . '" --status="assigned"',
			'add_contributor --name="' . $this->faker->name . '" --location="' . $this->faker->state . '" --status="assigned"',
			'add_contributor --name="Jay Dee" --location="Detroit" --status="assigned"',
			'add_contributor --name="Illa J" --location="Detroit" --status="unassigned"',
			'add_contributor "Madlib", "California", "unassigned"',
			'add_contributor "Nas", "New York", "unassigned"',
			'add_contributor "Kanye West", "Chicago", "unassigned"',
			'add_contributor "Common", "Chicago", "unassigned"'
		];

		return $input;

	}

	public function sendInputAddContributor() {

		$input = 'add_contributor --name="Ray Allen" --location="Boston" --status="unassigned"';
		return $input;

	}

	/**
	 * Tests contributor data storage also serves as test data insert
	 * 
	 * @return void
	 */
	public function test_storage_store_contributor() {

		//loop through add contributor input
		foreach( $this->sendInputAddContributorUsingArray() as $input ) {

			$paramArray = $this->addContributor->parse( $input );

			if( array_key_exists( 'name', $paramArray ) )
				$name = $paramArray['name'];
			else
				$name = false;

			if( array_key_exists( 'location', $paramArray ) )
				$location = $paramArray['location'];
			else
				$location = 'Not Provided';

			if( array_key_exists( 'status', $paramArray ) )
				$status = $paramArray['status'];
			else
				$status = 'unassigned';

			//store add_contributor input data
			$contributor = $this->storage->storeContributor( $name, $location, $status );

		}

		//now we check the the size of the array to make sure the data saved
		$this->assertGreaterThan( 1, sizeof( $this->storage->listContributors( true ) ) );

	}

}