<?php
function display_errors($errors){
	$display = '<ul class = "bg-danger">';
	foreach ($errors as $error) {
		$display .= '<li>'.$error.'</li>';
	}
	$display .= '</ul>'; 
	return $display;
}
function passed(){
	return "passed";
} 


function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number){
	return 'Ksh.'.number_format($number,2);
}

function login($user_id){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id' ");
	$_SESSION['success_flash'] = 'You Are Now Logged In';
	if (has_permission('admin') || has_permission('editor')) {
		header('Location: index.php');
	}else{
		header('Location: ../landlords/landlord_home.php');
	}
}

function is_logged_in(){
	if (isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
		return true;
	}
	return false;
}

function login_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'You Must Be Logged In.';
	header('Location: '.$url );
}

function permission_error_redirect($url = 'login.php'){
	$_SESSION['error_flash'] = 'You do not have permission to view this content.';
	header('Location: '.$url );
}

function has_permission($permission = 'admin'){
	global $user_data;
	$permissions = explode(',',$user_data['permissions']);
	if (in_array($permission, $permissions,true)) {
		return true;	
	}
	return false;
}

function pretty_date($date){
	return date("M d, Y h:i A",strtotime($date));
}

function get_category($child_id){
	global $db;
	$id = sanitize($child_id);
	$sql = "SELECT p.id AS 'pid',p.categories AS 'parent',c.id AS 'cid',c.categories AS 'child'
			FROM categories c
			INNER JOIN categories p 
			ON c.parent = p.id
			WHERE c.id = '$id'";
	$query = $db->query($sql);
	$category = mysqli_fetch_assoc($query);
	return $category;
}

function fix($amount){
          $amount_fix = ( $amount/100);
          return $amount_fix;
         }

function sizesToArray($string){
	$sizesArray = explode(',',$string);
	$returnArray = array();
	foreach ($sizesArray as $size) {
		$s = explode(':', $size);
		$returnArray[]=array('size' => $s[0],'quantity' => $s[1],'threshold' => $s[2]);
	}
	return $returnArray;
}

function sizesToString($sizes){
	$sizeString = '';
	foreach ($sizes as $size) {
		$sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold'].',';
	}
	$trimmed = rtrim($sizeString,',');
	return $trimmed;
}


?>