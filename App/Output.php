<?php namespace App;

class Output 
{

	/**
	 * Outputs Red error text onto the terminal
	 * 
	 * @param  string $text text to output on the terminal
	 * @return string       formatted text to output in the terminal
	 */
	public function error( $text ) {
		print "\r\n\033[1;31m $text \033[0m\r\n";
	}

	/**
	 * Outputs green info text onto the terminal
	 * 
	 * @param  string $text text to output on the terminal
	 * @return string       formatted text to output in the terminal
	 */
	public function info( $text ) {
		print "\r\n\033[0;32m $text \033[0m\r\n\r\n";
	}

	/**
	 * Outputs yellow warning text onto the terminal
	 * 
	 * @param  string $text text to output on the terminal
	 * @return string       formatted text to output in the terminal
	 */
	public function warning( $text ) {
		print "\r\n\033[1;33m $text \033[0m\r\n\r\n";
	}

/**
 * Prints welcome message when user initiates script
 * 
 * @return string     text to print
 */
	public function welcome() {

	return <<<EOT
	Welcome to the contributor store.  Available commands are:
    add_contributor "<name>", "<location>", "<status>" - add a new contributor, status optional ("assigned" or "unassigned", defaults to "unassigned").
    
    add_contributor can also work like this: add_contributor --name="<name>" --location="<location>" --status="<status>"
    
    del_contributor "<name>" - remove a contributor.
    
    assign_contributor "<name>" - mark a contributor as being assigned.
    
    unassign_contributor "<name>" - mark a contributor as being unassigned.. Type "quit" or "exit" on a line by itself when you're done.

EOT;

	}
	

}