#!/usr/bin/env php
<?php namespace App;

require dirname( __DIR__ ) . '/vendor/autoload.php'; //includes autoloader, so lets go up one level in the tree

use App\Storage;
use Controllers\QuitController;
use App\Router;

class Application {

    public $welcome = "Type your message. Type 'quit' on a line by itself when you're done.\n";
    public $open = true;
    public $storage;

    public function __construct() {

        $this->storage = new Storage();
        
        //need to make storage (single instance) like a service and accessible from the controllers (ioc)
        $this->router = new Router();

        // set routes here or hardcode on 
    }

    public function run() {

        print $this->welcome;
        
        while( $this->open ) {

            $fp = fopen('php://stdin', 'r');
            $input = fgets( $fp, 1024 ); // read the special file to get the user input from keyboard            
            $inputs = $this->parse($input);
            $this->handle($input);
            
        }
    }

    public function parse($input) {
        // general validate
        return explode(" ", $input);
    }

    public function handle($input) {
        $this->router->handle(trim($input));
    }
}
$app = new Application;
$app->run();