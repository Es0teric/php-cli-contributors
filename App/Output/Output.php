<?php namespace App\Output;

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

	

}