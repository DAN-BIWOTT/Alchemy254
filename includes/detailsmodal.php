  </footer>
    <?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php'; 
    //the id was passed from the products page
    //use the id to generate the product selected
    $id = $_POST['id'];  
    $id = (int)$id;
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $db->query($sql);
    $product = mysqli_fetch_assoc($result);
    //from the product infomation generated above, extract the brands
    $brand_id = $product['brand'];
    $brand_id = (int)$brand_id;
    $b_sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
    $brand_result = $db->query($b_sql);
    $brand = mysqli_fetch_assoc($brand_result);
    //repeat the extraction for sizes
    $sizeString = $product['sizes']; 
    $sizeString = rtrim($sizeString,',');
    $size_array = explode(',', $sizeString);
    ?>
 

   
   <div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
      	<div class="modal-dialog modal-lg">
  	    		<div class="modal-content ">
              <div class="modal-header">
                              <button class="close" onclick="closeModal()" aria-label="close" hidden>
                                <span aria-hidden="true">&times;</span>
                              </button>
                            <h4 class="modal-title text-center title"><?php echo $product['title'] ;?></h4>
                            </div>
                            <div class="modal-body">
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-sm-6 fotorama"> 
                                    <?php $photos = explode(',', $product['image']);
                                    foreach ($photos as $photo): ?>                                   
                                    
                                          <img src="<?=$photo;?>" alt="<?= $product['title'];?>" style="width:100%" class="details img-responsive">                                       
                                   
                                    <?php endforeach;?>
                                  </div> 
                                  <div class="col-sm-6">
                                    <h4>Details</h4>
                                    <p><?php echo nl2br($product['description'])  ;?></p>
                                    <hr>
                                    <p>Price: Ksh. <?php echo $product['price'] ;?></p>
                                    <p>Brand : <?php echo $brand['brand'] ;?></p>
                                  <form action="add_cart.php" method="post" id="add_product_form">
                                    <input type="hidden" name="product_id" value="<?=$id;?>">
                                    <input type="hidden" name="available" id="available" value="" >
                                    <span id="modal_errors"></span> 
                                    <div class="form-group">
                                      <div class="col-xs-3">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" min="0" class="form-control" id="quantity">                         
                                      </div>
                                       
                                    </div>
                                    <div class="form-group">
                                      <label for="size">Size: </label>
                                      <select name="size" id="size" class="form-control">
                                        <option value=""></option>

                                        <?php 
                                        foreach($size_array as $string){
                                          $string_array = explode(':', $string);
                                          $size = $string_array[0];
                                          $available = $string_array[1];
                                          if($available > 0){
                                          echo 
                                        '<option value= "'.$size.'" data-available="'.$available.'" >'. $size.' ('.$available.' Available)</option>';
                                        }
                                     } ?>
                                      </select>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div> 
                            <div class="modal-footer">
                              <button class="btn btn-default" onclick="closeModal()">close</button>
                              <button class="btn btn-warning" onclick="add_to_cart();return false;"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                            </div>
                        </div>

                        <script>
                          jQuery('#size').change(function(){
                            var available = jQuery('#size option:selected').data("available");
                            jQuery('#available').val(available);
                          });

                          $(function () {
                            $('.fotorama').fotorama({
                              'loop':true,
                              'autoplay':true,
                              'height':'50%',
                            });
                          });

                          function closeModal(){
                            jQuery('#details-modal').modal('hide');
                            setTimeout(function(){
                              jQuery('#details-modal').remove();
                              
                            },200);
                          }
                        </script>
                        <script src="js/agency.min.js"></script>
                      
                    
