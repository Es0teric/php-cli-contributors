<?php namespace App;

class Storage {
	
    protected $data = [];

    public function __construct() { }

	public function storeContributor( $contributorName, $contributorLocation, $contributorStatus ) { }

	public function removeContributor( $contributorName ) { }
	
	public function assignContributor( $contributorName ) { }

	public function unassignContributor( $contributorName ) { }

}