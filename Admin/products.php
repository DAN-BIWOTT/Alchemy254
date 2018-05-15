<?php   

require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';
if (!is_logged_in()) {
	login_error_redirect();
} 
if (!has_permission('admin') || !has_permission('editor')) {
	permission_error_redirect('index.php');

}

include  'includes/head.php'; 
include 'includes/navigation.php';

//delete product
if (isset($_GET['delete'])) {ob_start();
	$id = sanitize($_GET['delete']);
	$db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE products SET date_deleted = '$date' WHERE id = '$id' ");
	header('Location:products.php');ob_get_clean();

}

$dbpath = '';

if (isset($_GET['add'])|| isset($_GET['edit'])) {

	$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
	$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY categories");
	$title = ((isset($_POST['title']) && $_POST['title'] != '')? sanitize($_POST['title']):'');
	$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))? sanitize($_POST['brand']) :'');
	$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))? sanitize($_POST['parent']) :'');
	$category = ((isset($_POST['child']) && !empty($_POST['child']))? sanitize($_POST['child']) : ' ');
	$price = ((isset($_POST['price']) && $_POST['price'] != '')? sanitize($_POST['price']):'');
	$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')? sanitize($_POST['list_price']):'');
	$description = ((isset($_POST['description']) && $_POST['description'] != '')? sanitize($_POST['description']):'');
	$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')? sanitize($_POST['sizes']):'');
	$sizes = rtrim($sizes,',');
	$saved_image = '';

	if(isset($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];
		$productResults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
		$product = mysqli_fetch_assoc($productResults);
		if (isset($_GET['delete_image'])) {			
			$imgi = (int)$_GET['imgi'] - 1;
			$images = explode(',', $product['image']);
			$image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
			unlink($image_url);
			unset($images[$imgi]);
			$imageString = implode(',', $images);
			$db->query("UPDATE products SET image = '{$imageString}' WHERE id = '$edit_id'");
			header('Location: products.php?edit='.$edit_id);
		}
		$category = ((isset($_POST['child']) && $_POST['child'] != '')? sanitize($_POST['child']) : $product['categories']);
		$title = ((isset($_POST['title']) && !empty($_POST['title']))?sanitize($_POST['title']):$product['title']);
		$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):$product['brand']);
		$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
		$parentResult = mysqli_fetch_assoc($parentQ);
		$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):$parentResult['parent']);
		$price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):$product['price']);
		$list_price = ((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
		$description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
		$sizes = ((isset($_POST['sizes']) && !empty($_POST['sizes']))?sanitize($_POST['sizes']):$product['sizes']);
		$sizes = rtrim($sizes,',');
		$saved_image = (($product['image'] != '')?$product['image'] : '');
		$dbpath = $saved_image;
	}

	$sizesArray = array();
	if (!empty($sizes)) {
		$sizeString = sanitize($sizes);
		$sizeString = rtrim($sizeString,',');
		$sizesArray = explode(',',$sizeString);
		$sArray = array();
		$qArray = array();
		$tArray = array();
		foreach ($sizesArray as $ss) {
			$s = explode(':', $ss);
			$sArray[] = $s[0];
			$qArray[] = $s[1];
			$tArray[] = $s[2];
		}
	}else{$sizesArray = array();}

	if($_POST){		
		
		$errors = array();
		$required = array('title','brand','price','parent','child','sizes');
		$allowed = array('png','jpg','jpeg','gif');
		$updloadPath = array();
		$tmpLoc = array();
		foreach($required as $field){
			if($_POST[$field] == ''){
				$errors[] = 'All fields with an Asterik are required';
				$_FILES = '';
				break;
			}
		}
		$r=array();
	if ($_FILES != $r) {
		
		$photoCount = count($_FILES['photo']['name']);
		 if ($photoCount > 0) {
			for($i = 0;$i < $photoCount; $i++){
			 	$name = $_FILES['photo']['name'][$i];
			 	$nameArray = explode('.', $name);
			 	$fileName = $nameArray[0];
			 	$fileExt = $nameArray[1];
			 	$mime = explode('/', $_FILES['photo']['type'][$i]);
			 	$mimeType = $mime[0];
			 	$mimeExt = $mime[1];
			 	$tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
			 	$fileSize = $_FILES['photo']['size'][$i];
			 	$updloadName = md5(microtime().$i).'.'.$fileExt;
			 	$updloadPath[] = BASEURL.'img/products/'.$updloadName;
			 	if ($i != 0) {
			 		$dbpath .= ',';
			 	}
			 	$dbpath .= '/clothing_store/img/products/'.$updloadName;

				if($mimeType != 'image'){
					$errors[] = 'The file must be an image.';
				}
				if (!in_array($fileExt, $allowed)) {
					$errors[] = 'The file extension must be a png, jpeg, jpg of gif.';
				}
				if ($fileSize > 25000000) {
					$errors[] = 'the file size must be under 25mb';
				}
				if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
					$errors[] = 'file extension does not match the file';
				}
			}
			if (empty($errors)) {
				for ($i=0; $i < $photoCount; $i++) { 
				move_uploaded_file($tmpLoc[$i], $updloadPath[$i]);
			}
		}
	}

		if(!empty($errors)){
			echo display_errors($errors);
		}
			
			$insertSql ="INSERT INTO products(title,price,list_price,brand,categories,sizes,image,description)
												 VALUES ('$title','$price','$list_price','$brand','$category','$sizes','$dbpath','$description')";
			if (isset($_GET['edit'])) {
				$insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand = '$brand',categories = '$category', sizes = '$sizes', image = '$dbpath', description = '$description' WHERE id = '$edit_id' ";
			}
			$db->query($insertSql);
			header('Location: products.php');

		}
	}

		
		
?>
								<h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit':'Add A New'); ?> Product</h2><hr>
<!--Editing the product-->
		<form class="container-fluid row" action="products.php?<?= ((isset($_GET['edit']))?'edit='.$edit_id:'add=1') ?>" method="POST" enctype="multipart/form-data">

			<div class="col-md-3">
				<div class="form-group">
					<label for="title">Title*:</label>
					<input type="text" name="title" id="title" class="form-control" value="<?=((isset($_GET['edit']))?$title:'')  ; ?>">
				</div>
			</div>		
				<div class="form-group col-md-3" >
					<label for="brand">Brand*: </label>
					<select class="form-control" id="brand" name="brand">
						<option value=""<?= ($brand == '')?' selected':''; ?> ></option>
						<?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
								<option value="<?= $b['id'] ;?>"<?= (($brand == $b['id'])?' selected':'');?>> <?= $b['brand'] ;?> </option>

						<?php endwhile; ?>
					</select>
				</div>
			<div class="col-md-3">
				<div class="form-group">
				<label for="parent">Parent Category</label>
				<select class="form-control" id="parent" name="parent">
					<option value="" <?= (($parent == '')? ' selected':'');?>></option>
					<?php while ($p = mysqli_fetch_assoc($parentQuery)):  ?>
						<option value="<?= $p['id'];?>"<?= (($parent == $p['id'])?' selected':'');?>><?=$p['categories'];?>
						</option>
					<?php endwhile;?> 
				</select>
		    </div>
			</div>
			

			<div class="form-group col-md-3">
				<label for="child">Child Categories*:</label>
				<select id="child" name="child" class="form-control">
					
				</select>
			</div>
			
			<div class="form-group col-md-3">
				<label for="price">Price*:</label>
				<input type="text" name="price" id="price" class="form-control" value="<?=$price;?>">
			</div>
			<div class="form-group col-md-3">
				<label for="list_price">List Price:</label>
				<input type="text" name="list_price" id="list_price" class="form-control" value="<?= $list_price;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label>Quantity & Sizes</label>
				<a class="btn btn-outline-success form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</a>
			</div>
			<div class="form-group col-md-3">
				<label for="sizes">Sizes & Quantity Preview</label>
				<input type="text" class="form-control" name="sizes" id="sizes" value="<?= $sizes ?>" readonly>
			</div>

			<div class="form-group col-md-6">
				<?php if($saved_image != ''): ?>
					<?php
					$imgi = 1;
					$images = explode(',', $saved_image);?>
					<div class="row">
					<?php foreach($images as $image):?> 
					 <div class="saved-image col-md-4">
						<img src="<?= $image ;?>" alt="saved_image">
						<a href="products.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Delete image</a>
					 </div>									
				<?php
				$imgi++;
				 endforeach ;?>
				 </div>
				<?php else: ?>
					<label for="photo">Product Photo</label>
					<input type="file" name="photo[]" id="photo" class="form-control" multiple>
			<?php endif ;?>
			</div>
			<div class="form-group col-md-6">
				<label for="description">Description</label>
				<textarea id="description" name="description" class="form-control" rows="6"><?= $description; ?></textarea>
			</div>
			<div class="col-md-9"></div>
			<div class="form-group col-md-3">
				<a href="products.php" class="btn btn-outline-success">CANCEL</a>
				<input type="submit" name="" value="<?= ((isset($_GET['edit']))?'Edit':'Add') ;?>Product" class=" btn btn-info btn-info">
			</div>
		</form>
		<!-- Modal -->
		<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="sizesModalLabel">Size & Quantity</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        	<div class="container-fluid">
		        		<div class="row">
		        <?php for($i = 1; $i<=12; $i++): ?>			
			      			<div class="form-group col-md-2">
								<label for="size<?=$i;?>">Size:</label>
								<input type="text" name="size<?=$i?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
							</div>
							<div class="form-group col-md-2">
								<label for="qty<?=$i;?>">Quantity:</label>
								<input type="number" name="qty<?=$i?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" max="9" class="form-control">
							</div>
							<div class="form-group col-md-2">
								<label for="threshold<?=$i;?>">Threshold:</label>
								<input type="number" name="threshold<?=$i?>" id="threshold<?=$i;?>" value="<?=((!empty($tArray[$i-1]))?$tArray[$i-1]:'');?>" min="0" class="form-control">
							</div>
				<?php endfor; ?>			
		        		</div>
		        	</div>
					
		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-info" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

		
		

<?php 	}else{

$p_sql = "SELECT * FROM products WHERE deleted = 0";
$p_result = $db->query($p_sql);
//changing products to featured or not featured
if (isset($_GET['featured'])) {
	$id = (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featured_sql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featured_sql);
	header('Location: products.php');
}


 ?>
<!--MAIN PRODUCTS PAGE-->
 <h2 class="text-center">Products</h2>
 <a href="products.php?add=1" class="btn btn-success pull-right Add_button" id="add-product-btn">Add Product</a><div class="clear-fix"></div>
 <button type="button" class="btn btn-primary Add_button_left" data-toggle="modal" data-target="#archives_modal">
   Archieves
 </button><hr>

<table class="table table-bordered table-condensed table-striped">
	<thead>
		<th></th> <th>Products</th> <th>Price</th> <th>Category</th> <th>Featured</th> <th>Sold</th>
	</thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($p_result)): 
			//quering the parent and child objects for the category column
			$child_id = $product['categories'];
			$child_id = (int)$child_id;
			$child_sql = "SELECT * FROM categories WHERE id = '$child_id' ";   
			$child_result = $db->query($child_sql);
			$child = mysqli_fetch_assoc($child_result);
			$parent_id = $child['parent'];
			$parent_id = (int)$parent_id;
			$parent_sql = "SELECT * FROM categories WHERE id = '$parent_id' ";
			$parent_result = $db->query($parent_sql);
			$parent = mysqli_fetch_assoc($parent_result);
			$category = $parent['categories'].'~'.$child['categories'];
		?>
		<tr>
			<td>
			<a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-outline-success">edit<span class="glyphicon glyphicon-pencil"></span></a>
			<a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-outline-primary">archive<span class="glyphicon glyphicon-pencil"></span></a>
		</td>
		<td><?= $product['title']; ?></td>
		<td><?= money($product['price']);?></td>
		<td><?= $category ;?></td>
		<td><a href="products.php?featured=<?= (($product['featured'] == 0) ? '1':'0');?>&id=<?= $product['id']; ?> " class="btn btn-xs btn-outline-danger"><span class="glyphicon glyphicon-<?= (($product['featured'] == 0)?'minus':'plus'); ?>"></span></a>&nbsp <?= (($product['featured'] == 0)?'NO':'YES'); ?></td>
		<td></td>
		</tr>
		
	<?php endwhile; ?>
	</tbody>
</table>

	<?php 
	$archive_sql = $db->query("SELECT * FROM products WHERE deleted = 1 ");
	$archives = mysqli_fetch_assoc($archive_sql);


	

	if (isset($_GET['restore']) && !empty($_GET['restore'])) {
		$R_id = (int)$_GET['restore'];
		$R_id = sanitize($R_id);
		$restore_sql = $db->query("UPDATE products SET deleted = 0 WHERE id= '$R_id' ");
	}

	;?>
<!-- Archives Modal -->
<div class="modal fade" id="archives_modal" tabindex="-1" role="dialog" aria-labelledby="archivesModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Archives</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-striped">
         <thead class="thead-dark">
           <tr>
             <th scope="col">#</th>
             <th scope="col">Product</th>
             <th scope="col">Date Archived</th>
             <th scope="col">Category</th>
           </tr>
         </thead>
         <tbody>
           <?php while($archives = mysqli_fetch_assoc($archive_sql)): ?>
	           <tr>
	             <th scope="row"><a href="products.php?restore=<?= $archives['id']?>" class="btn btn-sm btn-outline-success">Restore<span class="glyphicon glyphicon-recycle"></span></a></th>
	             <td><?= $archives['title']; ?></td>
	             <td><?= $archives['date_deleted'];?></td>
	             <?php
	             	$archives_cat_id = (int)$archives['categories'];
	             	$archives_cat_id = sanitize($archives_cat_id);
	             	$archives_cat_sql = $db->query("SELECT * FROM categories WHERE id = '$archives_cat_id' ");
	             	$archives_cat = mysqli_fetch_assoc($archives_cat_sql);
	             ?>
	             <td><?= $archives_cat['categories'];?></td>
	           </tr>
           <?php endwhile ; ?>
         </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




 <?php }
include_once 'includes/footer.php';
  ?>
  <script>
  	jQuery('document').ready(function(){
  		get_child_options('<?=$category;?>')
  	});
  </script>
