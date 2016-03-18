<div class="container"> 
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header popbuss">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Display Message</h4>
        </div>
        <div class="modal-body">
		<p class="ajaxloader"><img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>"/></p>
          <p id="displaymessage" class="popbuss"></p>
        </div>
        <div class="modal-footer popbuss">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="right_col" role="main">

                <br />
                <div>
<div><h2>Edit Profile</h2></div>

<div class="row">
<div class="col-lg-6">
<h2><a href="javascript:void()" onclick="upload_profile_pic();">Upload Profile Image</a></h2>
</div>
</div>

<div id="imguploadform" style="display:none;">
<?php
$attributes = array('class' => '', 'id' => 'upload_file','name'=>'upload_file');

 echo form_open('admin/uploadprofileimage',$attributes);

?>

<div class="row">
<div class="col-lg-3">
 <?php
   echo form_label('Upload Images', 'image');
   ?>
 
</div>
<div class="col-lg-3">
<?php
	$data = array(
              'name'        => 'userfile',
              'id'          => 'userfile',
              );

  echo form_upload($data);
?>
</div>
</div>

<div class="row">
<div class="col-lg-2">&nbsp;</div>
<div class="col-lg-2"><?php echo form_submit('fileupload', 'Upload');?></div>
<div class="col-lg-2">&nbsp;</div>
</div>
<?php

 echo form_hidden('sendfrom', 'website');
 echo form_close();
?>
</div>

<div class="row">
<div class="col-lg-6">
&nbsp;
</div>
</div>

<div class="row">
<div class="col-lg-6">
<h2><a href="javascript:void()" onclick="update_info();">Edit User Information</a></h2>
</div>
</div>

<div id="profileeditform">
<?php
$attributes = array('class' => '', 'id' => 'regform','name'=>'regform');
 if(isset($regerror))
  {echo $regerror;}
 echo form_open('admin/editprofile',$attributes);

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
              'name'        => 'regname',
              'id'          => 'regname',
             'value'       =>(isset($profile_info["0"]->user_name)?$profile_info["0"]->user_name:(isset($_POST['regname'])?$_POST['regname']:'')),
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
  $selected=(isset($profile_info["0"]->sex)?$profile_info["0"]->sex:(isset($_POST['sex'])?$_POST['sex']:'')); 
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
   echo form_label('Phone Number', 'phone');
   ?>
 </div>
<div class="col-lg-3"><?php
	$data = array(
              'name'  => 'regphone',
              'id'    => 'regphone',
             'value'  =>(isset($profile_info["0"]->phone_number)?$profile_info["0"]->phone_number:(isset($_POST['regphone'])?$_POST['regphone']:'')),
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
              'value'       =>(isset($profile_info["0"]->address)?$profile_info["0"]->address:(isset($_POST['regaddress'])?$_POST['regaddress']:'')),
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
 echo form_close();
?>
</div>
                
</div>
</div>
<script>

$('#upload_file').submit(function(e) 
	{

 		e.preventDefault();
		
		
		$('#myModal').modal({
          backdrop: 'static',
          keyboard: false
           })
		
		$(".popbuss").hide();
	    $(".ajaxloader").show();
		$("#myModal").modal('show');		   
        $.ajaxFileUpload(
		{
            url             :baseurl()+'admin/add_img_by_ajax', 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            success : function (data)
            {
			       $(".popbuss").show();
				   $(".ajaxloader").hide();
			  
			    var obj = jQuery.parseJSON(data);                
			    if(obj['status'] == 'success')
                {
				$("#user_profile_pic").attr('src',obj['imagepath']);
			    $("#displaymessage").html(obj['msg']);	
                }
                else
                {
                $("#displaymessage").html(obj['msg']);	
                }
            }
        });
        return false;
    });

upload_profile_pic= function()
                    {
					$("#profileeditform").slideUp('slow');
	                 $("#imguploadform").slideDown('slow');
					
					}
update_info=function()
                    {
					$("#profileeditform").slideDown('slow');
	                 $("#imguploadform").slideUp('slow');
					
					}

</script>