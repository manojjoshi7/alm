<div class="container"> 
  <!-- Modal -->
  <div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Display Message</h4>
        </div>
        <div class="modal-body">
          <p id="displaymessage"> Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
    <button type="button" data-dismiss="modal" class="btn">Cancel</button>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="right_col" role="main">
<br />
<h1>
Categories
</h1>
<div class="row">
<div class="col-lg-2"><h2>Name</h2></div><div class="col-lg-6"><h2>Descreption</h2></div><div class="col-lg-2"><h2>Action</h2></div>
</div>				
        <?php
foreach($category as $row):
?>
        <div class="row">
          <div class="col-lg-2"><?php echo $row->name;?></div>
          <div class="col-lg-6"><?php echo $row->descreption;?></div>
          <div class="col-lg-2"><?php echo  anchor('admin/design/editcatgory/'.$row->cat_id.'', 'Edit');?>&nbsp;|&nbsp;<a href="javascript:void();" onClick="delete_row(<?php echo "'".$row->name."'";?>,<?php echo "'".$row->cat_id."'";?>,'category');">Delete</a></div>
          
        </div>
        <?php
endforeach;
?>

				
</div>				

