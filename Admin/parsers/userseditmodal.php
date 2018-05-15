<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php';?>
<?php ob_start(); ?>
<?php   
        $edit_id = (int)$_POST['id'];
        $edit_id = sanitize($edit_id);
        $editQuery = $db->query("SELECT * FROM users WHERE id = '$edit_id' ");
        $userInfo = mysqli_fetch_assoc($editQuery);
        $permissions = $userInfo['permissions'];  

           if (isset($_GET['submit']) ) {
              $myId = (int)$userInfo['id'];
              $myId = sanitize($myId);
              $editName =((isset($_POST['editName']) && !empty($_POST['editName']))?sanitize($_POST['editName']):'');
              $editEmail = ((isset($_POST['editEmail']) && !empty($_POST['editEmail']))?sanitize($_POST['editEmail']):'');
              $editPermissions = ((isset($_POST['permissions']) && !empty($_POST['permissions']))?sanitize($_POST['permissions']):'');

           $db->query("UPDATE users SET full_name = '$editName', email = '$editEmail', permissions = '$editPermissions' WHERE id = '$myId' ");
              }



?>

<!--edit modal-->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="archivesModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="users.php?submit=<?=$userInfo['id'];?>" method="post">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="editName">Name</label>
            <input type="text" name="editName" value="<?=$userInfo['full_name'];?>" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label for="editEmail">Email</label>
            <input type="text" name="editEmail" value="<?= $userInfo['email'];?>" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label for="editPermission">permissions</label>
           <select class="form-control" name="permissions">
                <option value=""<?= (($permissions == '')?' selected':'') ;?>></option>
                <option value="editor"<?= (($permissions == 'editor')?' selected':'') ;?>>Editor</option>
                <option value="admin,editor"<?= (($permissions == 'admin,editor')?' selected':'') ;?>>Admin</option>
              </select>
          </div>
        </div>
        <button class="btn btn-outline-success" type="submit">Edit User</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal();return false;">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
   function closeModal(){
                            jQuery('#edit_modal').modal('hide');
                            setTimeout(function(){
                              jQuery('#edit_modal').remove();
                              
                            },200);
                          }
</script>

<?php echo ob_get_clean(); ?>  