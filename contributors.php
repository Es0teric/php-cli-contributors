#!/usr/bin/env php
<?php

use App\Application;

class Contributors 
{

    public function init() {
        
        //lets init the application and begin
        $app = new Application();
        $app->run();

    }

}
$contributors = new Contributors();
$contributors->init();