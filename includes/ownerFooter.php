	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? Let us know in KABARAK BARINGO HOSTEL, MAIN CAMPUS, NAKURU,or call us on (+254) 75 352 5665
					</p>

					<div class="flex-m p-t-30">
						<button href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
				</div>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form action="../mail/contact_me.php" method="post">
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>
				</form>
			</div>
			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
<div class="fb-comments" data-href="http://alchemy254.com/clothing_store/includes/owner.php?owner=<?=$h_id;?>" data-width="500" data-numposts="5"></div>
			</div>
		

		</div>

	</footer>
		<script type="text/javascript">

			function directMe(lat,long){
	        var chicago = {'lat':lat,'long':long};
	         var endPoint  = new google.maps.LatLng(lat,long);

	        navigator.geolocation.getCurrentPosition(initMap);
	           var directionsService = new google.maps.DirectionsService();
	          var directionsDisplay = new google.maps.DirectionsRenderer();  

	        function initMap(location) {
	         
	          var S_lat = location.coords.latitude;
	          var S_long = location.coords.longitude;
	          var myLocation = new google.maps.LatLng(S_lat,S_long);

	          var mapOptions = {
	            zoom:20,
	            center: endPoint,
	          }
	          var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	          directionsDisplay.setMap(map);
	          calcRoute(myLocation);
	        }

	        function calcRoute(myLocation) {
	          var start = myLocation;
	          var end = endPoint;
	          var request = {
	            origin: start,
	            destination: end,
	            travelMode: 'WALKING'
	          };
	          directionsService.route(request, function(result, status) {
	            if (status == 'OK') {
	              directionsDisplay.setDirections(result);
	            }
	          });
	        }
	}
		</script>
	  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2BcebWS9vgTszBmTpM4kY6kQDl8T91Ic&callback=initMap"
	    async defer></script>
		<!-- Footer -->


	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>
