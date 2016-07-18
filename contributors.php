#!/usr/bin/env php
<?php

require_once( __DIR__ . '/App/Application.php');


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