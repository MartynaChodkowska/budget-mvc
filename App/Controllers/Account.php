<?php

namespace App\Controllers;

use \App\Models\User;

 /*
  * Account ceontroller
  *
  * PHP version 7.4
  */
 class Account extends \Core\Controller
 {
	/**
	 * Validate is email is availabe (AJAX) for a new signup
	 *
	 * @return void
	 */
	 public function validateEmailAction()
	 {
		 $is_valid = ! User::emailExists($_GET['email'], $_GET['ignore_id'] ?? null);
		 header('Content-Type: application/json');
		echo json_encode($is_valid);
	 }
 }