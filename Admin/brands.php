<?php 
require_once '../core/init.php';
if (!is_logged_in()) {
	login_error_redirect();
}
if (!has_permission('admin') || !has_permission('editor')) {
	permission_error_redirect('index.php');

}
require_once 'includes/head.php';
require_once 'includes/navigation.php';
//get brands from data base
$sql = "SELECT * FROM brand ORDER BY brand";
$result = $db->query($sql);
$errors = array();
//edit brand
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	
	$sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
	$edit_result = $db->query($sql2);
	$ebrand = mysqli_fetch_assoc($edit_result);
}

//delete brand
ob_start();
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	
	$sql = "DELETE FROM brand WHERE id = '$delete_id'";
	$db->query($sql);
	header('Location: brands.php');
	ob_get_clean();
}
//if add form is submited
if(isset($_POST['add_submit'])){
	$brand = sanitize($_POST['brand']);
//check if brand is blank
	if($_POST['brand'] == ''){
		$errors[].='you must enter a brand';
	}
	//check if brand exists in data base
	$sql = "SELECT * FROM brand WHERE brand = '$brand'";

	if (isset($_GET['edit'])) {
		$sql = "SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id'";
	}
	$result_brand = $db->query($sql);
	$count = mysqli_num_rows($result_brand);
	if ($count > 0) {
		$errors[] .= $brand.' Already Exists. Please Chose Another Brand Name...';
	}

	//display errors
	if(!empty($errors)){
		echo display_errors($errors);
	}
	else{
		//add brand to data base
		
		$sql = "INSERT INTO brand(brand) VALUES ('$brand')";
			if (isset($_GET['edit'])) {
				$sql = "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id'"; 
			}
		$db->query($sql);
		
	}
}
?>


<h2 class="text-center">Brands</h2><hr>
<!--Brand form-->
	
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="text-center">
				<form class="form-inline" action="brands.php<?=((isset($_GET['edit']))? '?edit='.$edit_id :'');?>" method="post">
					<div class="form-group">
						<?php
							$brand_value = '';
						 if (isset($_GET['edit'])) {
							$brand_value = $ebrand['brand'];
						}else{
							if (isset($_POST['brand'])) {
								$brand_value = sanitize($_POST['brand']);
							}
						}
						;?>
						<label for="brand"><b> <?= ((isset($_GET['edit']))? 'Edit' : 'Add A') ;?> Brand: </b></label>
						<input type="text" name="brand" id="brand" class="form-control" value="<?= $brand_value ; ?>">

						<?php if (isset($_GET['edit'])): ?> 
							<a href="brands.php" class="btn btn-default">Cancel</a>
						<?php endif;?>
						 
						<input type="submit"  name="add_submit" value="<?= ((isset($_GET['edit']))? 'Edit':'Add') ;?> Brand" class="btn btn-success" style="margin-left: 20px;">
					</div>
				</form>
			</div>
		</div>
	</div>
	<hr>

<table class="table table-bordered table-stripped table-auto table-condensed">
	<thead>
		<th></th><th>Brand</th><th></th>
	</thead>
	<tbody>
		<?php while($brand = mysqli_fetch_assoc($result)):?>
		<tr>
			<td><a href="brands.php?edit= <?php echo $brand['id'];?>" class="btn btn-sm btn-outline-success"><span class="glyphicon glyphicon-pencil"></span>edit</a></td>
			<td><a href=""></a><?php echo $brand['brand']; ?></td>
			<td><a href="brands.php?delete= <?= $brand['id'];?>" class="btn btn-sm btn-outline-danger"><span class="glyphicon glyphicon-remove-sign"></span>delete</a></td>
		</tr>
	<?php endwhile;?>
	</tbody>
</table>


<?php
include 'includes/footer.php'; ?>