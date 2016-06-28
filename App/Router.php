<?php namespace App;

use Controllers\AddController;
use App\Command\AddContributorCommand;

class Router {

    public function __construct() {
        //$this->routes[] = AddController::class;
        //$this->route = new AddController();
        //$this->route[] = AddController::class;
        $this->addContributorCommand = new AddContributorCommand;
        
    }

    public function handle( $input ) {

        //lets explode the input from stdin to extract the base command
        $explodedInput = explode( " ", trim( $input ) );

        //lets check for the add_contributor command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'add_contributor' )
            $this->addContributorCommand->run( trim( $input ) );

        //var_dump($this->route);

        //parse out controller,
        $request = $this->parseRequest($input);
        //$this->route->run($this->request);
        
    }

    public function parseRequest($input) {
        //$this->routes = $input; //parse out controller
        //$this->routes;
        //$this->request = new Request(); //parse out data that is not controller
    }
}