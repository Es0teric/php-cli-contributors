<?php namespace App;

use App\Controllers\SessionController;
use App\Command\AddContributorCommand as AddContributor;
use App\Command\ShowAllContributorsCommand as ShowAllContributors;
use App\Command\DeleteContributorCommand as DeleteContributor;
use App\Command\ShowByLocationCommand as ShowByLocation;
use App\Command\ShowByStatusCommand as ShowByStatus;
use App\Command\AssignContributorCommand as AssignContributor;
use App\Command\UnassignContributorCommand as UnassignContributor;
use App\Output;


class Router 
{

    public function __construct() {

        $this->output = new Output();
        $this->addContributor = new AddContributor();
        $this->showAllContributors = new ShowAllContributors();
        $this->deleteContributor = new DeleteContributor();
        $this->showByLocation = new ShowByLocation();
        $this->showByStatus = new ShowByStatus();
        $this->assignContributor = new AssignContributor();
        $this->unassignContributor = new UnassignContributor();

    }

    public function run( $input ) {
        $this->handle( $input );
    }

    protected function handle( $input ) {

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

        //lets check for the show_by_location command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'show_by_location' )
            $this->showByLocation->run( trim( $input ) );

        //lets check the show_by_status command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'show_by_status' )
            $this->showByStatus->run( trim( $input ) );

        //lets check for the assign_contributor command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'assign_contributor' )
            $this->assignContributor->run( trim( $input ) );

        //lets check for the unassign_contributor command
        if( array_key_exists( '0', $explodedInput ) && $explodedInput[0] == 'unassign_contributor' )
            $this->unassignContributor->run( trim( $input ) );
        
    }

}