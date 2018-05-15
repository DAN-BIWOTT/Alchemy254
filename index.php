<?php
 require_once 'core/init.php';
 include 'includes/head.php';
 include 'includes/navigation.php';
 include 'includes/headerfull.php';
 include 'includes/leftsidebar.php';

 $sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0";
 $featured = $db->query($sql);

 $sql2 = "SELECT * FROM products WHERE featured = 0";
 $notfeatured = $db->query($sql2);
?>         
    <!-- Services --> 
    
      	<!--left sidebar-->
      	
      	<!--mid content-->     
          <div class="col-md-10 text-center features_items left-sidebar" id="index-position" style="padding-top: 45px;">
          		<h2 class=" text-uppercase title">Products In Stock</h2>
          	<div class="row">
            <?php while($product = mysqli_fetch_assoc($featured)) : ?>
            	<div class="col-md-4 ">
            		<h4 style="color: black" class="title"><?php echo $product['title']; ?></h4>
                <?php $photos = explode(',', $product['image']) ;?>
            <div class="portfolio-item">
               <a class="portfolio-link "onclick="detailsmodal(<?php echo $product['id']; ?>)">
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      
                    </div>
                  </div> 
                    <figure class="figure">
                    <img style="width: 300px;height: auto;" src="<?php echo $photos['0']; ?>" class="figure-img img-fluid rounded img-thumb" alt="<?php echo $product['title']; ?>">
                    <figcaption class="figure-caption list-price text-danger">List Price : <s>KSh. <?php echo $product['list_price'];?></s></figcaption>
                  </figure>
                </a>
            </div>
            		<p class="price">Our Price : KSh.<?php echo $product['price']; ?></p>
            	</div>
			<?php endwhile; ?>            	
            </div>           
          </div>
<?php include 'includes/rightsidebar.php' ;?>
        </div>		
      </div>
    </section>

    <!-- not featured -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">what would you love for us to have in stock next Month?</h2>
            <h3 class="section-subheading text-muted">Help us offer better products.</h3>

         </div>
       </div>
         </div>
         <div class="container-fluid">   
             <div class="col-md-9">
              <div class="row" > 
               <?php while($absentproduct = mysqli_fetch_assoc($notfeatured)) : ;?>
            <div class="col-md-3">

              <figure class="figure">
                <?php
                $photos = explode(',', $absentproduct['image']);
                ?>
                <img src="<?php echo $photos[0]; ?>" class="figure-img img-fluid rounded img-thumb" alt="Next Month's products">
                <figcaption class="figure-caption text-right"></figcaption>
              </figure>
                    <div class="portfolio-caption">
                      <h4><?php echo $absentproduct['title']; ?></h4>
                      <p class="text-muted">Price : KSh. <?php echo $absentproduct['price']; ?> </p>
                     <button class="btn button-sm btn-outline-primary" onclick="thumbs_count(<?=$absentproduct['id']?>,1)"><span  class="badge badge-primary"><?=$absentproduct['likes']?></span></button>
                     <button type="button" class="btn button-sm btn-outline-danger" onclick="thumbs_count(<?=$absentproduct['id']?>,0)"><span id="thumb"  class="badge badge-danger"><?=$absentproduct['dislikes']?></span></button>
                    </div>
                    </div>
                <?php endwhile; ?> 
             </div>      
        </div>
       <div class="col-md-12">
         
       </div>
      </div>
    
      
        <?php
         include 'includes/team.php' ;
         include 'includes/footer.php' ;
         
        ?>
  	<!--details modal-->	
    <!-- upcoming products modal -->

   
