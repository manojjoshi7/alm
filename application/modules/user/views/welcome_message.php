<div class="row">

<div class="col-lg-6">
<div><h5>Login</h5></div>
<?php
$attributes = array('class' => '', 'id' => 'loginform','name'=>'loginform');
 if(isset($logerror))
  {echo $logerror;}
 

 echo form_open('/',$attributes);
 
?>

<div class="row">
<div class="col-lg-3">
<?php
echo form_label('Enter Email', 'email');
?>

</div>
<div class="col-lg-3">
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
<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
<?php
echo form_label('Enter Password', 'password');
?>

</div>
<div class="col-lg-3">
<?php

$data = array(
              'name'        => 'userpassword',
              'id'          => 'userpassword',
              'value'       => '',
              'maxlength'   => '1000',
              'size'        => '25',
			  'class'        => 'form-control',      
             
			  'required'=> 'required'
            );

echo form_password($data);
?>

</div>



</div>
<div class="row">
<div class="col-lg-1">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('submitbut', 'Sign In');?></div><div class="col-lg-2"><?php echo  anchor('user/forget_password', 'ForgetPassword');?></div>
<div class="col-lg-1">&nbsp;</div>
</div>

<?php 
echo form_hidden('sendfrom', 'website');
echo form_close();
?>
</div>
<div class="col-lg-6">
<div><h5>Registration</h5></div>

<?php
$attributes = array('class' => '', 'id' => 'regform','name'=>'regform');
 if(isset($regerror))
  {echo $regerror;}
 echo form_open('/',$attributes);

?>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enter Name', 'name');
   ?>
 </div>
<div class="col-lg-3">
<?php
	$data = array(
              'name'        => 'regname',
              'id'          => 'regname',
             'value'       => isset($_POST['regname'])?$_POST['regname']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_input($data);?>



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
$options = array('Male'  => 'Male',
                  'Female'    => 'Female',
                  );

echo form_dropdown('sex', $options);
?>

</div>
</div>
<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Password', 'Password');
   ?>
 </div>
<div class="col-lg-3">
<?php
	$data = array(
              'name'        => 'regpassword',
              'id'          => 'regpassword',
             'value'       => isset($_POST['regpassword'])?$_POST['regpassword']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);?>
</div>
</div>
<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Confirm Password', 'confrim_Password');
   ?>
 </div>
<div class="col-lg-3"><?php
	$data = array(
              'name'        => 'conpassword',
              'id'          => 'conpassword',
             'value'       => isset($_POST['conpassword'])?$_POST['conpassword']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);?>
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
	   $data = array(
              'name'        => 'remail',
			  'type'        => 'email',
              'id'          => 'remail',
              'value'       => isset($_POST["remail"])?$_POST["remail"]:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

echo form_input($data);
?>
</div>
</div>

<div class="row">&nbsp;
</div>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enter Phone Number', 'phone');
   ?>
 </div>
<div class="col-lg-3"><?php
	$data = array(
              'name'        => 'regphone',
              'id'          => 'regphone',
             'value'       => isset($_POST['regphone'])?$_POST['regphone']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_input($data);?></div>
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
	   	   $data = array(
              'name'        => 'regaddress',
			  'id'          => 'regaddress',
              'value'       => isset($_POST['regaddress'])?$_POST['regaddress']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

    echo form_textarea($data);
	   ?>


</div>
</div>

<div class="row">
<div class="col-lg-2">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('submitbut', 'Sign Up');?></div>
<div class="col-lg-2">&nbsp;</div>
</div>
<?php 
 echo form_hidden('sendfrom', 'website');
echo form_close();
?>
</div>
</div>
</body>
