<h2>Forget Password</h2>
<?php
$attributes = array('class' => '', 'id' => 'forgotpassword','name'=>'forgotpassword');
 if(isset($forgetpassworderror))
  {echo $forgetpassworderror;}
 echo form_open('/user/forget_password',$attributes);
 
?>
<div class="row">
<div class="col-lg-2">
<?php
echo form_label('Enter Email', 'email');
?>

</div>
<div class="col-lg-4">
<?php
$data = array(
              'name'        => 'useremail',
			  'type'        => 'email',
              'id'          => 'useremail',
              'value'       => (isset($_POST["useremail"])?$_POST["useremail"]:''),
              'maxlength'   => '1000',
              'size'        => '25',
			  'required'=> 'required'
            );
echo form_input($data);			
	   ?>
</div>

</div>
<div class="row">
<div class="col-lg-6">&nbsp;</div>
</div>
<div class="row">
<div class="col-lg-2">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('submitbut', 'Submit');?></div>
<div class="col-lg-2">&nbsp;</div>
</div>
<?Php
echo form_close();
?>