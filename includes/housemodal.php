<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';

?>

<div class="modal details-1" id="houseinfo" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Home254</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
          <span aria-hidden="true" hidden>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row ">
          

          <div class="col-md-6">

            
            
          </div>
        </div>
      </div>
      
     
  
    </div>
  </div>
</div>


  <script>
    // edited
        function closeModalhouse(){
          jQuery('#houseinfo').modal('hide');
          setTimeout(function(){
            jQuery('#details-modal').remove();
            location.reload();
          },200);
        }    
      // end edit
  </script>
      <script src="vendor/fotorama/fotorama.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
                $(function () {
              $('.fotorama').fotorama({
                'loop':true,
                'autoplay':true,
                'height':'60%',
              });
             }); 
        });
      </script>
      
   
  
 
  
  
      


