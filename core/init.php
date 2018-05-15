<?php
$db = mysqli_connect('127.0.0.1','root','Kibiwott_254','alchemystore');

if (mysqli_connect_errno()) {
	echo 'Database connection failed with the following errors:'. mysqli_connect_error();
	die();
} 
session_start();//session inclusion
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/config.php';
require_once BASEURL.'helpers/helpers.php';

$cart_id = '';
if (isset($_COOKIE[CART_COOKIE])) {
	$cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

//setting the student cookie value
$student_id = '';
if (isset($_COOKIE[STUDENT_COOKIE])) {
	$student_id = sanitize($_COOKIE[CART_COOKIE]);
}

if (isset($_SESSION['SBUser'])) {
	$user_id = $_SESSION['SBUser'];
	$query = $db->query("SELECT * FROM users WHERE id = '$user_id' ");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$user_data['full_name']);
	$user_data['first'] = $fn['0'];
	$user_data['last'] = $fn['1'];
}

if (isset($_SESSION['success_flash'])) { 
	echo '<div class= "bg-success" style="margin-top:80px;"><p class="text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}

if (isset($_SESSION['error_flash'])) {
	echo '<div class= "bg-danger" style="margin-top:80px;"><p class="text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}
//session_destroy();

?>  