<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends  MX_Controller 
{ 


    private $datakey;
	private $senddata;
	public function index()
	{
	    $data="";
		if($_POST)
		{
		  if($_POST["submitbut"]=="Sign Up")
		  $data["regerror"]=$this->userreg();
          else
		  $data["logerror"]=$this->login();
		}
		$this->load->view('header_layout');
		$this->load->view('welcome_message',$data);
		$this->load->view('footer_layout');
	}
	public function forget_password()
    {
	$data="";
	 $this->load->view('header_layout');
	 if($_POST)
	 {
	        $data= file_get_contents("php://input");
			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);
			$this->datakey=array_keys($data);
            $this->senddata=$data;
	  $data["forgetpassworderror"]= $this->forget_password_message();
	 }
	$this->load->view('forget_password',$data);
	$this->load->view('footer_layout');
	}
	public function login()
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
			
			$this->load->model('user_model');
			
			$data=array('email_id'=>$data['useremail'],'password'=>$data['userpassword'],'active'=>1);
			
			$count=$this->user_model->has_record('user_login',$data);

			$this->session->set_userdata('valid_user_id', $count);
			}
	
	}
	private function forget_password_message()
	{
	 $this->form_validation->set_rules($this->datakey[0], 'Email', 'required|valid_email');
	 if($this->form_validation->run() == FALSE)
     return validation_errors();
     else
	 {
	              
	      $this->load->model('user_model');
		 $has_record= $this->user_model->has_record("user_login",array("email_id"=>$this->senddata[$this->datakey[0]]));
		 if($has_record)
		 {
		   $has_record= $this->user_model->has_record("user_login",array("email_id"=>$this->senddata[$this->datakey[0]],"password"=>$this->senddata[$this->datakey[1]],"active"=>1));
           if(!$has_record)
		   {
		    return "Please activate your account!";
		   }
		   else
		   {
		    return "";
		   }
		 }
		 else
		 {
		    return "This Email Address Is Not Exist";
		 }
		  
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
	      $this->load->model('user_model');
		  
		 $has_record= $this->user_model->has_record("user_login",array("email_id"=>$this->senddata[$this->datakey[0]],"password"=>$this->senddata[$this->datakey[1]]));
		 if($has_record)
		 {
		   $has_record= $this->user_model->has_record("user_login",array("email_id"=>$this->senddata[$this->datakey[0]],"password"=>$this->senddata[$this->datakey[1]],"active"=>1));
           if(!$has_record)
		   {
		    return "Please activate your account!";
		   }
		   else
		   {
		    return "";
		   }
		 }
		 else
		 {
		    return "Enter valid information";
		 }
		  
	  }
	}
	public function new_password()
	{
	   
	}
	public function active($userid)
	{
     $this->load->model('user_model');       
	 $this->user_model->update_info("user_login","user_id",$userid,array("active"=>1));
	 
	//
	// after active the custome acount then send active info to anroid db
	//
	redirect('/','refresh');
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
			    $this->load->model('user_model');       
				$newid=$this->user_model->insert_data("user_login",array("user_name"=>$data["regname"],"sex"=>$data["sex"],"password"=>$data["regpassword"],"phone_number"=>$data["regphone"],"address"=>$data["regaddress"],"email_id"=>$data["remail"],"user_type"=>"customer"));
				
				if($data["sendfrom"]=="website")
				{
				//-------send values in anroid server
				// for upadte data
				//
				$this->sendemail($newid,$data["regname"],$data["remail"]);
				
				}
                else
				{
                //----send data after save user info from Anroid. 
				$result["message"]="Data has been save";
				}
			     
			 }
			
			
	
	}
	//-----------------------------------------------------------------//
	private function sendemail($id,$userName,$email)
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
		  $this->form_validation->set_rules($this->datakey[4], 'Email', 'required|valid_email|is_unique[user_login.email_id]');
		  
		  $this->form_validation->set_rules($this->datakey[5], 'Phone', 'required|min_length[10]|max_length[15]');
		  
		  $this->form_validation->set_rules($this->datakey[6], 'Address', 'required|max_length[1000]');
		  	    
				if($this->form_validation->run() == FALSE)
                return validation_errors();
                else
				return "";

	}
	
}

