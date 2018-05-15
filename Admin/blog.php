<?php 
require_once '../core/init.php';
if (!is_logged_in()) {
    header('Location: login.php');
}
if (!has_permission('admin') || !has_permission('editor')) {
    permission_error_redirect('index.php');

}
include 'includes/blogHead.php';
include 'includes/blogNav.php';

?>


    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Strangers In Paradise</h1>
                </div>
            </div>
            <form action="../blogScripts/blogProcessor.php" method="post" enctype="multipart/form-data">
               <div class="panel panel-primary">

               <div class="panel-heading">
                   Primary Panel
               </div>
               <div class="panel-body">
                <div class="card-body">

                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>              
                                 
                    <div class="form-group">
                        <div class="input-group col-xs-12"> 
                        <label>Image</label>                        
                      </div>
                    <input type="file" name="img" class="file-upload-default">
                     </div>      
                     <!-- <div class="form-group">
                    <div class="input-group col-xs-4">  
                         <label>Book</label>                       
                    </div>
                    <div class="input-group col-xs-4">
                     <input type="file" id="book" name="book" class="file-upload-default">
                 </div>
                    </div>  -->       
                                    
                     <div class="form-group">
                        <textarea class="form-control" name="content" rows="5"></textarea>
                    </div>                                                                                   
                </div>
               </div>
                   <div class="panel-footer">
                    <button class="btn btn-light">Cancel</button>
                  <button type="submit" class="btn btn-success mr-2">Post</button>
                </div>
             </div> 
            </form>
            

        </div>
    </div>

</div>

<?php
include 'includes/blogFooter.php';
?>

</body>
</html>
