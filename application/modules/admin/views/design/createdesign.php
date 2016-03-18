<div class="right_col" role="main">

                <br />
<div>
				
<div><h2>Add Design</h2></div>				

<?php
  $attributes = array('class' => '', 'id' => 'designform','name'=>'designform','enctype'=>'multipart/form-data');
  echo form_open('admin/design/createdesign',$attributes);
  if(isset($error))
  echo $error;
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
              'name'        => 'designname',
              'id'          => 'designname',
             'value'       => isset($_POST['designname'])?$_POST['designname']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              
			  'required'=> 'required'
            );

echo form_input($data);?>
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
   echo form_label('Category', 'category');
   ?>
 </div>
<div class="col-lg-3">
  <?php 
$selected=  isset($_POST['designcategory'])?$_POST['designcategory']:'';  
echo form_dropdown('designcategory', $category,$selected);
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
   echo form_label('Upload Images (image width/height should be 1280/854)', 'image');
   ?>
 </div>
<div class="col-lg-3">
	<?php
	$data = array(
              'name'        => 'uploadimg',
              'id'          => 'uploadimg',
              );

  echo form_upload($data);
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
   echo form_label('Design Information', 'Design info');
   ?>
 </div>
<div class="col-lg-3">
  <?php
	   	   $data = array(
              'name'        => 'designinfo',
			  'id'          => 'designinfo',
              'value'       =>isset($_POST['designinfo'])?$_POST['designinfo']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

    echo form_textarea($data);
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
   echo form_label('Price', 'price');
   ?>
 </div>
<div class="col-lg-3">
	<?php
	$data = array(
              'name'        => 'designprice',
              'id'          => 'designprice',
             'value'       => isset($_POST['designprice'])?$_POST['designprice']:'',
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> 'required'
            );

echo form_input($data);?>
</div>

</div>
<div class="row">
<div class="col-lg-6">
&nbsp;
</div>
</div>

<div class="row">
<div class="col-lg-2">
</div>
<div class="col-lg-2">
<?php echo form_submit('submitbut', 'Submit');?>
</div>
<div class="col-lg-2">
</div>

</div>
<?php
echo form_hidden('sendfrom', 'website');
echo form_close();
?>

</div>
				
</div>