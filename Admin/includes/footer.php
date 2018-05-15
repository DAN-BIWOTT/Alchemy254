 
    <!-- Footer -->
   <footer class="footer">
         <div class="container-fluid">
           <div class="row">

             <div class="col-md-6">
               <span class="copyright">Copyright &copy;Alchemy_254 2018</span>
             </div>
			
			<div class="col-md-6">
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
       </footer>
       <!-- jQuery -->
       <script src="adminjs/jquery.min.js"></script>

       <!-- Bootstrap Core JavaScript -->
       <script src="adminjs/bootstrap.min.js"></script>

       <!-- Metis Menu Plugin JavaScript -->
       <script src="adminjs/metisMenu.min.js"></script>

       <!-- Custom Theme JavaScript -->
       <script src="adminjs/startmin.js"></script>
       <!-- Bootstrap core JavaScript -->
       
       <script src="../vendor/jquery/jquery.min.js"></script>
       

       <!-- Plugin JavaScript -->
       <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

       <!-- Contact form JavaScript -->
       <script src="../js/jqBootstrapValidation.js"></script>
       <script src="../js/contact_me.js"></script>

       <!-- Custom scripts for this template -->
       <script src="../js/agency.min.js"></script>
       <script src="../js/main.js"></script>
       <script src="../jsSignUp/main.js"></script>
       <!--===============================================================================================-->
        <script src="../vendor/animsition/js/animsition.min.js"></script>
       <!--===============================================================================================-->
        <script src="../vendor/select2/select2.min.js"></script>
       <script src="../vendor/daterangepicker/moment.min.js"></script>
        <script src="../vendor/daterangepicker/daterangepicker.js"></script>
       <!--===============================================================================================-->
        <script src="../vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
          <script src="../vendorSignUp/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
          <script src="../vendorSignUp/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
          <script src="../vendorSignUp/bootstrap/js/popper.js"></script>
     
        <!--===============================================================================================-->
          <script src="../vendorSignUp/select2/select2.min.js"></script>
        <!--===============================================================================================-->
          <script src="../vendorSignUp/daterangepicker/moment.min.js"></script>
          <script src="../vendorSignUp/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
          <script src="../vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
       <script>
        //generating the child options
                function get_child_options(selected){
                  if (typeof selected === 'undefined') {
                    var selected = '';
                  }
                  var parentID = jQuery('#parent').val();
                  jQuery.ajax({
                    url: '/clothing_store/Admin/parsers/child_categories.php',
                    method:'POST',
                    data: {parentID : parentID, selected: selected},
                    success: function(data){
                      jQuery('#child').html(data);
                    },
                    error: function(){alert("something went wrong in the child options")},
                  });
                }  
                //listening for changes in the "select tags", specifically the attribute name = parent
                 jQuery('select[name="parent"]').change(function(){
                  get_child_options();
                 });
        
//breaking the sizes from the database
        function updateSizes(){
          var sizeString = '';
          for(var i = 1; i <= 12;i++){
            if(jQuery('#size' + i).val()!=''){
              sizeString += jQuery('#size' + i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#threshold'+i).val()+',';
            }
          }
          jQuery('#sizes').val(sizeString);
        }


//pulling up the editing modal
        function editModal(id){
         var data = {"id":id};
         
         jQuery.ajax({
          url:'/clothing_store/Admin/parsers/userseditmodal.php',
          method:"POST",
          data: data,
          success:function(data){
           jQuery('body').append(data);
              jQuery('#edit_modal').modal('toggle');

          },
          error:function(){
            alert("something went wrong in the edit modal function.");
          },
         });
        }

        
       
       </script>
       <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     </body>

   </html>