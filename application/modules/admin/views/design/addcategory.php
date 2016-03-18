<div class="right_col" role="main">

                <br />
<?php
 if($actiontype=="add")
 {
?>				
<div><h2>Add Category</h2></div>
<?php
 }else
 { 
?>
<div><h2>Edit Category</h2></div>
<?php
}
?>				
<?php
  $attributes = array('class' => '', 'id' => 'regform','name'=>'regform');
  if(isset($regerror))
  {echo $regerror;}
  echo form_open('admin/design/category',$attributes);
  if(isset($error))
  echo $error;
?>
<div class="row">
<div class="col-lg-3">
  <?php
   echo form_label('Enter Category Name', 'name');
   ?>
 </div>
<div class="col-lg-3">
<?php
	$data = array(
              'name'        => 'catname',
              'id'          => 'catname',
             'value'       => (isset($cat_info[0]->name)?$cat_info[0]->name:(isset($_POST['catname'])?$_POST['catname']:'')),
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
   echo form_label('Enter Descreption', 'descreption');
   ?>
 </div>
<div class="col-lg-3">
<?php
	   	   $data = array(
              'name'        => 'categorydescreption',
			  'id'          => 'categorydescreption',
              'value'       =>(isset($cat_info[0]->descreption)?$cat_info[0]->descreption:(isset($_POST['categorydescreption'])?$_POST['categorydescreption']:'')), 
              'maxlength'   => '1000',
              'size'        => '25',
              'required'=> ''
            );

    echo form_textarea($data);
	   ?>


</div>


</div>				
			
<div class="row">
<div class="col-lg-2">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('submitbut', 'Submit');?></div>
<div class="col-lg-2">&nbsp;</div>
</div>			
<?php 
if(isset($actiontype))
 echo form_hidden('actiontype', $actiontype);
 if(isset($categoryid))
 echo form_hidden('categoryid', $categoryid);

 echo form_hidden('sendfrom', 'website');
 echo form_close();
?>				
</div>