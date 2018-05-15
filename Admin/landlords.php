<?php 
require_once '../core/init.php';
if (!is_logged_in()) {
	login_error_redirect();
}
require_once 'includes/head.php';
require_once 'includes/navigation.php';

$ownersql = $db->query("SELECT * FROM owner");
?>
<!--Main page-->
<h2 class="text-center">Houses</h2><hr>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5" style="margin-right: 30px;">
		<table class="table table-bordered table-striped table-condensed">
			<thead class="text-uppercase">
				<th>#</th><th>owner name</th><th>phone number</th><th>email</th><th>Fee Charged</th>
			</thead>
			<tbody>
				<?php while($owner = mysqli_fetch_assoc($ownersql)) : ?>
				<tr>
					<td></td>
				    <td><?=$owner['full_name'];?></td>
				    <td><?=$owner['phone_number'];?></td>
				    <td><?=$owner['email'];?></td>
				    <td><?=$owner['amount'];?></td>
				</tr>
			<?php endwhile ;?>
			</tbody> 
		</table>
		</div>
		 <div class="col-md-6" id="estates" style="margin-left: 40px;">
		
		</div>
	</div>
	
</div>



<?php
include 'includes/footer.php'; ?>