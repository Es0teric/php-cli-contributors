#!/usr/bin/env php
<?php

use App\Application;

class Contributors 
{

    public function init() {

    	//lets include the app namespace in this
    	spl_autoload_register();

        //lets init the application and begin
        $app = new Application();
        $app->run();

    }

}
$contributors = new Contributors();
$contributors->init();