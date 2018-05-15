</div>  
      </div>
    </section> 

    <!-- Footer --> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy;Alchemy_254 2018</span>
          </div>
          <div class="col-md-4">
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
          <div class="col-md-4">
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
      </div>
       <!-- Bootstrap core JavaScript -->
       <script src="vendor/jquery/jquery.min.js"></script>
       <script src="vendor/fotorama/fotorama.js"></script>
       <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

       <!-- Plugin JavaScript -->
       <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

       <!-- Contact form JavaScript -->
       <script src="js/jqBootstrapValidation.js"></script>
       <script src="js/contact_me.js"></script>

       <!-- Custom scripts for this template -->
       <script src="js/agency.min.js"></script>

       
       

       <script>
         function detailsmodal(id){
          var data = {"id" : id};
           
          jQuery.ajax({
            url : '/clothing_store/includes/detailsmodal.php',
            method : "post",
            data : data,
            success : function(data){
              jQuery('body').append(data);
              jQuery('#details-modal').modal('toggle');
            },
            error : function(){
              alert("something went wrong");
            }
          });
         }

         function update_cart(mode,edit_id,edit_size){
          var data = {"mode":mode,"edit_id":edit_id,"edit_size":edit_size};
          jQuery.ajax({
            url:'/clothing_store/Admin/parsers/update_cart.php',
            method:"post",
            data:data,
            success: function(){location.reload();},
            error:function(){alert("something went wrong at update_cart function");},
          });
         }

         function add_to_cart(){
          jQuery('#modal_errors').html("");
          var size = jQuery('#size').val();
          var quantity = jQuery('#quantity').val();
          var available = jQuery('#available').val();
          var error = '';
          var data = jQuery('#add_product_form').serialize();

          if (size == '' || quantity == '' || quantity == 0) {
            error += '<p class="text-center text-danger" >You must choose a size and quantity.</p> ';
            jQuery('#modal_errors').html(error);
            return;
          }
          else if ( quantity > available  ){
             error += '<p class="text-center text-danger">There are only'+ available+' available.</p> ';
             jQuery('#modal_errors').html(error);
             return;
          }else{
            jQuery.ajax({
              url:'/clothing_store/Admin/parsers/add_cart.php',
              method : 'post',
              data : data,
              success : function(){
                location.reload();
              },
              error : function(){alert("Something went wrong");}             
            });
          }
         }

         function thumbs_count(id,decision){
            data = {'id':id,'decision':decision};
            jQuery.ajax({
              url: '/clothing_store/includes/likes.php',
              method: 'post',
              data: data,
              success:function(data){
                location.reload();
              },
              error:function(){alert("we have an error at thumbs_up_count");}
            });
         }
        

       </script>
     </footer>

     </body>

   </html>