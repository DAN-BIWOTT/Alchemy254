<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';

$hashed = $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);

$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);

$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);

$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id'];

$errors = array();
?>


<div id="login-form">
	<div>
		
		<?php
		if ($_POST) {
			#form validation
			if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
				$errors[] = 'You must fill out all fields.';
			}
			
			//password is more than 6 characters
			if (strlen($password)<6) {
				$errors[] = 'Password must be at least 6 characters.';
			}

			//if new password equals confirm
			if ($password != $confirm) {
				$errors[] = 'The new password and old password does not match.';
			}

			if (!password_verify($old_password,$hashed)) {
				$errors[] = 'Your old password does not match our records.';
			}

			//check for errors
			if (!empty($errors)) {
				echo display_errors($errors);
			}else{
			//change password
				$db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id' ");
				$_SESSION['success_flash'] = 'Your password has been updated.';
				header('Location: ../landlords/landlord_home.php');
			}
		}

		?>

	</div>


	<body>
		
		<div class="limiter">
			<div class="container-login100" style="background-image: url('../images/bg-01.jpg');">
				<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
					<form class="login100-form validate-form" action="change_password.php" method="post">
						<span class="login100-form-title p-b-49">
							Change Password
						</span>

						<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
							<span class="label-input100">Old Password</span>
							<input class="input100" type="password" name="old_password" value="<?=$old_password?>" placeholder="    Old password...">
							<span class="focus-input100" data-symbol="&#xf206;"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
							<span class="label-input100">New Password</span>
							<input class="input100" type="password" name="password" value="<?=$password?>" placeholder="    New password...">
							<span class="focus-input100" data-symbol="&#xf206;"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate="Password is required">
							<span class="label-input100">Cornfirm Password</span>
							<input class="input100" type="password" name="confirm" value="<?=$confirm?>" placeholder="    Repeat password...">
							<span class="focus-input100" data-symbol="&#xf190;"></span>
						</div>

						
						<div class="container-login100-form-btn">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button class="login100-form-btn" type="submit">
									Change Password
								</button>
							</div><br>
						<a href="../"  class="txt2"" alt="home">Visit Site</a>
					</form>
				</div>
			</div>
		</div> 
		

		<div id="dropDownSelect1"></div>



<?php 
include 'includes/footer.php';
 ?>