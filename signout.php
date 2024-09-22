<?php
/**
 * User Login System
 * @author Resalat Haque
 * @link http://www.w3bees.com
 */
 
require_once('function.php');
session_start();

if(session_destroy())
	setcookie('user_id', '', time() - 3600, "/", "", false, true);
	setcookie('username', '', time() - 3600, "/", "", false, true);
	setcookie('user_role', '', time() - 3600, "/", "", false, true);
	if(isset($_GET['error'])){
		redirect('signin.php?error='.$_GET['error']);
	}else{
		redirect('signin.php');
	}
	
	exit;
?>