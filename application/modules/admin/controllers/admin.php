<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends  MX_Controller 
{ 
       private $senddata;
       private $datakey;
	   public function __construct() 
       {
	   $this->load->model('admin_model');
        parent::__construct();

       }
	   private function small_img($filename)
	  {
	    $this->load->library('image_lib');
		$config['image_library'] = 'gd2';
        $config['source_image']	= 'assets/design/userimages/original_img/'.$filename.'';
        $config['new_image'] = 'assets/design/userimages/thumb/';
		$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;

        $config['width']	 =128;
        $config['height']	= 128;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	    $this->image_lib->clear();
	}

public function add_img_by_ajax()
  {
	  	   
		$status = "";
        $msg = "";
        $file_element_name = 'userfile';
 
    
	  
   if ($status != "error")
   {

   $getid= $this->session->userdata('valid_user_id');
   $image_filename=$getid.".jpg";
   $config['upload_path'] = 'assets/design/userimages/original_img';
   $config['allowed_types'] = 'gif|jpg|png';
   $config['max_size'] = 1024 * 8;
   $config['file_name'] = $image_filename;
   $config['overwrite'] = TRUE;
   $config['encrypt_name'] = FALSE;

  $this->load->library('upload', $config);
  if (!$this->upload->do_upload($file_element_name))
  {
    $status = 'error';
    $msg = $this->upload->display_errors('', '');
	$imagepath='';
	
  }
  else
   {
   $data = $this->upload->data();

   $image_path = $data['full_path'];

   if(file_exists($image_path))
   {
      $this->small_img($image_filename);
	  
	  $status = "success";
      $msg = "File successfully uploaded";
	  $filename=str_replace(".","_thumb.",$image_filename);
	  $imagepath=base_url('assets/design/userimages/thumb/'.$filename.'');
  }
  else
  {
  $status = "error";
  $msg = "Something went wrong when saving the file, please try again.";
  $imagepath="";

 }
}
 @unlink($_FILES[$file_element_name]);
 }
 echo json_encode(array('status' => $status, 'msg' => $msg, 'imagepath'=>$imagepath));
		
}
	   public function account_active($id)
	   {
	     $getid= $this->session->userdata('valid_user_id');
	     $this->admin_model->update_info("user_login","login_id",$id,array('active'=>1));		
	     $this->session->sess_destroy();
	     redirect('/admin','refresh');
	   }
	   public function new_password()
	   {
	        $data="";
	          if($this->checksession())
		      {
			  redirect('/admin/dashboard','refresh');
			  }
			  else
			  {
	           
			   $this->load->view('header');
              if($_POST)
			  {
			 
			      $data["message"]=$this->newpasswordupdate();

			  }
			   $this->load->view('forgatepassword',$data);
              
			   $this->load->view('footer');
			   }
	   
	   }
	   public function lostpassword()
	   {
            $datamessage="";
			if($_POST)
			{
			   $data= file_get_contents("php://input");
			   $data = strip_tags($data);
               $clean_input = trim($data);
               $data = array();
               parse_str($clean_input, $data);
			   $this->datakey=array_keys($data);
			   $this->senddata=$data;     
			   $error=$this->check_email_for_lost_password();
			   if(!empty($error))
			   {
			   
			    $datamessage["message"]=$error;
			   }
			   else
			   {

			$result=$this->admin_model->getdatawithcondition("user_name","user_login",array("email_id"=>$data["emailbyuser"]));
			    
				if(!count($result))
				$datamessage["message"]="This email address is not exist!";
				else
				{
				$this->send_email_for_forgate_password($data["emailbyuser"],$result[0]->user_name);
				$datamessage["message"]="Go to your email id ".$data["emailbyuser"]." for password recover";
				}
			   }
			   $this->load->view('header');
               $this->load->view('index',$datamessage);
               $this->load->view('footer');
			   
			}
			else
			{
			    redirect('/admin','refresh');
			}
	   
	   }
	   	private function send_email_for_forgate_password($email,$username)
	   {

	     $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.googlemail.com',
         'smtp_port' => 465,
         'smtp_user' => 'manojjoshi.joshi@gmail.com',
         'smtp_pass' => 'gozotality@123',
         'mailtype'  => 'html', 
         'charset'   => 'iso-8859-1');
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");

         $this->email->from('manojjoshi.joshi@gmail.com', 'manoj joshi');
         $this->email->to($email);
         $data["userName"]=$username;

		 
         $this->email->subject('Lost Password mail');
		 $body=$this->load->view('email/email_lost_password.php',$data,TRUE);
         $this->email->message($body); 
         $result = $this->email->send();
	   }
	   public function newpasswordupdate()
	   {
	      
		  
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			$this->datakey=array_keys($data);
			$this->senddata=$data;     
	        
			return $this->newpasswordforloss();
		  
	   }
	   
	   private function newpasswordforloss()
	   {

	        $this->form_validation->set_rules($this->datakey[0], 'Email', 'required|valid_email');
	        $this->form_validation->set_rules($this->datakey[1], 'New Password', 'trim|min_length[6]|required|required|matches['.$this->datakey[2].']');
		    $this->form_validation->set_rules($this->datakey[2], 'Confirm Password', 'trim|min_length[6]|required');
            if($this->form_validation->run() == FALSE)
			{
                     return validation_errors();
			}
            else
			{
				   
		   	  $count= $this->admin_model->countresult(array("email_id"=>$this->senddata[$this->datakey[0]]),"user_login");
			  if($count)
			  {
			    $this->admin_model->update_info("user_login","email_id",$this->senddata[$this->datakey[0]],array("password"=>$this->senddata[$this->datakey[1]]));
			  
			     return "Your password has been updated";
			  }
			  else
			  {
			    return "Email address not found in database";
			  
			  }
			} 
	   }
	   public function password_update()
	   {
	
	       if($this->checksession())
		   {
		      
		      $data="";
		      if($_POST)
			  {
			  $userdata["name"]=$this->get_name();
              $this->load->view('dashboard_header',$userdata);
			  $data["passwordmessage"]= $this->update_my_password();
			  $this->load->view('setting',$data);
			  $this->load->view('dashboard_footer');
			  }
			  else
			  {
			  redirect('/admin/setting','refresh');
			  }
		  }
		   else
		   {
		       redirect('/admin','refresh');
		   
		   }
	
	   }
	   private function check_password()
	   {
	   
	        $this->form_validation->set_rules($this->datakey[0], 'Old Password', 'trim|min_length[6]|required');
		    $this->form_validation->set_rules($this->datakey[1], 'New Password', 'trim|min_length[6]|required');
            if($this->form_validation->run() == FALSE)
			{
                     return validation_errors();
			}
            else
			{
			$get_id= $this->session->userdata('valid_user_id');
			
$haspassowrd=$this->admin_model->countresult(array("user_id"=>$get_id,"password"=>$this->senddata[$this->datakey[0]]),"user_login");
           if($haspassowrd)
		   {
				   return "";
		   }
		   else
		   {
		   return "Your Old Passward is not valid. Please enter valid password";
		   
		   }	   
			} 
	   
	   }
	   public function update_my_password()
	   {
	      
		    $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			$this->datakey=array_keys($data);
			$this->senddata=$data;     
			$error=$this->check_password();  
			   
			if(!empty($error))
			 {
			    if($data["sendfrom"]=="website")
			    {
				return $error;
			    }
				else
				{
				// send error message when data come from anroid........
				echo $error;
				die;
				}
			 }   
			 else
			 {
			 
			 $get_id= $this->session->userdata('valid_user_id');
			 
	$this->admin_model->update_info("user_login","user_id",$get_id,array("password"=>$data["newpassword"]));		
			
			if($data["sendfrom"]=="website")
			    {
	             return "Your Password has been update!";
				}
				else
				{
				// send error message when data come from anroid........
	$data["message"]="Your Password has been update!";
				die;
				}
			 
			 
			 } 
			   
			   
			   
			   
			   
			     
	   
	   }
       public function update_email()
	   {
	       if($this->checksession())
		   {
		      
		      $data="";
		      if($_POST)
			  {
			  $userdata["name"]=$this->get_name();
              $this->load->view('dashboard_header',$userdata);
			  $data["message"]= $this->update_my_email();
			  $this->load->view('setting',$data);
			  $this->load->view('dashboard_footer');
			  }
			  else
			  {
			  redirect('/admin/setting','refresh');
			  }
		  }
		   else
		   {
		       redirect('/admin','refresh');
		   
		   }
	   
	   }
	   public function index()
	   {
	       if($this->checksession())
		   {
		   redirect('/admin/dashboard','refresh');
		   die;
		   }
	   
	       $data="";
	       $this->load->view('header');
		   if($_POST)
		   {
		   
		   $data["logerror"]=$this->login();
		   }
		
		   $this->load->view('index',$data);
		   $this->load->view('footer');
	
	   }
	public function boutiquereg()
	{
	          $data="";
			  
			  if($_POST)
			  {
			    $data["regerror"]= $this->sendboutiquereg();
				$data["actiontype"]=(isset($_POST["actiontype"])?$_POST["actiontype"]:'');
                $data["userid"]=(isset($_POST["userid"])?$_POST["userid"]:'');
			  }
			  else
			  {
			  $userdata["actiontype"]="add";
			  }
		      $userdata["name"]=$this->get_name();
              $this->load->view('dashboard_header',$userdata);
	          $this->load->view('boutique_register',$data);
	          $this->load->view('dashboard_footer');

		
		  
	}
	// synchronize with anroid---------
	//===========================
	public function update_my_email()
	{
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			$this->datakey=array_keys($data);
			$this->senddata=$data;
            $error=$this->check_email();
			if(!empty($error))
			 {
			    if($data["sendfrom"]=="website")
			    {
				return $error;
			    }
				else
				{
				// send error message when data come from anroid........
				echo $error;
				die;
				}
			 }
			 else
			 {
			 $get_id= $this->session->userdata('valid_user_id');
			 
	$this->admin_model->update_info("user_login","user_id",$get_id,array("email_id"=>$data["remail"],'active'=>0));		
	$username=$this->admin_model->getdatawithcondition("user_name","user_login",array("user_id"=>$get_id));
	$this->send_active_message($username[0]->user_name,$data["remail"],$get_id);
			 
			    if($data["sendfrom"]=="website")
			    {
	$this->session->sess_destroy();
    return "Your Email id has been update for active your account go to the email id:".$data["remail"]."";
				
			    }
				else
				{
				// send error message when data come from anroid........
	$data["message"]="Your Email id has been update for active your account go to the email id:".$data["remail"]."";
				die;
				}
			 
			 
			 }
	      
	}
	private function check_email_for_lost_password()
	{
	     
		 
$this->form_validation->set_rules($this->datakey[0], 'Email', 'required|valid_email');
	      
				
				if($this->form_validation->run() == FALSE)
				{
                     return validation_errors();
				}
                else
				{
				   
				   return "";
				}

	
	
	}
	private function check_email()
	{
	   $this->form_validation->set_rules($this->datakey[0], 'Email', 'required|valid_email|is_unique[user_login.email_id]');
	      
				
				if($this->form_validation->run() == FALSE)
				{
                     return validation_errors();
				}
                else
				{
				   
				   return "";
				}

	
	
	}
	//===============================================================
	//==============================================================
	private function send_active_message($userName,$email,$id)
	{
	 $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.googlemail.com',
         'smtp_port' => 465,
         'smtp_user' => 'manojjoshi.joshi@gmail.com',
         'smtp_pass' => 'gozotality@123',
         'mailtype'  => 'html', 
         'charset'   => 'iso-8859-1');
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");

         $this->email->from('manojjoshi.joshi@gmail.com', 'manoj joshi');
         $this->email->to($email);
         $data["userName"]=$userName;
		 $data["id"]=$id;
		 
         $this->email->subject('Account varification mail');
		 $body=$this->load->view('email/email_active.php',$data,TRUE);
         $this->email->message($body); 
         $result = $this->email->send();
	
	
	}
	public function sendboutiquereg()
	{
	
	       	$data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			
			$this->datakey=array_keys($data);
			
			$this->senddata=$data;
		    
			$error=$this->reg_boutique();
			if(!empty($error))
			 {
			    if($data["sendfrom"]=="website")
			    {
				return $error;
			    }
				else
				{
				// send error message when data come from anroid........
				echo $error;
				die;
				}
			 }
			 else
			 {
       
	    if($data["actiontype"]=="add")
	    {
$newid=$this->admin_model->insert_data("boutique_info",array("name"=>$data["regname"],"sex"=>$data["sex"],"phone_numeber"=>$data["regphone"],"address"=>$data["regaddress"],"email_address"=>$data["remail"]));
		}else
		{
		
		$this->admin_model->update_info("boutique_info","boutique_id",$data["userid"],array("name"=>$data["regname"],"sex"=>$data["sex"],"phone_numeber"=>$data["regphone"],"address"=>$data["regaddress"],"email_address"=>$data["remail"]));
		}		
				if($data["sendfrom"]=="website")
				{
				//-------send values in anroid server
				// for upadte data
				//
				
                redirect('/admin/display_boutique','refresh'); 	
				}
                else
				{
                //----send data after save user info from Anroid. 
				$result["message"]="Data has been save";
				}
			     
			 }

	}
	public function delete_boutique($id)
	{
	    if($this->checksession())
		   {
		     $this->admin_model->row_delete_with_othertable("boutique_info",array("boutique_id"=>$id));
             redirect('/admin/display_boutique','refresh');
           }
		   else
		   {
		     redirect('/admin','refresh');
		   }
	
	}
	public function delete_employee($id)
	{
	       if($this->checksession())
		   {
		   
		    $this->admin_model->row_delete_with_othertable("user_login",array("user_id"=>$id));
            redirect('/admin/display_employ','refresh');
		   }else
		   {
		   redirect('/admin','refresh');
		   }
	
	}
	public function setting()
	{
	    if($this->checksession())
		   {
		   $userdata["name"]=$this->get_name();
	       $this->load->view('dashboard_header',$userdata);
           $this->load->view('setting');
		   $this->load->view('dashboard_footer');
		   }else
		   {
		   
		   redirect('/admin','refresh');
		   }
	
	}
	public function display_boutique()
	{
	
	     
		   if($this->checksession())
		   {
		      
			  	  if($this->checksession()==1)
		          {
				    
		            
		            $userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);

	    $boutique["boutique"]=$this->admin_model->getalldata("boutique_id,name,sex,email_address,phone_numeber,address","boutique_info",10, 0);
		
		            $this->load->view('admin/boutique_details',$boutique);
		            $this->load->view('dashboard_footer');
		         }else
		         {
		         redirect('/admin','refresh');
		         }
			  
		   
		   }else
		   {
		   redirect('/admin','refresh'); 	
		   }
		 
	        
	
	
	}
	public function editemploy($id)
	{
	   if($this->checksession())
	   {
	        $count=$this->admin_model->countresult(array("user_id"=>$id),"user_login");
		    
			if(!$count)
			{
			 redirect('/admin/dashboard','refresh'); 	
			}
				   
				    $userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);
			        $userprofile["actiontype"]="edit";
			        $userprofile["userid"]=$id;
					
                    $userprofile["employ_info"]=$this->admin_model->getdatawithcondition("user_name,sex,password,phone_number,address,email_id","user_login",array("user_id"=>$id));
				   
				   $this->load->view('admin/user_register',$userprofile);
				   $this->load->view('dashboard_footer');
	   }
	   else
	   {
	                redirect('/admin','refresh'); 	
	   }
	
	}
	public function display_customer()
	{
	       if($this->checksession())
		   {
		            $userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);

	    $customerdata["customer"]=$this->admin_model->getdatawithconditionwith_limit("user_id,user_name,sex,password,phone_number,address,email_id","user_login",array("user_type"=>'customer'),10,0);
		
		            $this->load->view('admin/customer_details',$customerdata);
		            $this->load->view('dashboard_footer');
		         
			  
		   
		   }else
		   {
		   redirect('/admin','refresh'); 	
		   }
		
	
	}

	public function display_employ()
	{
	       if($this->checksession())
		   {
		            $userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);

	    $employdata["employ"]=$this->admin_model->getdatawithconditionwith_limit("user_id,user_name,sex,password,phone_number,address,email_id","user_login",array("user_type"=>'employ'),10,0);
		
		            $this->load->view('admin/employ_details',$employdata);
		            $this->load->view('dashboard_footer');
		         
			  
		   
		   }else
		   {
		   redirect('/admin','refresh'); 	
		   }
		
	
	}
	public function editboutique($id)
	{
	       if($this->checksession())
		   {
		   
		     $count=$this->admin_model->countresult(array("boutique_id"=>$id),"boutique_info");
		     if(!$count)
			 {
			 redirect('/admin/dashboard','refresh'); 	
			 }
			 
			 $userprofile="";
			 $userdata["name"]=$this->get_name();
			 $userdata["actiontype"]="edit";
			 $userdata["userid"]=$id;
	         $this->load->view('dashboard_header',$userdata);
			 $userprofile["profile_info"]=$this->admin_model->getdatawithcondition("name,sex,email_address,	phone_numeber,address","boutique_info",array("boutique_id"=>$id));
			 $this->load->view('boutique_register',$userprofile);
			 $this->load->view('dashboard_footer');
		   }
		   else
		   {
		   redirect('/admin','refresh');
		   }
		   
	}
	public function editprofile()
	{
	    
		   if($this->checksession())
		   {
             $userprofile="";
			 $userdata["name"]=$this->get_name();
	         $this->load->view('dashboard_header',$userdata);
		      if($_POST)
			  {
			  $userprofile["regerror"]=$this->editprofile_validate();
			  }
			  else
			  {
		       $userprofile["profile_info"]=$this->admin_model->getdatawithcondition("user_name,sex,phone_number,address","user_login",array("user_id"=>$this->session->userdata('valid_user_id')));
	          }

			 $this->load->view('admin/edit_profile',$userprofile);	   
		     
			 $this->load->view('dashboard_footer');
		   
		   }else
		   {
		   
		   redirect('/admin','refresh');
		   }

		
	
	}   
	private function edit_profile_validate()
	{
	
	       $this->form_validation->set_rules(
              $this->datakey[0], 'Name',
              'required|max_length[100]',
              array(
                'required'      => 'You have not provided %s.'
                ));
		  
		  
		  
		  $this->form_validation->set_rules($this->datakey[2], 'Phone', 'required|min_length[10]|max_length[15]');
		  
		  $this->form_validation->set_rules($this->datakey[3], 'Address', 'required|max_length[1000]');
		  	    
				if($this->form_validation->run() == FALSE)
                return validation_errors();
                else
				return "";

	
	}
	//----web api for syncroizetion----------//
	public function editprofile_validate()
	{
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			
			$this->datakey=array_keys($data);
			$this->senddata=$data;
			$error=$this->edit_profile_validate();
			if(!empty($error))
			 {
			    if($data["sendfrom"]=="website")
			    {return $error;
			    }
				else
				{
				// send error message when data come from anroid........
				echo $error;
				die;
				}
			 }
			 else
			 {
       			$valid_user_id=$this->session->userdata('valid_user_id');
				$this->admin_model->update_info("user_login","user_id",$valid_user_id,array("user_name"=>$data["regname"],"sex"=>$data["sex"],"phone_number"=>$data["regphone"],"address"=>$data["regaddress"]));
				
				if($data["sendfrom"]=="website")
				{
				//-------send values in anroid server
				// for upadte data
				//
				
			    redirect('/admin/profile','refresh'); 	
				}
                else
				{
                //----send data after save user info from Anroid. 
				$result["message"]="Data has been update";
				}
			     
			 }
			
			
	
	}
	//-----------------------------------------------------------------//
	//-----------------------------------------------------------------//
	
	public function profile()
	{
	   if($this->checksession())
		   {
             
			 $userdata["name"]=$this->get_name();
	         $this->load->view('dashboard_header',$userdata);
		      
		     $userprofile["profile_info"]=$this->admin_model->getdatawithcondition("user_name,sex,phone_number,email_id,address","user_login",array("user_id"=>$this->session->userdata('valid_user_id')));
	         
			 $this->load->view('admin/profile_details',$userprofile);	   
		     
			 $this->load->view('dashboard_footer');
		   
		   }else
		   {
		   
		   redirect('/admin','refresh');
		   }
	
	
	}
	//----web api for syncroizetion----------//
	public function userreg()
	{
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			
			$this->datakey=array_keys($data);
			$this->senddata=$data;
			$error=$this->reg_user();
			if(!empty($error))
			 {
			    if($data["sendfrom"]=="website")
			    {return $error;
			    }
				else
				{
				// send error message when data come from anroid........
				echo $error;
				die;
				}
			 }
			 else
			 {
       
	           if($data["actiontype"]=="add")
	            {
				$newid=$this->admin_model->insert_data("user_login",array("user_name"=>$data["regname"],"sex"=>$data["sex"],"password"=>$data["regpassword"],"phone_number"=>$data["regphone"],"address"=>$data["regaddress"],"email_id"=>$data["remail"],"user_type"=>"employ","active"=>1));
				}
				else
		        {
		$this->admin_model->update_info("user_login","user_id",$data["userid"],array("user_name"=>$data["regname"],"sex"=>$data["sex"],"password"=>$data["regpassword"],"phone_number"=>$data["regphone"],"address"=>$data["regaddress"],"email_id"=>$data["remail"]));
		       }
				
				if($data["sendfrom"]=="website")
				{
				//-------send values in anroid server
				// for upadte data
				//
				$this->sendemail($data["regname"],$data["remail"],$data["regpassword"]);
			    redirect('/admin/display_employ','refresh'); 	
				}
                else
				{
                //----send data after save user info from Anroid. 
				$result["message"]="Data has been save";
				}
			     
			 }
			
			
	
	}
	//-----------------------------------------------------------------//
	//-----------------------------------------------------------------//
	private function sendemail($userName,$email,$password)
	{
	     $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.googlemail.com',
         'smtp_port' => 465,
         'smtp_user' => 'manojjoshi.joshi@gmail.com',
         'smtp_pass' => 'gozotality@123',
         'mailtype'  => 'html', 
         'charset'   => 'iso-8859-1');
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");

         $this->email->from('manojjoshi.joshi@gmail.com', 'manoj joshi');
         $this->email->to($email);
         $data["userName"]=$userName;
		 $data["email"]=$email;
		 $data["password"]=$password;
         $this->email->subject('Account varification mail');
		 $body=$this->load->view('email/email_temp.php',$data,TRUE);
         $this->email->message($body); 
         $result = $this->email->send();
	
	}
	private function reg_user()
	{
		      $this->form_validation->set_rules(
              $this->datakey[0], 'Name',
              'required|max_length[100]',
              array(
                'required'      => 'You have not provided %s.'
                ));
		  
		  $this->form_validation->set_rules($this->datakey[2], 'Password', 'trim|min_length[6]|required|matches['.$this->datakey[3].']');
		  $this->form_validation->set_rules($this->datakey[3], 'Confirm Password', 'trim|min_length[6]|required');
	
	
	  if($this->senddata[$this->datakey[9]]=="add")
	  {
	  $this->form_validation->set_rules($this->datakey[4], 'Email', 'required|valid_email|is_unique[user_login.email_id]');
	  }
	  else
	  {
	   $this->form_validation->set_rules($this->datakey[4], 'Email', 'required|valid_email');
	  }	  
		  $this->form_validation->set_rules($this->datakey[5], 'Phone', 'required|min_length[10]|max_length[15]');
		  
		  $this->form_validation->set_rules($this->datakey[6], 'Address', 'required|max_length[1000]');
		  	    
				if($this->form_validation->run() == FALSE)
                return validation_errors();
                else
				{
				   if($this->senddata[$this->datakey[9]]=="edit")
				   {
				     $count= $this->admin_model->countresult("(email_id='".$this->senddata[$this->datakey[2]]."' and user_id!=".$this->senddata[$this->datakey[10]].")",'user_login'); 
					 if($count)
					 {  
					 return "This email allready exist!";
					 }
					 else
					 {
					 return "";
					 }
				   }
				   else
				   {
				     return ""; 
				   }
				}

	}
    private function reg_boutique()
    {
        
		$this->form_validation->set_rules(
              $this->datakey[0], 'Name',
              'required|max_length[100]',
              array(
                'required'      => 'You have not provided %s.'
                ));
		  
          if($this->senddata[$this->datakey[7]]=="add")
		  {		  
	$this->form_validation->set_rules($this->datakey[2], 'Email', 'required|valid_email|is_unique[boutique_info.email_address]');
	       }
		  else
		  {
		  $this->form_validation->set_rules($this->datakey[2], 'Email', 'required|valid_email');		  
		  } 
		  $this->form_validation->set_rules($this->datakey[3], 'Phone', 'required|min_length[10]|max_length[15]');
		  $this->form_validation->set_rules($this->datakey[4], 'Address', 'required|max_length[1000]');

				
				if($this->form_validation->run() == FALSE)
				{
                     return validation_errors();
				}
                else
				{
				   if($this->senddata[$this->datakey[7]]=="edit")
				   {
				     $count= $this->admin_model->countresult("(email_address='".$this->senddata[$this->datakey[2]]."' and boutique_id!=".$this->senddata[$this->datakey[8]].")",'boutique_info'); 
					 if($count)  
					 return "This email allready exist!";
					 else
					 return "";
				   }
				   return "";
				}

    }
	
	   private function get_name()
	   {	
	        $getid= $this->session->userdata('valid_user_id');
		    $data=array('user_id'=>$getid);
		    $userdata["userinfo"]=$this->admin_model->get_info('user_login',$data);
            return $userdata["userinfo"][0]->user_name;

	   
	   }
	   public function register()
	   {
	   
	       if($this->checksession())
		   {
		   $userdata["name"]=$this->get_name();
		     $data="";
		     if($_POST)
			 {
			 $data["regerror"]=$this->userreg();
			 $data["actiontype"]=(isset($_POST["actiontype"])?$_POST["actiontype"]:'');
			 $data["userid"]=(isset($_POST["userid"])?$_POST["userid"]:'');
			 }else
		     {
			 $data["actiontype"]="add";
			 }
             $this->load->view('dashboard_header',$userdata);
	         $this->load->view('user_register',$data);
	         $this->load->view('dashboard_footer');
           }
		   else
		   {
		    redirect('/admin','refresh');
		   }
	   
	}
	public function logout()
	{
	$this->session->sess_destroy();
	redirect('/admin','refresh');
	}
	private function checksession()
	{
	  $getid= $this->session->userdata('valid_user_id');
	  return (empty($getid)?0:1);
	}
	 public function dashboard()
	 {
	     if($this->checksession())
		 {
		   $userdata["name"]=$this->get_name();
           $this->load->view('dashboard_header',$userdata);
	       $this->load->view('dashboard');
	       $this->load->view('dashboard_footer');
		 }
		 else
		 {
		 redirect('/admin','refresh');
		 }
	 }  
	  private function login()
	  {
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			$this->datakey=array_keys($data);
			$this->senddata=$data;
			$error=$this->login_user();	
			if(!empty($error))
			{
			return $error;
			}
			else
			{
$data=array('email_id'=>$data['useremail'],'password'=>$data['userpassword'],'active'=>1);
			
			$result=$this->admin_model->getdatawithcondition('user_id,user_type','user_login',$data);

            $this->session->set_userdata('valid_user_id', $result[0]->user_id);
			$this->session->set_userdata('usertype',$result[0]->user_type);
			redirect('admin/dashboard','refresh');
			
			}
	
	}
	private function login_user()
	{

	 $this->form_validation->set_rules($this->datakey[1], 'Password', 'trim|min_length[6]|required');
	 $this->form_validation->set_rules($this->datakey[0], 'Email', 'required|valid_email');
	 if($this->form_validation->run() == FALSE)
     return validation_errors();
     else
	 {
		$get_record=$this->admin_model->getdatawithcondition("user_id,user_type,active","user_login",array("email_id"=>$this->senddata[$this->datakey[0]],"password"=>$this->senddata[$this->datakey[1]]));
		 $has_record= count($get_record);

		 if($has_record)
		 {
		   
		   $has_type=$get_record[0]->user_type;
		   $has_active=$get_record[0]->active;
		   if($has_type!="admin" && $has_type!="employ")
		   return "You are not member of staff";
		   else
		   {
		     if(!$has_active)
		      {
		       return "Your account is not activate.<br/>Please go to your email id:".$this->senddata[$this->datakey[0]]." for activate your account";
		      }
		      else
		      {
			   return "";
		      }
		   }
		   
		 }
		 else
		 {
		    return "Enter valid information";
		 }
		  
	  }
	}
	   
}

?>