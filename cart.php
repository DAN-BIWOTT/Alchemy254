<?php 
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/cart_navigation.php';

if ($cart_id != '') {
	$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}' ");
	$result = mysqli_fetch_assoc($cartQ);
	$items = json_decode($result['items'],true);
	$i = 1;
	$sub_total = 0;
	$item_count = 0; 
}

 ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 left-sidebar">
			<h4 class="text-center" style="margin: auto;font-size: 25px;">My Shopping Cart</h4><hr>
		</div>
		<div class="col-md-12">
			<?php if ($cart_id == '') :?>
			<div class="bg-danger ">
				<p class="text-center ">Your shopping Cart is empty</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php else: ?>
			<table class="table table-bordered table-condensed table-striped">
				<thead>
					<th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th>
				</thead>
				<tbody>
					<?php 
					foreach ($items as $item) {
						$product_id = $item['id'];
						$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}' ");
						$product = mysqli_fetch_assoc($productQ);
						$sArray = explode(',', $product['sizes']);
						foreach ($sArray as $sizeString) {
							$s = explode(':', $sizeString);
							if ($s[0] == $item['size']) {
								$available = $s[1];
							}
						}
						?>
						<tr>
							<td><?=$i;?></td>
							<td><?= $product['title']; ?></td>
							<td><?=money($product['price']);?></td>
							<td>
								<button class="btn btn-sm btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['size'];?>');"><b>-</b></button>
								<?=$item['quantity'];?>
								<?php if($item['quantity'] < $available): ?>
								<button class="btn btn-sm btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['size'];?>');"><b>+</b></button>	
							<?php else: ?>
								<span class="text-danger">Max</span>

							<?php endif ;?>
							</td>
							<td><?=$item['size'];?></td>
							<td><?=money($item['quantity'] * $product['price']);?></td>
						</tr>

						<?php 
						$i++;
						$item_count += $item['quantity'];
						$sub_total += ($product['price'] * $item['quantity']);
					}
					$tax = TAXRATE * $sub_total;
					
					$grand_total = $tax + $sub_total;
					?> 
				</tbody>
			</table>
			<table class="table table-bordered table-condensed text-right">
				<thead class="totals-table-header">
					<legend>Totals</legend>
					<th>Total Items</th><th>Sub Total</th><th>Tax</th><th>Grand Total</th>
				</thead>
				<tbody>
					<tr>
						<td><?=$item_count;?></td>
						<td><?=money($sub_total);?></td>
						<td><?=money($tax);?></td>
						<td class="bg-success"><b><?=money($grand_total);?></b></td>
					</tr>
				</tbody>
			</table>
<!-- check out button -->
			<button type="button" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#checkoutmodal"> <i class="fa fa-crosshairs"></i>
			  check out
			</button>

			<!-- Modal -->
			<div class="modal fade" id="checkoutmodal" tabindex="-1" role="dialog" aria-labelledby="checkoutLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="checkoutLabel">Shipping Address</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      		<form action="thankYou.php?payment=1" method="post" id="payment-form">
			      			<span id="payment-errors"></span>
			      			<input type="hidden" name="tax" value="<?=$tax;?>">
			      			<input type="hidden" name="sub_total" value="<?=$sub_total;?>">
			      			<input type="hidden" name="grand_total" value="<?=$grand_total;?>">
			      			<input type="hidden" name="cart_id" value="<?=$cart_id;?>">
			      			<input type="hidden" name="description" value="<?=$item_count;?>">
			       	<div id="step1" style="display: block;">
				       	<div class="row">
				       		<div class="form-group col-md-6">
				       			<label for="full_name">Full Name</label>
				       			<input class="form-control" type="text" name="full_name" id="full_name">
				       		</div>		
				       		<div class="form-group col-md-6">
				       			<label for="email">Email</label>
				       			<input class="form-control" type="email" name="email" id="email">
				       		</div>
				       		<div class="form-group col-md-6">
				       			<label for="phone">Phone Number</label>
				       			<input class="form-control" type="text" name="phone" id="phone">
				       		</div>       		
				       		<div class="form-group col-md-6">
				       			<label for="id_num">ID number</label>
				       			<input class="form-control" type="text" name="id_num" id="id_num">
				       		</div>
				       	</div>				       						 
			       	</div>
			       	<div id="step2" style="display: none;">
			       		<div class="row">
			       			<legend>Mpesa</legend>
				       		<div class="form-group col-md-3">
				     			<label for="name">Send Amount To: </label>
				     			<input type="text" id="name" class="form-control" value="0740-154-227" disabled>
				     		</div>
				     		<div class="form-group col-md-2"></div>
				     		<div class="form-group col-md-3">
				     			<label for="mpesa_code">Mpesa Code: </label>
				     			<input type="text" id="mpesa_code" name="mpesa_code" class="form-control">
				     		</div>
			       		</div>
			       	</div>
			       	<button type="submit" class="btn btn-primary" id="checkout_button" style="display: none;">Check Out</button>
			      </form>	       
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary" id="next_button" onclick="check_address();return false;">Next >></button>
			        <button type="button" class="btn btn-primary" id="back_button" style="display: none;" onclick="back_address();"><< Back</button>
			        
			        
			      </div>
			    </div>
			  </div>
			</div>

		<?php endif ;?>
			</div>
		</div>
	</div>
</div>

<script>
	function back_address(){
		jQuery('#payment-errors').html("");
		jQuery('#step1').css("display","block");
		jQuery('#step2').css("display","none");
		jQuery('#next_button').css("display","inline-block");
		jQuery('#back_button').css("display","none");
		jQuery('#checkout_button').css("display","none");
		jQuery('#checkoutLabel').html("Shipping Address");
	}

	function check_address(){
		var data = {
			'full_name': jQuery('#full_name').val(),
			'email' : jQuery('#email').val(),
			'phone' : jQuery('#phone').val(),
			'id_num' : jQuery('#id_num').val(),
		};
		jQuery.ajax({
			url : '/clothing_store/Admin/parsers/check_address.php',
			method: 'POST',
			data : data,
			success: function(data){//ALWAYS REMEMBER THE STRESS HERE!!!
				if (  data != 'passed') {
					jQuery('#payment-errors').html(data);
				}
				if (data == 1) { 
					jQuery('#payment-errors').html('');
					jQuery('#step1').css("display","none");
					jQuery('#step2').css("display","block");
					jQuery('#next_button').css("display","none");
					jQuery('#back_button').css("display","inline-block");
					jQuery('#checkout_button').css("display","inline-block");
					jQuery('#checkoutLabel').html("Enter Your Card Details");
				}
			},
			error: function(){alert("something went wrong in check_address")},
		});
	}
</script>

 <?php
  include 'includes/footer.php' ;
 ?>