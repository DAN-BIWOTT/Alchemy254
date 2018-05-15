<?php 
 require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
 include 'includes/head.php';

 if (isset($_GET['register'])) {
 	$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
 	$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
 	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
 	$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
 	$phone_number = ((isset($_POST['phone_number']))?sanitize($_POST['phone_number']):'');
 	$phone_number = (int)$phone_number;
 	$errors = array();
 	//validation
 	if ($_POST) {
 		$emailQuery = $db->query("SELECT * FROM users WHERE email = '$email' ");
 		$emailCount = mysqli_num_rows($emailQuery);

 		if ($emailCount != 0) {
 			$errors[] = 'That email already exists in our database.';
 		}

 		$required = array('name','email','password','confirm','phone_number');
 		foreach ($required as $f) {
 			if (empty($_POST[$f])) {
 				$errors[] = 'You must fill out all fields.';
 				break;
 			}
 		}
 		if (strlen($password) < 6) {
 			$errors[] = 'Password must be atleast 6 characters.';
 		}

 		if ($password != $confirm) {
 			$errors[] = 'Your passwords do not match.';
 		}

 		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
 			$errors[] = 'You must enter a valid email.';
 		}

 		if (!empty($errors)) {
 			echo display_errors($errors);
 		}else{
 			//add new user
 			$hashed = password_hash($password,PASSWORD_DEFAULT);
 			$db->query("INSERT INTO users (full_name,email,password,phone_number)
 									VALUES('$name','$email','$hashed','$phone_number') ");
 			$_SESSION['success_flash'] = 'Welcome To Alchemy!';
 			header('Location: ../house_index.php');
 		}
 	}
 }
?>
   <link rel="stylesheet" type="text/css" href="../vendorSignUp/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../vendorSignUp/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="../vendorSignUp/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="../vendorSignUp/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="../vendorSignUp/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="../css/utilSignUp.css">
        <link rel="stylesheet" type="text/css" href="../css/mainSingUp.css">
 <body style="background-color: #999999;">
 	
 	<div class="limiter">
 		<div class="container-login100">
 			<div class="login100-more" style="background-image: url('../imagesSignUp/bg-01.jpg');"></div>

 			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
 				<form class="login100-form validate-form" action="register.php?register=1" method="post">
 					<span class="login100-form-title p-b-59">
 						Sign Up
 					</span>

 					<div class="wrap-input100 validate-input" data-validate="Name is required">
 						<span class="label-input100">Full Name</span>
 						<input class="input100" type="text" name="name" placeholder="Name...">
 						<span class="focus-input100"></span>
 					</div>

 					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
 						<span class="label-input100">Email</span>
 						<input class="input100" type="text" name="email" placeholder="Email addess...">
 						<span class="focus-input100"></span>
 					</div>

 					<div class="wrap-input100 validate-input" data-validate="Username is required">
 						<span class="label-input100">Phone Number</span>
 						<input class="input100" type="text" name="phone_number" placeholder="Phone...">
 						<span class="focus-input100"></span>
 					</div>

 					<div class="wrap-input100 validate-input" data-validate = "Password is required">
 						<span class="label-input100">Password</span>
 						<input class="input100" type="text" name="password" placeholder="*************">
 						<span class="focus-input100"></span>
 					</div>

 					<div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
 						<span class="label-input100">Repeat Password</span>
 						<input class="input100" type="text" name="confirm" placeholder="*************">
 						<span class="focus-input100"></span>
 					</div>

 					<div class="flex-m w-full p-b-33">
 						<div class="contact100-form-checkbox">
 							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
 							<label class="label-checkbox100" for="ckb1">
 								<span class="txt1">
 									I agree to the
 									<a href="#" class="txt2 hov1">
 										Terms of User
 									</a>
 								</span>
 							</label>
 						</div>

 						
 					</div>

 					<div class="container-login100-form-btn">
 						<div class="wrap-login100-form-btn">
 							<div class="login100-form-bgbtn"></div>
 							<button class="login100-form-btn" type="submit">
 								Sign Up
 							</button>
 						</div>

 						<a href="login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
 							Sign in
 							<i class="fa fa-long-arrow-right m-l-5"></i>
 						</a>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </body>
<?php 
include 'includes/footer.php';
 ?>




 	

 	

