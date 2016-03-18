<div class="right_col" role="main">
<div><h2>Task For Employee</h2></div>

<?php
$attributes = array('class' => '', 'id' => 'employeetask','name'=>'employeetask');

 echo form_open('admin/uploadprofileimage',$attributes);

?>

<div class="row">
<div class="col-lg-3">
 <?php
   echo form_label('Select Employee', 'employee');
   ?>
 
</div>
<div class="col-lg-3">
<?php
  $selected='';
	echo form_dropdown('employee', $employee,$selected);
?>
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
   echo form_label('Select Customer', 'customer');
   ?>
 
</div>
<div class="col-lg-3">
<?php
	$selected='';
	echo form_dropdown('customer', $customer,$selected);
?>
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
   echo form_label('Send Message', 'message');
   ?>
 
</div>
<div class="col-lg-3">
<?php
	   	   $data = array(
              'name'        => 'taskmessage',
			  'id'          => 'taskmessage',
              'value'       =>isset($_POST['taskmessage'])?$_POST['taskmessage']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

    echo form_textarea($data);
	   ?></div>


</div>
<div class="row">
<div class="col-lg-6">
&nbsp;
</div>
</div>

<div class="row">
<div class="col-lg-2">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('submitbut', 'Submit');?></div>
<div class="col-lg-2">&nbsp;</div>
</div>
<?php 
 echo form_hidden('sendfrom', 'website');
 echo form_close();
?>
</div>