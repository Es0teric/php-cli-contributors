<?php namespace App;

require dirname( __DIR__ ) . '/vendor/autoload.php'; //includes autoloader, so lets go up one level in the tree

use App\Controllers\SessionController;
use App\Router;
use App\Output;

class Application 
{

    public $welcome;

    public $open = true;

    public function __construct() {

        //need to make storage (single instance) like a service and accessible from the controllers (ioc)
        $this->router = new Router();

        //lets init the session controller to allow the user to quit the script
        $this->session = new SessionController();

        $this->output = new Output();

    }

    public function run() {

        print $this->output->welcome();
        
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