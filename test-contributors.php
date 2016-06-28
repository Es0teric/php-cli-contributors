#!/usr/bin/env php
<?php

class Application {

    public $welcome = "Type your message. Type 'quit' on a line by itself when you're done.\n";
    public $open = true;
    public $users;
    public $other;

    public function __construct() { }

    public function run() {

        print $this->welcome;
        
        while ($this->open) {

            $fp = fopen('php://stdin', 'r');
            $input = fgets($fp, 1024); // read the special file to get the user input from keyboard
            $this->shouldQuit($input);

            $inputs = $this->parse($input);
            $route = $inputs[0];

            if( isset( $inputs[1] ) )
            	$argument = $inputs[1];
            else
            	$argument = false;

            //$this->canRoute($route);


            /*if( !$argument )
            	$this->$route($argument);*/

        }

    }

    public function canRoute($route) {
        // run is callable, validate
    }
    public function parse($input) {
        // general validate
        return explode(" ", $input);
    }

    public function showUsers() {
    	if( !empty( $this->users ) ) 
    		print_r( $this->users );
    }

    public function add($username) {
        $this->users[] = $username;
    }

    public function shouldQuit($input) {
        if ("quit\n" == $input) {
            $this->open = false;
            var_dump($this->users);
            print trim("peace out!");
        }
    }

}

$app = new Application;
$app->run();