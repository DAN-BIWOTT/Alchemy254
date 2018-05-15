
<?php
 require_once 'core/init.php';
 include 'includes/head.php';
 include 'includes/navigation.php';
 include 'includes/headerpartial.php';
 include 'includes/leftsidebar.php';

if (isset($_GET['cat'])) {
	$cat_id = sanitize($_GET['cat']);
}else{ 
	$cat_id = '';
}

 $sql = "SELECT * FROM products WHERE categories = '$cat_id' AND deleted = 0";
 $productQ = $db->query($sql);
$category = get_category($cat_id);
?>         
        
          <div class="col-md-10 text-center">
          		<h2 class="section-heading text-uppercase"><?=$category['parent'].' '.$category['child'];?></h2>
          	<div class="row">
            <?php while($product = mysqli_fetch_assoc($productQ)) : ?>
            	<div class="col-md-4">
            		<h2 class="title text-info"><?php echo $product['title']; ?></h2>
                 <?php $photos = explode(',', $product['image']) ;?>
            		<img style="width: 300px;height: 300px;" class="img-thumb rounded-top" src=" <?php echo $photos['0']; ?>" alt="<?php echo $product['title']; ?>" />
            		<p class="list-price text-danger">List Price : <s>KSh. <?php echo $product['list_price'] ?>;</s></p>
            		<p class="price">Our Price : KSh.<?php echo $product['price']; ?></p>
            		<button type="button" class="button button-sm btn-success" onclick="detailsmodal(<?php echo $product['id']; ?>)">Details</button>
            	</div>
			<?php endwhile; ?>            	
            </div>           
          </div>
           <!--  <div class="col-md-2" style="float: right;">
                <h5>right side bar</h5>                                    
            </div> --> 
        </div>		
      </div>
    </section>


    <!-- Team -->
    <section class="bg-light" id="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Alchemy 254 Team</h2>
            <h3 class="section-subheading text-muted">Where All Your Needs Are Met!</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="img/team/1.jpg" alt="">
              <h4>Dennis</h4>
              <p class="text-muted">Co-founder</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="img/team/2.jpg" alt="">
              <h4>Adams</h4>
              <p class="text-muted">Founder</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="img/team/3.jpg" alt="">
              <h4>Biwott</h4>
              <p class="text-muted">Employee</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Life Made Easier!</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Draco Dormiens Nunquam Titillandus..</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" action="mail/contact_me.php" validate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name... *" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email... *" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone Number... *" required data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message... *" required data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-outline-info btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        <?php
         include 'includes/footer.php' ;
         
        ?>
  	<!--details modal-->	
    <!-- upcoming products modal -->

   
