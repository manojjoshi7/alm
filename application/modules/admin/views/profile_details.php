<div class="right_col" role="main">

                <br />
                <div>
<div class="row"><div class="col-lg-3"><h2>User Profile</h2></div><div class="col-lg-3"><?php echo  anchor('admin/editprofile', 'Edit');?></div></div>

<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Name', 'name');
   ?>
 </div>
<div class="col-lg-3">
<?php
echo $profile_info["0"]->user_name;
?>
</div>


</div>
<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Sex', 'sex');
   ?>
 </div>
<div class="col-lg-3">
  <?php 
  echo $profile_info["0"]->sex;
  ?>

</div>
</div>
<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Email Address', 'email');
   ?>
 </div>
<div class="col-lg-3">		
<?php
	   
echo $profile_info["0"]->email_id;
?>
</div>
</div>

<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Phone Number', 'phone');
   ?>
 </div>
<div class="col-lg-3"><?php
echo $profile_info["0"]->phone_number;
?></div>
</div>

<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enter Address', 'address');
   ?>
 </div>
<div class="col-lg-3">
   <?php
	   	  echo $profile_info["0"]->address;
  ?>
</div>
</div>
<div class="row">
<div class="col-lg-6">&nbsp;</div>
</div>


</div>
                

            </div>