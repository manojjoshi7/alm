<body style="background:#F7F7F7;">
<div class="">

<div id="wrapper">

<div id="login" class="animate form">
  <section class="login_content">
<?php
$attributes = array('class' => '', 'id' => 'upadteemail','name'=>'upadteemail');
 if(isset($message))
  {echo $message;}
 echo form_open('admin/new_password',$attributes);

?>
<h1>
Forgate Password
</h1>
<div class="row">
<div class="col-lg-4">
 <?php
   echo form_label('Enter Email', 'email');
 ?>
</div>
<div class="col-lg-8">
<?php
	   $data = array(
              'name'        => 'remail',
			  'type'        => 'email',
              'id'          => 'remail',
              'value'       =>(isset($employ_info[0]->email_id)?$employ_info[0]->email_id:(isset($_POST['remail'])?$_POST['remail']:'')),
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

echo form_input($data);
?>
</div>
</div>
<div class="row">
<div class="col-lg-4">
 <?php
   echo form_label('Enter New Password', 'password');
 ?>
</div>
<div class="col-lg-8">
<?php

	$data = array(
              'name'        => 'newpassword',
              'id'          => 'newpassword',
             'value'       => (isset($employ_info[0]->password)?$employ_info[0]->password:(isset($_POST['newpassword'])?$_POST['newpassword']:'')),
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);
?>
</div>
</div>
<div class="row">
<div class="col-lg-4">
 <?php
   echo form_label('Confirm Password', 'password');
 ?>
</div>
<div class="col-lg-8">
<?php

	$data = array(
              'name'        => 'confirmpassword',
              'id'          => 'confirmpassword',
             'value'       => (isset($employ_info[0]->password)?$employ_info[0]->password:(isset($_POST['confirmpassword'])?$_POST['confirmpassword']:'')),
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_password($data);
?>
</div>

</div>
<div class="row">
<div class="col-lg-3">
&nbsp;
</div>
<div class="col-lg-2">
<?php echo form_submit('submitbut', 'Submit');?>
</div>
<div class="col-lg-3">
&nbsp;
</div>
</div>
<?php 
                   echo form_hidden('sendfrom', 'website');
                   echo form_close();
?>
</div>
</div>
</section>
</div>
</body>