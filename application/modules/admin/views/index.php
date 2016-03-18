<body style="background:#F7F7F7;">
<div class="">
<div id="wrapper">

      <div id="login" class="animate form">
                <section class="login_content">
				<?php $showhide=(isset($message)?'none':'block'); ?>
				<div id="loginform" style="display:<?php echo $showhide; ?>;">
                    <?php
$attributes = array('class' => '', 'id' => 'loginform','name'=>'loginform');
 if(isset($logerror))
  {echo "<p>".$logerror."</p>";}
  echo form_open('/admin/',$attributes);
 ?>
                        <h1>Staff Login</h1>
                        <div>
                            
<?php
$data = array(
              'name'        => 'useremail',
			  'type'        => 'email',
              'id'          => 'useremail',
              'value'       => (isset($_POST["useremail"])?$_POST["useremail"]:''),
              'maxlength'   => '1000',
              'size'        => '25',
			  'required'=> 'required',
			  'class'=>'form-control',
			  'placeholder'=>'Enter Email'
			  
            );
echo form_input($data);			
	   ?>

                        </div>
                        <div>
						<?php

$data = array(
              'name'        => 'userpassword',
              'id'          => 'userpassword',
              'value'       => '',
              'maxlength'   => '1000',
              'size'        => '25',
			  'class'        => 'form-control',      
              'required'=> 'required',
			  'class'=>'form-control',
			  'placeholder'=>'Enter Password'
            );

echo form_password($data);
?>		
                        </div>
                        <div>
                            
                            
							<?php $data=array("name"=>"submitbut","value"=>"Log in","class"=>"btn btn-default submit"); echo form_submit($data);?>
							
							<a class="reset_pass" href="javascript:void();" id="lost_pass">Lost your password?</a>
                        </div>
						<?php 
                   echo form_hidden('sendfrom', 'website');
                   echo form_close();
                         ?>
			</div>
			<?php $showhide=(isset($message)?'block':'none'); ?>
			<div style="display:<?php echo $showhide;?>;" id="losspassform">
	<?php
$attributes = array('class' => '', 'id' => 'forgotform','name'=>'forgotform');
 if(isset($message))
  {echo $message;}
 

 echo form_open('/admin/lostpassword',$attributes);
 
?>		
<h1>Lost Password</h1>
<div>
&nbsp;
</div>
<div>
                            
<?php
$data = array(
              'name'        => 'emailbyuser',
			  'type'        => 'email',
              'id'          => 'emailbyuser',
              'value'       => (isset($_POST["emailbyuser"])?$_POST["emailbyuser"]:''),
              'maxlength'   => '1000',
              'size'        => '25',
			  'required'=> 'required',
			  'class'=>'form-control',
			  'placeholder'=>'Enter Email'
			  
            );
echo form_input($data);			
	   ?>

</div>
<div>&nbsp;</div>
<div>
                            
                            
<?php $data=array("name"=>"submit","value"=>"Submit","class"=>"btn btn-default submit"); echo form_submit($data);?>
							
<a class="reset_pass" href="javascript:void();"  id="user_login">Log In</a>
</div>					
						
			<?php 
                   echo form_hidden('sendfrom', 'website');
                   echo form_close();
            ?>
			</div>
			
                        <div class="clearfix"></div>
						
                        <div class="separator">

                            <p class="change_link">New to Canal View?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                    <a href="../index.php"><img src="../img/logo_c.png" style="height:40px; width:auto; margin-bottom:30px"></a>

                                <p>© 2015 Canal View. All Rights Reserved. <br>Powered by <a href="http://pixelsoftwares.com" target="_blank">Pixel Softwares</a></p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
              </section>
                <!-- content -->
            </div>






</div>



</div>