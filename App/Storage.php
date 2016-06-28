<?php namespace App;

class Storage {
	
    protected $data = [];

    public function __construct() { }

    /**
     * Stores contributor data into data array
     * 
     * @param  string $name     contributor name to be stored
     * @param  string $location location of contributor to be stored
     * @param  string $status   status of contributor: assigned|unassigned
     * @return boolean                      [description]
     */
	public function storeContributor( $name, $location, $status ) { }

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