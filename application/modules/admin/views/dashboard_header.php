<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ALM</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/fonts/css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
<link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/maps/jquery-jvectormap-2.0.1.css');?>" />
    <link href="<?php echo base_url('assets/css/icheck/flat/green.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/floatexamples.css');?>" rel="stylesheet" />
<style>
.mainimgwrapper {
    position: relative;
    padding: 0;
    width:100%;
    display:block;
}
.editimg {
    position: absolute;
    top: 0;
    color:#f00;
    background-color:rgba(255,255,255,0.8);
    width: 411px;
    height: 274px;
    line-height:274px;
    text-align: center;
    z-index: 10;
    opacity: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.editimg:hover {
    opacity:1;
}

#imgedit {
    z-index:1;
}


</style>
    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
	
	<script src="<?php echo base_url('assets/js/ajaxfileupload.js');?>"></script>
	
<script>
baseurl=function()
         {
		 
         return $("#siteurl").val();
         }

function delete_employ(name,id)
{
    $("#displaymessage").text("Are you sure delete "+name+" information");
    $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function() 
	{

       window.location.href=location.protocol + "//" + location.hostname+"/alm/admin/delete_employee/"+id
		  
    });
}
function delete_row(name,id,type)
{

   if(type=="image")
   {
   $("#deletemessage").text("Are you sure delete this image");
   }
   else
   {
   $("#displaymessage").text("Are you sure delete "+name+" information");
   }
   $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function() 
	{

      if(type=="category")
	  {
	   window.location.href=baseurl()+"admin/design/deletecategory/"+id
	  }
	  else if(type=="design")
	  {
	  window.location.href=baseurl()+"admin/design/delete_design_row/"+id
	  
	  }
	  else if(type=="image")
	  {
	  senddata={"id":id,"tablename":"design_images"};
	  $.post(baseurl()+"admin/design/deleteimage",senddata,function(data)
	  {

	   var obj = jQuery.parseJSON(data);
	   if(obj['status'] == 'success')
	   {
	   $("#imgrow_"+id).remove();
	   }                
	  })
	  
	  }
	  
      });
}
function delete_boutique(name,id)
{
    
	$("#displaymessage").text("Are you sure delete "+name+" information");
    $('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function() 
	{

       window.location.href=location.protocol + "//" + location.hostname+"/alm/admin/delete_boutique/"+id
		  
    });


}

</script>
    </head>
<body class="nav-md">
<input type="hidden" id="siteurl" value="<?php echo base_url();?>">
    <div class="container body">


        <div class="main_container">
		
<div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Canal View</span></a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php $getid= $this->session->userdata('valid_user_id');echo base_url('assets/design/userimages/thumb/'.$getid.'_thumb.jpg');?>" alt="..." class="img-circle profile_img" id="user_profile_pic"/>
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $name; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</span></a></li>
                                <?php
						//echo $this->session->userdata('usertype');
						//die;		
					if($this->session->userdata('usertype')=="admin"):			
								?>
								
                                <li><a><i class="fa fa-users"></i> Registered Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/register'); ?>">Create Employee</a>
                                        </li>
								<li><a href="<?php echo base_url('admin/display_employ'); ?>">Display Employees</a>
                                        </li>
				<li>
				<a href="<?php echo base_url('admin/boutiquereg');?>">Register Boutique </a>
                </li>
				<li>
				<a href="<?php echo base_url('admin/display_boutique');?>">Display Boutique</a>
                </li>		
				<li>
				<a href="<?php echo base_url('admin/display_customer');?>">Display Customer </a>
                </li>		
				</ul>
               </li>
	<li><a><i class="fa"></i> Design <span class="fa fa-chevron-down"></span></a>
   <ul class="nav child_menu" style="display: none">
   <li><a href="<?php echo base_url('admin/design/category');?>">Add category</a>
   </li>
 <li><a href="<?php echo base_url('admin/design/displaycategory');?>">Display category</a>
                                        </li>
 <li><a href="<?php echo base_url('admin/design/createdesign');?>">Add Design</a>
                                        </li>
<li><a href="<?php echo base_url('admin/design/displaydesign');?>">Display Design</a>
                                        </li>
										
                                    </ul>
                                </li>
<li><a><i class="fa"></i> Task <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu" style="display: none">
<li><a href="<?php echo base_url('admin/task/employeetask');?>">Task For Employee</a>
 </li>
 <li><a href="#">Task For Boutique</a>
 </li>
</ul>
</li>								
								<?php
								endif;
								?>
								
                                <li><a><i class="fa fa-file-text"></i> Inventory and Billing <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="file:///D|/wamp/www/tables.html">Tables</a>
                                        </li>
                                        <li><a href="file:///D|/wamp/www/tables_dynamic.html">Table Dynamic</a>
                                        </li>
                                    </ul>
                                </li>

                          <li><a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-sign-out"></i> Logout </span></a></li>
                            </ul>
                        </div>
                        

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="../logout.php" data-toggle="tooltip" data-placement="top" title="Logout hh">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
			<!-- top navigation -->
			<div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $name; ?>
								<span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo base_url('admin/profile');?>">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/setting');?>">
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                  <li><a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="file:///D|/wamp/www/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="file:///D|/wamp/www/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="file:///D|/wamp/www/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="file:///D|/wamp/www/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                              </ul>
                          </li>

                      </ul>
                    </nav>
                </div>

          </div>