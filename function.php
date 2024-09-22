<?php
/* $baseurl = "http://demo.tailor.sarutech.com";	
$dbname = "osaru_demo_tailor";
$dbhost = "localhost";
$dbuser = "osaru_tech";
$dbpass = "Sr123Th24"; */


$baseurl = "http://localhost/tailor/";	
$dbname = "tailor";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";


// error_reporting(E_ALL);



function dbconnect()
{
	global $pdo;

	try {
		$pdo = new PDO('mysql:host='.$GLOBALS['dbhost'].';dbname='.$GLOBALS['dbname'].'', $GLOBALS['dbuser'], $GLOBALS['dbpass']);
	} catch (PDOException $e) {
		die('MySQL connection fail! ' . $e->getMessage());
	}
}


function insert_new_user($username, $password)
{
	# checking username is already taken
	if (username_exists($username))
		return false;

	# insert new user info
	global $pdo;
	$stmt = $pdo->prepare('
		INSERT INTO users
		(username, password)
		values (:username, :password)');

	$stmt->execute( array(':username' => $username, ':password' => md5($password)) );

	if ($pdo->lastInsertId())
		return true;
	else
		return false;
}

function username_exists($username)
{
	global $pdo;
	
	$stmt = $pdo->prepare('
		SELECT id
		FROM users
		WHERE username = :username
		LIMIT 1');

	$stmt->execute( array('username' => $username) );
	return $stmt->fetchColumn();
}

function attempt($username, $password)
{
	global $pdo;
	
	$stmt = $pdo->prepare('
		SELECT id, username,role
		FROM users
		WHERE username = :username AND password = :password
		LIMIT 1');

	$stmt->execute(array(':username' => $username, 'password' => md5($password)));

	if ($data = $stmt->fetch( PDO::FETCH_OBJ )) {
		# set session
		$_SESSION['id'] = $data->id;
		$_SESSION['username'] = $data->username;
		$_SESSION['role'] = $data->role;
		setcookie('user_id', $data->id, time() + (30 * 24 * 60 * 60), "/", "", false, true);
        setcookie('username', $data->username, time() + (30 * 24 * 60 * 60), "/", "", false, true);
        setcookie('user_role', $data->role, time() + (30 * 24 * 60 * 60), "/", "", false, true);
		return true;
	} else {
		return false;
	}
}

function fetch_order_details($orderId) {
    global $pdo;
    $query = "SELECT * FROM `order` WHERE id = :orderId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':orderId', $orderId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function is_user()
{
	if (isset($_SESSION['username']) || isset($_COOKIE['username'])){
		$_SESSION['id']=$_COOKIE['user_id'];
		$_SESSION['username']=$_COOKIE['username'];
		$_SESSION['role']=$_COOKIE['user_role'];

		return true;
	}
}

function is_admin()
{
	if (isset($_SESSION['role']) && $_SESSION['role']=='admin') return true;
}

function is_employee()
{
	if (isset($_SESSION['role']) && $_SESSION['role']=='employee') return true;
}

function redirect($url)
{
	header('Location: ' .$url);
	exit;
}

function valid_username($str){
	return preg_match('/^[a-z0-9_-]{3,16}$/', $str);
}

function valid_password($str){
	return preg_match('/^[a-z0-9_-]{6,18}$/', $str);
}





?>