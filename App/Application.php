<?php namespace App;

require dirname( __DIR__ ) . '/vendor/autoload.php'; //includes autoloader, so lets go up one level in the tree

use App\Controllers\SessionController;
use App\Router;

class Application 
{

    public $welcome = '
    Welcome to the contributor store.  Available commands are:
    add_contributor "<name>", "<location>", "<status>" - add a new contributor, status optional ("assigned" or "unassigned", defaults to "unassigned").
    
    add_contributor can also work like this: add_contributor --name="<name>" --location="<location>" --status="<status>"
    
    del_contributor "<name>" - remove a contributor.
    
    assign_contributor "<name>" - mark a contributor as being assigned.
    
    unassign_contributor "<name>" - mark a contributor as being unassigned.. Type "quit" or "exit" on a line by itself when you\'re done.

';

    public $open = true;

    public function __construct() {

        //need to make storage (single instance) like a service and accessible from the controllers (ioc)
        $this->router = new Router();

        //lets init the session controller to allow the user to quit the script
        $this->session = new SessionController();

    }

    public function run() {

        print $this->welcome;
        
        while( $this->open ) {

            $fp = fopen('php://stdin', 'r');
            $input = fgets( $fp, 1024 ); // read the special file to get the user input from keyboard            
            $inputs = $this->parse($input);

            //lets detect if the user wants to quit 
            if( trim( $inputs[0] ) == 'quit' || trim( $inputs[0] ) == 'exit' ) {
                $this->open = $this->session->destroy();
            }

            $this->handle( $input );
            
        }
    }

    public function parse($input) {

        // general validate
        return explode(" ", $input);
        
    }

    public function handle($input) {
        $this->router->run( trim( $input ) );
    }
}

$app = new Application;
$app->run();