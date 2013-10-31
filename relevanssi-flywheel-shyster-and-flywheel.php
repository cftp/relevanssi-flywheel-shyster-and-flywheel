<?php 

/*
Plugin Name: Relevanssi: Index ampersand joined initials
Plugin URI: http://github.com/cftp/relevanssi-flywheel-shyster-and-flywheel/
Description: Allows strings like "B&Q", "M&S" and other bastions of the UK corporate landscape to be properly indexed.
Version: 0.1
Author: Code for the People Ltd
Author URI: http://codeforthepeople.com/
*/
 
/*  Copyright 2013 Code for the People Ltd
                _____________
               /      ____   \
         _____/       \   \   \
        /\    \        \___\   \
       /  \    \                \
      /   /    /          _______\
     /   /    /          \       /
    /   /    /            \     /
    \   \    \ _____    ___\   /
     \   \    /\    \  /       \
      \   \  /  \____\/    _____\
       \   \/        /    /    / \
        \           /____/    /___\
         \                        /
          \______________________/


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/


/**
 * 
 * 
 * @package Relevanssi Flywheel, Shyster & Flywheel
 **/
class Relevanssi_Flywheel_Shyster_And_Flywheel {

	/**
	 * A version integer.
	 *
	 * @var int
	 **/
	var $version;

	/**
	 * Singleton stuff.
	 * 
	 * @access @static
	 * 
	 * @return Relevanssi_Flywheel_Shyster_And_Flywheel object
	 */
	static public function init() {
		static $instance = false;

		if ( ! $instance )
			$instance = new Relevanssi_Flywheel_Shyster_And_Flywheel;

		return $instance;

	}

	/**
	 * Class constructor
	 *
	 * @return null
	 */
	public function __construct() {
		remove_filter('relevanssi_remove_punctuation', 'relevanssi_remove_punct');
		add_filter( 'relevanssi_remove_punctuation', array( $this, 'filter_relevanssi_remove_punctuation' ) );

		$this->version = 1;
	}

	// HOOKS
	// =====

	/**
	 * Hooks the WP filter relevanssi_remove_punctuation
	 *
	 * @filter relevanssi_remove_punctuation
	 * 
	 * @param string $content Content to strip of punctuation
	 * @return string Content stripped of punctuation
	 * @author Simon Wheatley
	 **/
	public function filter_relevanssi_remove_punctuation( $a ) {
		$a = strip_tags($a);
		$a = stripslashes($a);

		$a = str_replace("·", '', $a);
		$a = str_replace("…", '', $a);
		$a = str_replace("€", '', $a);
		$a = str_replace("&shy;", '', $a);

		$a = str_replace(chr(194) . chr(160), ' ', $a);
		$a = str_replace("&nbsp;", ' ', $a);
		$a = str_replace('&#8217;', ' ', $a);
		$a = str_replace("'", ' ', $a);
		$a = str_replace("’", ' ', $a);
		$a = str_replace("‘", ' ', $a);
		$a = str_replace("”", ' ', $a);
		$a = str_replace("“", ' ', $a);
		$a = str_replace("„", ' ', $a);
		$a = str_replace("´", ' ', $a);
		$a = str_replace("—", ' ', $a);
		$a = str_replace("–", ' ', $a);
		$a = str_replace("×", ' ', $a);
		$a = str_replace("&amp;", '&', $a);

		// Any ampersands outside words, 
        $a = preg_replace('/([^\w])&([^\w])/u', '$1 $2', $a);
        // Lose all punctuations except ampersands
        $a = preg_replace('/[[:punct:]]+(?<!&)/u', ' ', $a);

        $a = preg_replace('/[[:space:]]+/', ' ', $a);
		$a = trim($a);

        return $a;
	}

}

// Initiate the singleton
Relevanssi_Flywheel_Shyster_And_Flywheel::init();
