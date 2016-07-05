<?php namespace App;

use App\Controllers\SessionController;
use App\Command\AddContributorCommand as AddContributor;
use App\Command\ShowAllContributorsCommand as ShowAllContributors;
use App\Command\DeleteContributorCommand as DeleteContributor;


class Router {

    public function __construct() {

        $this->addContributor = new AddContributor();
        $this->showAllContributors = new ShowAllContributors();
        $this->deleteContributor = new DeleteContributor();
        
    }

    public function run( $input ) {
        $this->handle( $input );
    }

    public function handle( $input ) {

        //lets explode the input from stdin to extract the base command
        $explodedInput = explode( " ", trim( $input ) );

        //lets check for the add_contributor command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'add_contributor' )
            $this->addContributor->run( trim( $input ) );

        //lets check for the show_all command
        if( trim( $input ) == 'show_all' )
            $this->showAllContributors->run( trim( $input ) );

        elseif( $explodedInput[0] == 'show_all' )
            $this->showAllContributors->run( $explodedInput );

        //lets check for the del_contributor command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'del_contributor' )
            $this->deleteContributor->run( trim( $input ) );


        //parse out controller
        //$this->parseRequest($input)
    }

    public function parseRequest($input) {
        //$this->routes = $input; //parse out controller
        //$this->routes;
        //$this->request = new Request(); //parse out data that is not controller
    }

}