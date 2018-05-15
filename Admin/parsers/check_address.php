<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
	$name = sanitize($_POST['full_name']);
	$email = sanitize($_POST['email']);
	$phone = sanitize($_POST['phone']);
	$id_num = sanitize($_POST['id_num']);
	$errors = array();
	$required = array(
		'full_name' => 'Full Name',
		'email'     => 'Email',
		'phone'     => 'Phone Number',
		'id_num'    => 'ID number',
	);

	//check if all required fields are filled
	foreach ($required as $f => $d) {
		if (empty($_POST[$f]) || $_POST[$f] == '') {
			$errors[] = $d.' is required.';
		}
	}

	//check if email is valid
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'please enter a valid email.';
	}

	if (!empty($errors)) {
		echo display_errors($errors);
	}else {
		echo 1;
	}
	
?>