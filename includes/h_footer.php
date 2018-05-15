<div class="container-fluid">
                   <div class="row">
                     <div class="col-md-6">
                       <span class="copyright">Copyright &copy;Alchemy_254 2018</span>
                     </div>
              
              <div class="col-md-6">
                <ul class="list-inline quicklinks">
                  <li class="list-inline-item">
                    <a href="#">Privacy Policy</a>
                  </li> 
                  <li class="list-inline-item">
                    <a href="#">Terms of Use</a>
                  </li>
                </ul>
              </div>

                 </div>
               </footer>
               <!-- Bootstrap core JavaScript -->
               <script src="vendor/jquery/jquery.min.js"></script>
               <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
               <script src="vendor/fotorama/fotorama.js"></script>
               <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                
               <!-- Plugin JavaScript -->
               <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

               <!-- Contact form JavaScript -->
               <script src="js/jqBootstrapValidation.js"></script>
               <script src="js/contact_me.js"></script>
               <!--google maps-->
              <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBL2b8pRnSTgSm8V0hmPJCFKm1tJ3vP2mk&callback=initMap">
              </script>
               <!-- Custom scripts for this template -->
               <script src="js/agency.min.js"></script>
               <script src="js/custom_js.js"></script>

               <!--about house modal-->
               <script>
                 function housemodal(id){
                  var data = {"id" : id};
                   
                  jQuery.ajax({
                    url : '/clothing_store/includes/housemodal.php',
                    method : "post",
                    data : data,
                    success : function(data){
                      jQuery('body').append(data);
                      jQuery('#houseinfo').modal('toggle');
                    },
                    error : function(){
                      alert("something went wrong");
                    }
                  });
                 }

                 
               </script>

               <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
      <!-- //js -->
      
      
      <!-- FlexSlider --> 
            <script defer src="js/jquery.flexslider.js"></script>
            <script type="text/javascript">
            $(window).load(function(){
              $('.flexslider').flexslider({
              animation: "slide",
              start: function(slider){
                $('body').removeClass('loading');
              }
              });
            });

            
            </script>
      <!-- End-slider-script -->
      
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".scroll").click(function(event){   
      event.preventDefault();
      $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
  });
</script>
<!-- start-smoth-scrolling -->
<!-- start-smoth-scrolling -->
      
<!--responsive tabs -->

               <script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});

});
</script>
<!-- // responsive tabs -->
 
 <script type="text/javascript">
              $(window).load(function() {
                $("#flexiselDemo1").flexisel({
                  visibleItems:3,
                  animationSpeed: 1000,
                  autoPlay: true,
                  autoPlaySpeed: 3000,        
                  pauseOnHover: true,
                  enableResponsiveBreakpoints: true,
                  responsiveBreakpoints: { 
                    portrait: { 
                      changePoint:480,
                      visibleItems: 1
                    }, 
                    landscape: { 
                      changePoint:640,
                      visibleItems:2
                    },
                    tablet: { 
                      changePoint:768,
                      visibleItems: 3
                    }
                  }
                });
                
              });
          </script>
          <script type="text/javascript" src="js/jquery.flexisel.js"></script>
          
          
 <!-- Popup-Box-JavaScript -->
    <script src="js/modernizr.custom.97074.js"></script>
    <script src="js/jquery.chocolat.js"></script>
    <script type="text/javascript">
      $(function() {
        $('.gallery-item a').Chocolat();
      });
    </script>
    <!-- //Popup-Box-JavaScript -->
  <!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
    <script type="text/javascript">
      $(document).ready(function() {
        var defaults = {
          containerID: 'toTop', // fading element id
          containerHoverID: 'toTopHover', // fading element hover id
          scrollSpeed: 100,
          easingType: 'linear'
        };
      });
    </script>
    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
    <!-- //Slide-To-Top JavaScript -->

    
  <!-- smooth scrolling -->
  <script type="text/javascript">
    $(document).ready(function() {              
    $().UItoTop({ easingType: 'easeOutQuart' });
    });
  </script>
  <!-- contact -->
<script type="text/javascript">
  jQuery(function($) {'use strict',

              var form = $('.contact-form');alert("here at house footer");
              form.submit(function () {'use strict',
                $this = $(this);
                $.post("sendemail.php", $(".contact-form").serialize(),function(result){
                  if(result.type == 'success'){
                    $this.prev().text(result.message).fadeIn().delay(3000).fadeOut();
                  }
                });
                return false;
              });

            });
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js_home/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js_home/popper.min.js"></script>
<script src="js_home/bootstrap.min.js"></script>
<!-- Rev slider js -->
<script src="vendors_home/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="vendors_home/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="vendors_home/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<!-- Extra plugin css -->
<script src="vendors_home/counterup/jquery.waypoints.min.js"></script>
<script src="vendors_home/counterup/jquery.counterup.min.js"></script>
<script src="vendors_home/counterup/apear.js"></script>
<script src="vendors_home/counterup/countto.js"></script>
<script src="vendors_home/owl-carousel/owl.carousel.min.js"></script>
<script src="vendors_home/parallaxer/jquery.parallax-1.1.3.js"></script>


<script src="js_home/theme.js"></script>

    </body>

</html>