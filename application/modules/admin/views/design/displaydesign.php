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
Design
</h1>
<div class="row">
<div class="col-lg-2"><h2>Image</h2></div><div class="col-lg-2"><h2>Name</h2></div><div class="col-lg-2"><h2>Design Info</h2></div><div class="col-lg-1"><h2>Category</h2></div><div class="col-lg-1"><h2>Price</h2></div><div class="col-lg-4"><h2>Action</h2></div>
</div>				
        <?php

foreach($design as $row):
$images_name=str_replace(".","_thumb.",$row->images_name);
?>
        <div class="row">
          <div class="col-lg-2"><img src="<?php echo base_url('assets/design/designupload/admin/thumb/'.$images_name.'');?>" height="60px" width="60px"></div>
          <div class="col-lg-2"><?php echo $row->name;?></div>
          <div class="col-lg-2"><?php echo $row->design_info;?></div>
          <div class="col-lg-1"><?php echo $row->categoryname;?></div>
		  <div class="col-lg-1"><?php echo $row->price;?></div>
		  <div class="col-lg-4"><?php echo  anchor('admin/design/viewdesign/'.$row->design_id.'', 'View Design');?>&nbsp;|&nbsp;<?php echo  anchor('admin/design/editdesign/'.$row->design_id.'', 'Edit Info');?>&nbsp;|&nbsp;<?php echo  anchor('admin/design/adddesignimage/'.$row->design_id.'', 'Add/Edit/Delete image');?>&nbsp;|&nbsp;<a href="javascript:void();" onclick="delete_row(<?php echo "'".$row->name."'";?>,<?php echo "'".$row->design_id."'";?>,'design')">Delete</a></div>
        </div>
        <?php
endforeach;
?>

				
</div>				

