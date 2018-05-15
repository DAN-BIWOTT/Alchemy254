
<?php
 require_once 'core/init.php';
 include 'includes/head.php';
 include 'includes/navigation.php';
 include 'includes/headerpartial.php'; 
 include 'includes/leftsidebar.php';


$sql = "SELECT * FROM products";
$cat_id = (($_POST['cat'] != '')?sanitize($_POST['cat']):'');
if ($cat_id == '') {
	$sql .= " WHERE deleted = 0";
}else{
	$sql .= " WHERE categories = '{$cat_id}' AND deleted = 0 ";
}

$price_sort = (($_POST['price_sort'] != '')?sanitize($_POST['price_sort']):'');
$min_price = (($_POST['min_price'] != '')?sanitize($_POST['min_price']):'');
$max_price = (($_POST['max_price'] != '')?sanitize($_POST['max_price']):'');
$brand = (($_POST['brand'] != '')?sanitize($_POST['brand']):'');

if ($min_price != '') {
	$sql .= " AND price >= '{$min_price}'";
}

if ($max_price != '') {
	$sql .= " AND price <= '{$max_price}'";
}

if ($brand != '') {
	$sql .= " AND brand = '{$brand}'";
}

if ($price_sort == 'low') {
	$sql .= " ORDER BY price";
}

if ($price_sort == 'high') {
	$sql .= " ORDER BY price DESC";
}

$productQ = $db->query($sql);
$category = get_category($cat_id);
?>         
		<!-- Services -->
		
				<!--left sidebar-->
				   
				<!--mid content-->     
					<div class="col-md-10 text-center">
						<?php if($cat_id != '') :?>
							<h2 class="section-heading text-uppercase"><?=$category['parent'].' '.$category['child'];?></h2>
						<?php else : ?>
							<h2 class="text-center">Alchemy_254 Products</h2>
						<?php endif; ?>
						<div class="row">
						<?php while($product = mysqli_fetch_assoc($productQ)) : ?>
							<div class="col-md-4">
								<h2 class="title text-info"><?php echo $product['title']; ?></h2>
								<?php $photos = explode(',', $product['image']) ;?>
								<img style="width: 300px;height: 300px;" class="img-thumb" src=" <?php echo $photos[0]; ?>" alt="<?php echo $product['title']; ?>" />
								<p class="list-price text-danger">List Price : <s>KSh. <?php echo $product['list_price'] ?>;</s></p>
								<p class="price">Our Price : KSh.<?php echo $product['price']; ?></p>
								<button type="button" class="button button-sm btn-success" onclick="detailsmodal(<?php echo $product['id']; ?>)">Details</button>
							</div>
			<?php endwhile; ?>              
						</div>           
					</div>
						<!-- <div class="col-md-2" style="float: right;">
								<h5>right side bar</h5>                                    
						</div>  -->
				</div>    
			</div>
		</section>                 					

		<!-- Team -->

		<section class="bg-light" id="team">
			<?php include 'includes/team.php' ;?>
		</section>
				<?php
				 include 'includes/footer.php' ;
				?>
		<!--details modal-->  
		<!-- upcoming products modal -->

	 
