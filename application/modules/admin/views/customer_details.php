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
<div class="row">
<div class="col-lg-2"><h2>Employ Name</h2></div><div class="col-lg-2"><h2>Sex</h2></div><div class="col-lg-2"><h2>Phone Number</h2></div><div class="col-lg-2"><h2>Address</h2></div><div class="col-lg-2"><h2>Email</h2></div><div class="col-lg-2"><h2>Action</h2></div>
</div>				
        <?php
foreach($customer as $row):
?>
        <div class="row">
          <div class="col-lg-2"><?php echo $row->user_name;?></div>
          <div class="col-lg-2"><?php echo $row->sex;?></div>
          <div class="col-lg-2"><?php echo $row->phone_number;?></div>
          <div class="col-lg-2"><?php echo $row->address;?></div>
          <div class="col-lg-2"><?php echo $row->email_id;?></div>
          <div class="col-lg-2"><a href="javascript:void();" onClick="delete_employ(<?php echo "'".$row->user_name."'";?>,<?php echo "'".$row->user_id."'";?>);">Delete</a></div>
          
        </div>
        <?php
endforeach;
?>

				
</div>				

