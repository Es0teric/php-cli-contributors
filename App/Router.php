<?php namespace App;

use App\Controllers\SessionController;
use App\Command\AddContributorCommand as AddContributor;
use App\Command\ShowAllContributorsCommand as ShowAllContributors;
use App\Command\DeleteContributorCommand as DeleteContributor;
use App\Command\ShowByLocationCommand as ShowByLocation;
use App\Output\Output;


class Router {

    public function __construct() {

        $this->output = new Output();
        $this->addContributor = new AddContributor();
        $this->showAllContributors = new ShowAllContributors();
        $this->deleteContributor = new DeleteContributor();
        $this->showByLocation = new ShowByLocation();

    }

    public function run( $input ) {
        $this->handle( $input );
    }

    public function handle( $input ) {

        //lets explode the input from stdin to extract the base command
        $explodedInput = explode( " ", trim( $input ) );

        //lets check for the add_contributor command
        if( array_key_exists( '0', $explodedInput ) )
            $this->addContributor->run( trim( $input ) );
        else
            $this->output->error( '-- Please insert a contributor to add' );

        //lets check for the show_all command
        if( trim( $input ) == 'show_all' )
            $this->showAllContributors->run( trim( $input ) );

        elseif( $explodedInput[0] == 'show_all' )
            $this->showAllContributors->run( $explodedInput );

        //lets check for the del_contributor command
        if( array_key_exists( '0', $explodedInput ) )
            $this->deleteContributor->run( trim( $input ) );
        else
            $this->output->error( '-- Please insert a contributor to remove' );

        //lets check for the show_by_location command
        if( array_key_exists( '0', $explodedInput ) )
            $this->showByLocation->run( trim( $input ) );
        else
            $this->output->error( '-- Please insert a contributor with location to search by' );

        //lets check the show_by_status command
        if( array_key_exists( '0', $explodedInput ) )
            $this->showByStatus->run( trim( $input ) );
        else
            $this->output->error( '-- Please insert a contributor with status to search by ' );
        
    }

}