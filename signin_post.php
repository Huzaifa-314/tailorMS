<?php

require_once('function.php');
dbconnect();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (attempt($_POST['username'], $_POST['password'])) {
		if($_SESSION['role']=='admin') redirect('home.php');
		else if($_SESSION['role']=='employee') redirect('home.php');
		else redirect('index.php');
		
	}
	else {
		redirect('index.php?error=' . urlencode('Wrong username or password'));
	}
}

?>