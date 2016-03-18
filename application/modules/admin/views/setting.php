<div class="right_col" role="main">
<div>
<div><h2><a href="javascript:void();" onclick="email_update();">Do you want change email address</a></h2></div>
<div><h2><a href="javascript:void();" onclick="password_update();">Do you wnat change password </a></h2></div>
</div>
<?php
$display=isset($message)?'block':'none';
?>
<div style="display:<?php echo $display;?>" id="upadte_email_part">
<?php
$attributes = array('class' => '', 'id' => 'upadteemail','name'=>'upadteemail');
 if(isset($message))
  {echo $message;}
 echo form_open('admin/update_email',$attributes);

?>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enate Email', 'email');
   ?>
 </div>
 <div class="col-lg-3">		
<?php
	   $data = array(
              'name'        => 'remail',
			  'type'        => 'email',
              'id'          => 'remail',
              'value'       =>isset($_POST['remail'])?$_POST['remail']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

echo form_input($data);
?>
</div>
</div>
<div class="row">
<div class="col-lg-2">
&nbsp;
</div>
<div class="col-lg-2">
<?php echo form_submit('Upadte Email Id', 'Submit');?>
</div>
<div class="col-lg-2">
&nbsp;
</div>

</div>
<?php 
 echo form_hidden('sendfrom', 'website');
 echo form_close();
?>

</div>
<?php
$display=isset($passwordmessage)?'block':'none';
?>

<div style="display:<?php echo $display;?>;" id="upadte_password_part">
<?php
$attributes = array('class' => '', 'id' => 'updatepassword','name'=>'updatepassword');
 if(isset($passwordmessage))
  {echo $passwordmessage;}
 
 echo form_open('admin/password_update',$attributes);

?>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enate Old Password', 'Password');
   ?>
 </div>
<div class="col-lg-3">
<?php

	$data = array(
              'name'        => 'oldpassword',
              'id'          => 'oldpassword',
             'value'       => isset($_POST['oldpassword'])?$_POST['oldpassword']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);?>
</div>
</div>
<div class="row">
<div class="col-lg-6">
&nbsp;
</div>
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enate New Password', 'Password');
   ?>
 </div>
<div class="col-lg-3">
<?php

	$data = array(
              'name'        => 'newpassword',
              'id'          => 'newpassword',
             'value'       => isset($_POST['newpassword'])?$_POST['newpassword']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);?>
</div>
</div>
<div class="row">
<div class="col-lg-2">
&nbsp;
</div>
<div class="col-lg-2">
<?php echo form_submit('Upadte Email Id', 'Submit');?>
</div>
<div class="col-lg-2">
&nbsp;
</div>
</div>
<?php 
 echo form_hidden('sendfrom', 'website');
 echo form_close();
?>
</div>
</div>
<script>
 var email_update=function()
                    {
					$("#upadte_password_part").slideUp('slow');
	                 $("#upadte_email_part").slideDown('slow');;
					
					}
var password_update=function()
                    {
					$("#upadte_password_part").slideDown('slow');
	                 $("#upadte_email_part").slideUp('slow');;
					
					}

</script>