<?php
require_once '../core/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Thank You!</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/contact_responsive.css">
<link rel="stylesheet" type="text/css" href="../fonts/CallingAngelsPersonalUse.ttf">
</head>

<body>

<div class="super_container">
	<header class="header">
		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
						<div class="logo_container">
							<div class="logo"><a href="#"><img style="margin-left: -100px;max-height: 150px" src="../images/icons/4.png" alt="IMG-LOGO"></a></div>
						</div>
						<div class="main_nav_container ml-auto col-md-8">
							<H2><p class="text-center text-white" style="font-size: 40px;font-family: CallingAngelsPersonalUse;">Alchemy 254</p></H2>
						</div>																					
					</div>
				</div>
			</div>	
		</nav>
	</header>

	<div class="contact_form_section" style="margin-top: 70px;">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Contact Form -->
					<div class="contact_form_container">
						<div class="contact_title text-center"></div>
						<div class="jumbotron" style="background-color: transparent;">
						  <h1 class="display-5 text-white">We Are Sorry!</h1>
						  <p class="lead text-center text-white ">Transaction was unsuccessful! </p>
						  <hr class="my-4">
						  <p>The transaction failed because the total doesn't equal the amount you sent. Please contact us for manual check up.</p>
						  <a class="btn btn-primary btn-lg" href="../index.php" role="button">Home</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- About -->
	<div class="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					
					<!-- About - Image -->

					<div class="about_image">
						<img src="images/man.png" alt="">
					</div>

				</div>

				<div class="col-lg-4">
					
					<!-- About - Content -->

					<div class="about_content">
						<div class="logo_container about_logo">
							<div class="logo"><a href="#"><img src="images/logo.png" alt="">Alchemy 254</a></div>
						</div>
						<p class="about_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis vu lputate eros, iaculis consequat nisl. Nunc et suscipit urna. Integer eleme ntum orci eu vehicula iaculis consequat nisl. Nunc et suscipit urna pretium.</p>
						<ul class="about_social_list">
							<li class="about_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
						</ul>
					</div>

				</div>

				<div class="col-lg-3">
					
					<!-- About Info -->

					<div class="about_info">
						<ul class="contact_info_list">
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/placeholder.svg" alt=""></div></div>
								<div class="contact_info_text">Kabarak University; Baringo</div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/phone-call.svg" alt=""></div></div>
								<div class="contact_info_text">+254-753-525-665</div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/message.svg" alt=""></div></div>
								<div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Hello" target="_top">Alchemy254@gmail.com</a></div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/planet-earth.svg" alt=""></div></div>
								
							</li>
						</ul>
					</div>

				</div>

			</div>
		</div>
	</div>

</div>

<script src="../styles/bootstrap4/popper.js"></script>
<script src="../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../plugins/parallax-js-master/parallax.min.js"></script>

</body>
<footer>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-bottom">
  <div class="col-md-4">
            <p>Copyright &copy;Alchemy_254 2018</p>
  </div>
</nav>
</footer>
</html>