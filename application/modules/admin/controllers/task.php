<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends  MX_Controller 
{

       private $senddata;
       private $datakey;
       public function __construct() 
       {
	   $this->load->model('admin_model');
       parent::__construct();

       }
	   
	   public function employeetask()
	   {
	   
	   if($this->checksession())
	   {
		  $userdata["name"]=$this->get_name();
		  $this->load->view('dashboard_header',$userdata);
		  
		  $getresult= $this->admin_model->getdatawithcondition("user_id,user_name","user_login",array("user_type"=>"employ"));
	      $employee[0]="--Select--";
		  foreach($getresult as $row)
		  {
		  $employee[$row->user_id]=$row->user_name;
		 
		  }
		  $pagedata["employee"]=$employee;
		  $getresult= $this->admin_model->getdatawithcondition("user_id,user_name","user_login",array("user_type"=>"customer"));
	      $customer[0]="--Select--";
		  foreach($getresult as $row)
		  {
		  $customer[$row->user_id]=$row->user_name;
		 
		  }
		  $pagedata["customer"]=$customer;
		  $this->load->view('task/task_for_employee',$pagedata);
          $this->load->view('dashboard_footer');
			 
		}
		else
		{
		redirect('/admin','refresh');  
		
		}
		 
	   }
	   private function get_name()
	   {	
	        $getid= $this->session->userdata('valid_user_id');
		    $data=array('user_id'=>$getid);
		    $userdata["userinfo"]=$this->admin_model->get_info('user_login',$data);
            return $userdata["userinfo"][0]->user_name;

	   
	   }
	   private function checksession()
	   {
	    $getid= $this->session->userdata('valid_user_id');
	     return (empty($getid)?0:1);
	   }

}
?>