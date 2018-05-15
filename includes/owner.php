<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
include 'ownerHead.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';

$locationQ = $db->query("SELECT * FROM house WHERE state = 'paid' ");
$house = mysqli_fetch_assoc($locationQ);
if (isset($_GET['owner'])) {
	$h_id =sanitize((int)$_GET['owner']);
    $hmodalsql = $db->query("SELECT * FROM house WHERE id = '$h_id'");
    $hmodal = mysqli_fetch_assoc($hmodalsql);
	$owner_id = $hmodal['owner_id'];

$ownerQ = $db->query("SELECT * FROM users WHERE id = '{$owner_id}' ");
$ownerR = mysqli_fetch_assoc($ownerQ);

}
?>
<body class="animsition">
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0&appId=2045966109004761&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
				</div>

				

				<div class="topbar-child2">
					<span class="topbar-email">
						<?=$ownerR['email'];?>
					</span>
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="../index.php" class="logo">
					<img src="../images/icons/5.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="../index.php">Home</a>
							</li>

							<li>
								<a href="../blogIndex.php">Blog</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="../#contact">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<a href="../Admin/login.php" class="header-wrapicon1 dis-block">Log In
						<img src="../images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					
				</div>
			</div>
		</div>
		
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(../images/contact_background.jpg);">
		<h2 class="l-text2 t-center">
			Owner Details
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="<?=$ownerR['picture'];?>" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">
						Owner Complete Info
					</h3>

					<p class="p-b-28">
						<table class="table table-condensed table-striped">
							<tbody>
								<tr>
									<td>NAME</td>
									<td><?=$ownerR['full_name']?></td>
								</tr>
								<tr>
									<td>PHONE NUMBER</td>
									<td><?=$ownerR['phone_number'];?></td>
								</tr>
								<tr>
									<td>EMAIL</td>
									<td><?=$ownerR['email'];?></td>
								</tr>
							</tbody>
						</table>
					</p>

					<div class="bo13 p-l-29 m-l-9 p-b-10">
						<p class="p-b-11">
							<?=$ownerR['description'];?>
						</p>

						<span class="s-text7">
							<?=$ownerR['full_name'];?>
						</span>
					</div>

					<div class="col-md-12">
						<h3 class="m-text26 p-t-15 p-b-16">
							House Complete Info
						</h3>
						<div class="row">
						<ul class="list-group col-md-6">
						  <li class="list-group-item"><i class="fa fa-money"></i><b> Rent : </b><?= money($hmodal['rent']);?> monthly</li>
						  <li class="list-group-item"><i class="fa fa-calendar-o"></i> <b>Date Available : </b><?= $hmodal['date_available']; ?> </li>
						</ul>
						<ul class="list-group col-md-6">
						  <li class="list-group-item"><i class="fa fa-bed"></i> <b>Number Of Rooms : </b><?= $hmodal['num_rooms']; ?> </li>
						  <li class="list-group-item"><b><i class="fa fa-tint"></i> Water : </b><?= (($hmodal['water'] == 1)?'Available':'Not Available'); ?> </li>
						</ul>
						<ul class="list-group col-md-6" style="margin-top: 12px;">
						  <li class="list-group-item"><b><i class="fa fa-lightbulb-o"></i> Electricity : </b><?= (($hmodal['electricity'] == 1)?'Available':'Not Available'); ?> </li>
						  <li class="list-group-item"><b><i class="fa fa-shower"></i> Shower :</b><?= (($hmodal['shower'] == 1)?'hot':'cold'); ?> </li>
						</ul>
						<ul class="list-group col-md-6" style="margin-top: 12px;">
						  <li class="list-group-item"><i class="fa fa-toilet-sign"></i><b>Plumbing : </b><?= (($hmodal['plumbing'] == 1)?'internal':'external'); ?> </li>
						  <li class="list-group-item"><i class="fa fa-location-arrow"></i> <b>Location : </b><?= $hmodal['location'] ?> </li>
						</ul>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Slide2 -->
			<div class="col-md-12">
				<div class="wrap-slick2">
					<div class="slick2">
							<?php $photos = explode(',', $hmodal['photo']);
							foreach ($photos as $photo): ?> 
						<div class="item-slick2 p-l-15 p-r-15">
							<!-- Block2 -->
							<div class="block2"">
								<div class="block2-img wrap-pic-w of-hidden">	                   				           
								<img src="<?=$photo;?>" alt="A caption of the house." style="width:300px;height: 250px;" class="details img-responsive rounded">                                       							          
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>	
				</div> 
			</div>	
			</div>
		</div>
	</section>
	
		<div class="map" id="map">
		<ul class="faq">
			<li class="item1"><button class="btn btn-info bg_btn" onclick="directMe(<?=$house['latitude'];?>,<?=$house['longitude'];?>);">Route Map<span class="glyphicon glyphicon-menu-down"></span></button>
				<ul>
					<li class="subitem1" id="map">
						
					</li>										
				</ul>
			</li>
		</ul>
	</div>
	
	
	
	





<?php
include 'ownerFooter.php';
 include '../js/owner.js' ;?>

</body>
</html>
