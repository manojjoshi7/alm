<div class="right_col" role="main">
<br />
<div>
<?php if($actiontype=="add"){
?>
<div><h2>Boutique Registration</h2></div>
<?php
}
else
{
?>
<div><h2>Edit Boutique Info</h2></div>
<?php
}
?>
<?php
$attributes = array('class' => '', 'id' => 'regform','name'=>'regform');
 if(isset($regerror))
  {echo $regerror;}
 echo form_open('admin/boutiquereg',$attributes);


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
          'value'       =>(isset($profile_info[0]->name)?$profile_info[0]->name:(isset($_POST['regname'])?$_POST['regname']:'')),
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
  $selected=(isset($profile_info[0]->sex)?$profile_info[0]->sex:(isset($_POST['sex'])?$_POST['sex']:''));
$options = array('Male'  => 'Male',
                  'Female'    => 'Female',
                  );

echo form_dropdown('sex', $options,$selected);
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
	   $data = array(
              'name'        => 'remail',
			  'type'        => 'email',
              'id'          => 'remail',
              'value'       => (isset($profile_info[0]->email_address)?$profile_info[0]->email_address:(isset($_POST["remail"])?$_POST["remail"]:'')),
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
             'value'       =>(isset($profile_info[0]->phone_numeber)?$profile_info[0]->phone_numeber:(isset($_POST['regphone'])?$_POST['regphone']:'')),
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
              'value'       =>(isset($profile_info[0]->address)?$profile_info[0]->address:(isset($_POST['regaddress'])?$_POST['regaddress']:'')),
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

    echo form_textarea($data);
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

<?php 
 echo form_hidden('sendfrom', 'website');
 if(isset($actiontype))
 echo form_hidden('actiontype', $actiontype);
 if(isset($userid))
 echo form_hidden('userid', $userid);

 
 echo form_close();
?>
</div>
                

            </div>