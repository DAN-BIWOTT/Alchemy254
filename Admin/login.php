<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
?>
<link rel="stylesheet" type="text/css" href="../vendorSignUp/animate/animate.css">
<link rel="stylesheet" type="text/css" href="../vendorSignUp/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="../vendorSignUp/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="../vendorSignUp/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="../vendorSignUp/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="../css/utilSignUp.css">
<link rel="stylesheet" type="text/css" href="../css/mainSingUp.css">
<div class="login_styling" id="login-form">
	<div>
		
		<?php
		if ($_POST) {
			#form validation
			if (empty($_POST['email']) || empty($_POST['password'])) {
				$errors[] = 'You must provide email and password.';
			}
			//validate email
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'You must enter a valid email.';
			}

			//password is more than 6 characters
			if (strlen($password)<6) {
				$errors[] = 'Password must be at least 6 characters.';
			}

			//check if the email exists in the database
			$query = $db->query("SELECT * FROM users WHERE email = '$email' ");
			$user = mysqli_fetch_assoc($query);
			$userCount = mysqli_num_rows($query);
			if ($userCount < 1) {
				$errors[] = 'That Email doesnt exist';
			}

			if (!password_verify($password,$user['password'])) {
				$errors[] = 'Either the password or the email address is wrong.';
			}

			//check for errors
			if (!empty($errors)) {
				echo display_errors($errors);
			}else{
				//log user in
				$user_id = $user['id'];
				login($user_id);
			}
		}

?>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="email" name="email" placeholder="Type your email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>


					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"><br></fb:login-button><br><div id="status"><br></div>

					<div class="text-right p-t-8 p-b-31">
						<a href="../index.php">
							Visit Main Page
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>
					</div>

				<!-- 	<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Or Sign Up Using
						</span>
					</div>

					<div class="flex-c-m">
						<a href="#" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							Or Sign Up Using
						</span> -->

						<a href="register.php" class="txt2">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div> 
	

	<div id="dropDownSelect1"></div>
</body>
<?php
include 'includes/footer.php';
 ?>