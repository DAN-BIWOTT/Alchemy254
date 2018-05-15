<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}
if (!has_permission('admin') || !has_permission('editor')) {
	permission_error_redirect('index.php');

}
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$results = $db->query($sql);
$errors = array();
$category = '';
$post_parent = '';

//edit category
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
	$edit_result = $db->query($edit_sql);
	$edit_category = mysqli_fetch_assoc($edit_result);
}



//delete category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql = "SELECT FROM categories WHERE id = '$delete_id'";
	$result = $db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if ($category['parent'] == 0) {
		$sql = "DELETE FROM categories WHERE parent = '$delete_id'";
		$db->query($sql);
	}
	$dsql = "DELETE FROM categories WHERE id = '$delete_id'";
	$db->query($dsql);
	header('Location: categories.php');
	
}

//process form
if(isset($_POST) && !empty($_POST)){
	$post_parent = sanitize($_POST['parent']);
	$category = sanitize($_POST['category']);
	$sqlform = "SELECT * FROM categories WHERE categories = '$category' AND parent = '$post_parent'";
	if(isset($_GET['edit'])){
		$id = $edit_category['id'];
		$sqlform = "SELECT * FROM categories WHERE categories = '$category' AND parent = '$post_parent' AND id != '$id'";
	}
	$fresult = $db->query($sqlform);
	$count = mysqli_num_rows($fresult);  
	//if category is blank
	if ($category == '') {
		$errors[] .= 'The category cannot be left blank';
	}

	//if category exists in the database
	if ($count > 0) {
		$errors[] .= $category. ' already exists. Please choose a new category';
	}

	//display errors or update database
	if (!empty($errors)) {
			//display errors
		echo display_errors($errors);
	}else{//update database
		ob_start();
		$updatesql = "INSERT INTO categories (categories, parent) VALUES ('$category','$post_parent')";
		if(isset($_GET['edit'])){
			$updatesql = "UPDATE categories SET categories = '$category', parent = '$post_parent' WHERE id = '$edit_id' ";
		}
		$db->query($updatesql);
		header('Location: categories.php');
		ob_get_clean();
	}
}

	$category_value = '';
	$parent_value = 0;
if (isset($_GET['edit'])) {
	$category_value = $edit_category['categories'];
	$parent_value = $edit_category['parent'];
}else{
	if (isset($_POST)) {
		$category_value = $category; 
		$parent_value = $post_parent;
	}elseif (isset($_POST['edit'])) {
		$category_value = $category;
		$parent_value = $post_parent;
	}
}

?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">

	<!--form-->
	<div class="col-md-6">
		<form class="form" action="categories.php<?= ((isset($_GET['edit']))? '?edit='.$edit_id:''); ?>" method="post">
			<legend><?= ((isset($_GET['edit']))? 'Edit':'Add'); ?> Category</legend>
			<div class="form-group">
				<label for="parent">parent</label>
				<select class="form-control" name="parent" id="parent">
					<option value="0"<?= (($parent_value == 0)?' selected = "selected" ':''); ?>>Parent</option>
					<?php while($parent = mysqli_fetch_assoc($results)): ?>
					<option value="<?= $parent['id'];?>"<?= (($parent_value == $parent['id'])?' selected ="selected"':''); ?>><?= $parent['categories'] ;?></option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label class="form-group">Categories</label>
				<input type="text" name="category" class="form-control" placeholder="Add a category..." id="category" value="<?= $category_value;?>">
			</div>
			<div class="form-group">
				<input type="submit" value="<?= ((isset($_GET['edit']))? 'Edit':'Add To Category'); ?>" class="btn btn-outline-success">
				<?php
				if(isset($_GET['edit']))
					echo '<input type="submit" href="categories.php" value="Cancel Edit" class="btn btn-outline-success">';
				?>
			</div>
		</form>
	</div>

	

	<div div class="col-md-6">
		<!--category table-->
		<table class="table table-bordered">
			<thead>
				<th>Categories</th><th>Parent</th><th></th>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM categories WHERE parent = 0";
				$results = $db->query($sql);
				 while($parent = mysqli_fetch_assoc($results)): ?>
					<?php 
						$parent_id = (int)$parent['id'];
						$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
						$cresult = $db -> query($sql2);
					 ?>
				<tr class="bg-primary">
					<td><?php echo $parent['categories']; ?></td>
					<td>parent</td>
					<td>
						<a href="categories.php?edit=<?php echo $parent['id'] ; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></
						span></a>
						<a href="categories.php?delete=<?php echo $parent['id'] ; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></
						span></a>
					</td>
				</tr>
				<?php while($child = mysqli_fetch_assoc($cresult)): ?>
					<tr class="bg-info">
						<td><?php echo $child['categories']; ?></td>
						<td><?php echo $parent['categories']; ?></td>
						<td>
							<a href="categories.php?edit=<?php echo $child['id'] ; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></
							span></a>
							<a href="categories.php?delete=<?php echo $child['id'] ; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></
							span></a>
						</td>
					</tr>
				<?php endwhile; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>

<?php 
include 'includes/footer.php';
 ?>

