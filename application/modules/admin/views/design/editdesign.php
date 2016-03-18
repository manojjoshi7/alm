<div class="right_col" role="main">

<br />
<div>
				
<div><h2>Edit Design Information</h2></div>				

<?php
  $attributes = array('class' => '', 'id' => 'editdesigninfo','name'=>'editdesigninfo');
  echo form_open('admin/design/editdesign/'.$hold_id.'',$attributes);
  if(isset($error))
  echo $error;
?>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Name', 'name');
   ?>
 </div>
<div class="col-lg-3">
<?php
	$data = array(
              'name'        => 'designname',
              'id'          => 'designname',
             'value'       =>(isset($nameofdesign)?$nameofdesign:(isset($_POST['designname'])?$_POST['designname']:'')),
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
$selected= (isset($category_id)?$category_id:(isset($_POST['designcategory'])?$_POST['designcategory']:''));  
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
   echo form_label('Design Information', 'Design info');
   ?>
 </div>
<div class="col-lg-3">
  <?php
	   	   $data = array(
              'name'        => 'designinfo',
			  'id'          => 'designinfo',
              'value'       =>(isset($info)?$info:(isset($_POST['designinfo'])?$_POST['designinfo']:'')),
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
             'value'       => (isset($price)?$price:(isset($_POST['designprice'])?$_POST['designprice']:'')),
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
echo form_hidden('hold_id', $hold_id);
echo form_hidden('sendfrom', 'website');
echo form_close();
?>

</div>
				
</div>