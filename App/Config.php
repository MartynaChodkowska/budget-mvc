<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.4
 */
class Config
{
	
	/**
	 * Database host
	 * @var string
	 */
	 const DB_HOST = 'localhost';
	 
	/**
	 * Database name
	 * @var string
	 */
	 const DB_NAME= 'budget-mvc';
	 
	/**
	 * Database user
	 * @var string
	 */
	 const DB_USER= 'root';
	 
	/**
	 * Database password
	 * @var string
	 */
	 const DB_PASSWORD= 'secret';
	 
	 /**
	  * Show or hide error messages on screen
	  * @var boolean
	  */
	 
	 const SHOW_ERRORS = true;
	
	/**
     * Secret key for hashing
     * @var boolean
     */
	 const SECRET_KEY = 'Rmip0r5KFsvULkeVRmeYZWvWnX4GO8TZ';
	 
		
}
