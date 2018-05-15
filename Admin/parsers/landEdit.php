<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
if (isset($_GET['edit'])) {

$pname = ((isset($_POST['name']) && !empty($_POST['name']))?sanitize($_POST['name']):$user_data['full_name']);
$email = ((isset($_POST['email']) && !empty($_POST['email']))?sanitize($_POST['email']):$user_data['email']);
$phone = ((isset($_POST['phone']) && !empty($_POST['phone']))?sanitize($_POST['phone']):$user_data['phone_number']);
$description = ((isset($_POST['description']) && !empty($_POST['description']))?sanitize($_POST['description']):$user_data['description']);

$errors = array();

	 if ($_FILES['image']['name'] != "") {	
	 	$photo = $_FILES['image'];
		$name = $photo['name'];
		$nameArray = explode('.', $name);
		$fileName = $nameArray[0];
		$fileExt = $nameArray[1];
		$mime = explode('/', $photo['type']);
		$mimeType = $mime[0];
		$mimeExt = $mime[1];
		$tmpLoc = $photo['tmp_name'];
		$fileSize = $photo['size'];
		$allowed = array('png','jpg','jpeg','gif');
		$updloadName = md5(microtime()).'.'.$fileExt;
		$updloadPath = BASEURL.'img/users/'.$updloadName;
		$dbpath = '/clothing_store/img/users/'.$updloadName;		
		
			
			if($mimeType != 'image'){
				$errors[] = 'The file must be an image.';
			}
					
			if (!in_array($fileExt, $allowed)) {
				$errors[] = 'The file extension must be a png, jpeg, jpg of gif.';
			}

			if ($fileSize > 25000000) {
				$errors[] = 'the file size must be under 25mb';
			}

			if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
				$errors[] = 'file extension does not match the file';
			}

		}else{
				$dbpath = $user_data['picture'];
		}

	if(!empty($errors)){
		echo display_errors($errors);
	}else{
			//upload file into data base
		if (!empty($_FILES)) {
		move_uploaded_file($tmpLoc, $updloadPath);
	}
	$user = $user_data['id'];
	$db->query("UPDATE users SET full_name = '$pname' ,email = '$email',phone_number = '$phone', description = '$description', picture = '$dbpath' WHERE id = '$user' ");
	header('Location: ../../landlords/landlord_home.php');
}
}
?>