<div class="container"> 
  <!-- Modal -->
  <div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Display Message</h4>
        </div>
        <div class="modal-body">
          <p id="deletemessage"> Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
    <button type="button" data-dismiss="modal" class="btn">Cancel</button>

        </div>
      </div>
    </div>
  </div>
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
  
  <div class="modal fade" id="mainimgupload" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header popbuss">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
		<p class="editimgajaxloader"><img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>"/></p>
		<p id="editimgmessage" class="popbuss"></p>
		<form id="editimage">
		<p>
		Choose Images (image width/height should be 1280/854)
		</p>
		<p>
		<input type="file" value="uploadimage" name="editmainimg" id="editmainimg"/>
		</p>
		<p>
		<input type="submit" value="Upload Image"/>
		</p>
		</form>
          
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
 
    <div><h2>Add Image</h2></div>
  <div class="row">
 <div class="col-lg-6">

 <h4>
 <?php

 echo $design_name;
 $image =str_replace(".","_thumb.",$images_name);
 ?>
 </h4>
 </div>
 <div class="col-lg-6">
 &nbsp;
 </div>
 </div>
 <div class="row">
 <div class="col-lg-6">
 <a href="javascript:void();" class="mainimgwrapper">
 <span class="editimg">
        edit
    </span>
 <img src="<?php echo base_url('assets/design/designupload/admin/small/'.$image.'');?>" id="imgedit" width="411px" height="274px"/>
 </a>
 </div>
 <div class="col-lg-6">&nbsp;</div>
 </div> 
  </div>	
  <div class="row">
  <div class="col-lg-12">
  &nbsp;
  </div>
  </div>
<div class="row">
  <div class="col-lg-12" id="addimages">
  <?php
  foreach($design_images as $row):
  ?>
 <span id="imgrow_<?php echo $row->img_id;?>" style="margin-left:15px;">
<img src="<?php echo base_url('assets/design/designupload/admin/thumb/'. str_replace(".","_thumb.",$row->img_name).'');?>" width="100px" height="67px"/><img src="<?php echo base_url('assets/images/deleteimg.png');?>" style="position:absolute; cursor:pointer;" onclick="delete_row('',<?php echo $row->img_id; ?>,'image')"/>
</span>
  <?php
  endforeach;
  ?>
  </div>
  </div>
   <div class="row">
   <div class="col-lg-12">
   &nbsp;
   </div>
   </div>  
<?php
  $attributes = array('class' => '', 'id'=>'upload_file','name'=>'upload_file');
  echo form_open('admin/design/adddesign',$attributes);
  if(isset($error))
  echo $error;
  ?>
   <div class="row">
   <div class="col-lg-3">
  <?php
   echo form_label('Upload Images (image width/height should be 1280/854)', 'image');
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
$data=array("name"=>"hold_id","type"=>"hidden","id"=>"hold_id","value"=>$hold_id);
echo form_input($data);
echo form_hidden('sendfrom', 'website');

echo form_close();
?>
				
 
 </div>
 
 </div>
 <script>
 $(function() {

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
        $.ajaxFileUpload({
            url             :baseurl()+'admin/design/add_img_by_ajax/'+$("#hold_id").val()+'', 
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
				
				$("#addimages").append('<span id="imgrow_'+obj["image_id"]+'" style="margin-left:15px;"><img src="'+obj["imagepath"]+'" width="60px" height="60px"/><img src="'+baseurl()+'assets/images/deleteimg.png" style="position:absolute; cursor:pointer;" onclick="delete_row("","'+obj["image_id"]+'","image")"/></span>');
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
	$(".editimg").click(function(){
	$(".editimgajaxloader").hide();	
$("#mainimgupload").modal('show');
	});
	$("#editimage").submit(function(e) 
	{
	 e.preventDefault();
     $('#imgedit').modal({
          backdrop: 'static',
          keyboard: false
           })
	$(".editimgajaxloader").show();
	   $.ajaxFileUpload({
            url             :basurl()+'admin/design/edit_img_by_ajax/'+$("#hold_id").val()+'', 
            secureuri       :false,
            fileElementId   :'editmainimg',
            dataType: 'JSON',
            success : function (data)
            {
			       $(".popbuss").show();
				   $(".editimgajaxloader").hide();
			  
			   var obj = jQuery.parseJSON(data);                
			    if(obj['status'] == 'success')
                {
				$("#editimgmessage").html(obj['msg']);	
                $('#imgedit').attr('src',obj['imagepath']);

                 }
                else
                 {
                    $("#editimgmessage").html(obj['msg']);	
                   

                  }
            }
        });
	
	        return false;
	})
});
</script>