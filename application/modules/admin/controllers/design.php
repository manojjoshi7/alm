<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Design extends  MX_Controller 
{ 
       private $senddata;
       private $datakey;
      public function __construct() 
       {
	   $this->load->model('admin_model');
        parent::__construct();

       }
	   public function delete_design_row($id)
	   {
	     if($this->checksession())
		  {
		  $this->delete_design($id);
		  redirect('/admin/design/displaydesign','refresh');  
		  }
		  else
		  {
		  redirect('/admin','refresh');  
		  }
	   
	   }
	   private function delete_design($id)
	   {
	     if($this->checksession())
		  {
			$getresult=$this->admin_model->getdatawithcondition("images_name","our_design",array("design_id"=>$id));
	        if(count($getresult))
			{
			$images_name= $getresult[0]->images_name;	   
		    $smallimage=str_replace(".","_thumb.",$getresult[0]->images_name);
            @chmod('assets/design/designupload/admin/large/'.$getresult[0]->images_name.'', 0777);
	        unlink('assets/design/designupload/admin/large/'.$getresult[0]->images_name.'');
            @chmod('assets/design/designupload/admin/small/'.$smallimage.'', 0777);
            unlink('assets/design/designupload/admin/small/'.$smallimage.'');
            @chmod('assets/design/designupload/admin/thumb/'.$smallimage.'', 0777);
            unlink('assets/design/designupload/admin/thumb/'.$smallimage.'');
            }
			$getresult=$this->admin_model->getdatawithcondition("img_name","design_images",array("design_id"=>$id)); 
		    foreach($getresult as $row)
			{
			 $images_name= $row->img_name;	   
		     $smallimage=str_replace(".","_thumb.",$images_name);
             @chmod('assets/design/designupload/admin/large/'.$images_name.'', 0777);
	         unlink('assets/design/designupload/admin/large/'.$images_name.'');
             @chmod('assets/design/designupload/admin/small/'.$smallimage.'', 0777);
             unlink('assets/design/designupload/admin/small/'.$smallimage.'');
             @chmod('assets/design/designupload/admin/thumb/'.$smallimage.'', 0777);
             unlink('assets/design/designupload/admin/thumb/'.$smallimage.'');
			}
			$this->admin_model->row_delete_with_othertable("our_design",array("design_id"=>$id));
			$this->admin_model->row_delete_with_othertable("design_images",array("design_id"=>$id));
			return true;
            	   
		  }else
		  {
				   
				   redirect('/admin','refresh');  
		  }
	      
	   }
	   public function editdesign($id=NULL)
	   {
	   
         	       
		   if($this->checksession())
		   {
		     
			 $count=$this->admin_model->countresult(array("design_id"=>$id),"our_design");
		    
			 if(!$count)
			 redirect('/admin/design/displaydesign','refresh');  
			 
			
			if($_POST)
			{
			   $designdata["hold_id"]=$_POST["hold_id"];
			   $error=$this->new_design();
			   if(empty($error))
			   {
			   $this->admin_model->update_info("our_design","design_id",$_POST["hold_id"],array("name"=>$_POST["designname"],"cat_id"=>$_POST["designcategory"],"design_info"=>$_POST["designinfo"],"price"=>$_POST["designprice"]));
			   redirect('/admin/design/displaydesign','refresh');    
			   }
			   else
			   {
			   $designdata["error"]= $error;
			   }
			   
			}
			else
			{
			
			$getresult=$this->admin_model->getdatawithcondition("images_name,name,cat_id,design_info,price","our_design",array("design_id"=>$id));
			
		   $designdata["nameofdesign"]= $getresult[0]->name;
		   $designdata["category_id"]=$getresult[0]->cat_id;
		   $designdata["images_name"]= $getresult[0]->images_name;
		   $designdata["info"]= $getresult[0]->design_info;
		   $designdata["price"]= $getresult[0]->price;
		   $designdata["hold_id"]=$id;
		   }
		   
           $result= $this->admin_model->getdatawithfieldname("cat_id,name","category");
		   $category='';
		    foreach($result as $row)
		    {
		    $category[$row->cat_id]=$row->name;
		    }
           
		   $designdata['category']=$category;
		   $userdata["name"]=$this->get_name();
		   $this->load->view('dashboard_header',$userdata);
           $this->load->view('design/editdesign',$designdata);
           $this->load->view('dashboard_footer');
		   }
		   else
		   {
		   redirect('/admin','refresh');  
		   }	   
	   
	   
	   }
	   public function viewdesign($id)
	   {
	       
		   if($this->checksession())
		   {
		     $count=$this->admin_model->countresult(array("design_id"=>$id),"our_design");
		    
			 if(!$count)
			 redirect('/admin/design/displaydesign','refresh');  
		   $userdata["name"]=$this->get_name();
		   $getresult=$this->admin_model->getdatawithcondition("images_name,name,design_info,price","our_design",array("design_id"=>$id));
		   $data["nameofimage"]= $getresult[0]->name;
		   $data["images_name"]= $getresult[0]->images_name;
		   $data["design_info"]= $getresult[0]->design_info;
		   $data["price"]= $getresult[0]->price;
		   $data["design_name"]=$getresult[0]->name;
$data["design_images"]=$this->admin_model->getdatawithcondition("img_id,img_name","design_images",array("design_id"=>$id));
           
		   $this->load->view('dashboard_header',$userdata);
           $this->load->view('design/viewdesign',$data);
           $this->load->view('dashboard_footer');

		   }else
		   {
		   redirect('/admin','refresh');  
		   }
	   
	   }
	   public function adddesignimage($id)
	   {
	       if($this->checksession())
		   {
		     $count=$this->admin_model->countresult(array("design_id"=>$id),"our_design");
		    
			 if(!$count)
			 redirect('/admin/design/displaydesign','refresh');  
		      $userdata["name"]=$this->get_name();
			 $getresult=$this->admin_model->getdatawithcondition("images_name,name","our_design",array("design_id"=>$id));
		     $data["images_name"]= $getresult[0]->images_name;
			 $data["design_name"]=$getresult[0]->name;
$data["design_images"]=$this->admin_model->getdatawithcondition("img_id,img_name","design_images",array("design_id"=>$id));

			 $data["hold_id"]=$id;
			 $this->load->view('dashboard_header',$userdata);
             $this->load->view('design/addimage',$data);
             $this->load->view('dashboard_footer');
			 
		   }
		   else
		   {
		   redirect('/admin','refresh');  
		   }
		
	   
	   }
	   private function category_validation()
	   {
	        
			if($this->senddata[$this->datakey[3]]=="add")
			{
			 $this->form_validation->set_rules(
              $this->datakey[0], 'Category Name',
              'required|max_length[500]|is_unique[category.name]',
              array(
                'required'      => 'You have not provided %s.'
                ));
			  }
			  else
			  {
			    $this->form_validation->set_rules(
              $this->datakey[0], 'Name',
              'required|max_length[500]',
              array(
                'required'      => 'You have not provided %s.'
                ));
			  }	
	            if($this->form_validation->run() == FALSE)
                return validation_errors();
				else
				{
					
				 if($this->senddata[$this->datakey[3]]=="edit")
			     {
				
					$count=$this->admin_model->countresult(array("name"=>trim($this->senddata[$this->datakey[0]]),"cat_id !="=>$this->senddata[$this->datakey[4]]),"category");
					if($count)
					{
					return "This category name already exist!";
					}
					else
					{
					return "";
					}
				 }else
				 {
				   return "";
				 }
				 
				}
	   
	   
	   }
	   private function getdata()
	   {

			$data= file_get_contents("php://input");

			$data = strip_tags($data);
            $clean_input = trim($data);
            $data = array();
            parse_str($clean_input, $data);

			$this->datakey=array_keys($data);
			$this->senddata=$data;
	   
	   }
	   public function editcatgory($id)
	   {
	      if($this->checksession())
		   {
		    
			$count=$this->admin_model->countresult(array("cat_id"=>$id),"category");
		    
			if(!$count)
			redirect('/admin/dashboard','refresh');  
			
			$data["cat_info"]=  $this->admin_model->get_info("category",array("cat_id"=>$id));
			$data["actiontype"]="edit";
			$data["categoryid"]=$id;
			$userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);
                    $this->load->view('design/addcategory',$data);
                    $this->load->view('dashboard_footer');
		   }
		   else
		   {
		   redirect('/admin','refresh');  
		   }
	   
	   }
	   public function deletecategory($id)
	   {
	       if($this->checksession())
		   {
		    $this->admin_model->row_delete_with_othertable("category",array("cat_id"=>$id));  
		    redirect('/admin/design/displaycategory','refresh');  
		   }
		   else
		   {
		    redirect('/admin','refresh');  
		   }
	   
	   }
	   public function addcategory()
	   {
	     $this->getdata();
	     $error=$this->category_validation();
		 if(empty($error))
		 {
		 if($this->senddata[$this->datakey[3]]=="add")
		 {
		 $this->admin_model->data_insert("category",array("name"=>$this->senddata[$this->datakey[0]],"descreption"=>$this->senddata[$this->datakey[1]]));
		 }
		 else
		 {
		 $this->admin_model->update_info("category","cat_id",$this->senddata[$this->datakey[4]],array("name"=>$this->senddata[$this->datakey[0]],"descreption"=>$this->senddata[$this->datakey[1]]));
		 }
		 
		 redirect('/admin/design/displaycategory','refresh');
         }
		 else
		 {
		  return $error; 
		 }
	   }

public function edit_img_by_ajax($id)
{
	  	   
		$status = "";
        $msg = "";
        $file_element_name = 'editmainimg';
 
  $path ='assets/design/designupload/admin/large/'.$_FILES["editmainimg"]["name"];
   if(file_exists($path))
   {
     $status = "error";
      $msg = "This file  already existed. Please change file name";
      	$imagepath='';      
   }
	  
 if ($status != "error")
 {
  
  $config['upload_path'] = 'assets/design/designupload/admin/large';
  $config['allowed_types'] = 'gif|jpg|png';
  $config['max_size'] = 1024 * 8;
  $config['encrypt_name'] = FALSE;
  
  $config['min_width'] = '1280';
  $config['min_height'] ='854';
  $config['max_width'] = '3024';
  $config['max_height'] = '2200';
  
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
      $this->small_img($data['file_name']);
	   
	   $result=$this->admin_model->getdatawithcondition("images_name","our_design",array("design_id"=>$id));
       $result[0]->images_name;
  
       $smallimage=str_replace(".","_thumb.",$result[0]->images_name);
       
	   @chmod('assets/design/designupload/admin/large/'.$result[0]->images_name.'', 0777);
	   unlink('assets/design/designupload/admin/large/'.$result[0]->images_name.'');
       @chmod('assets/design/designupload/admin/small/'.$smallimage.'', 0777);
       unlink('assets/design/designupload/admin/small/'.$smallimage.'');
      @chmod('assets/design/designupload/admin/thumb/'.$smallimage.'', 0777);
       unlink('assets/design/designupload/admin/thumb/'.$smallimage.'');
       
	 
	  $this->admin_model->update_info("our_design","design_id",$id,array("images_name"=>$data['file_name']));

	  
	  $status = "success";
      
	  $msg = "File successfully uploaded";
	  $filename=str_replace(".","_thumb.",$data['file_name']);
	  $imagepath=base_url('assets/design/designupload/admin/small/'.$filename.'');
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

public function add_img_by_ajax($id)
{
	  	   
		$status = "";
        $msg = "";
        $file_element_name = 'userfile';
 
  $path ='assets/design/designupload/admin/large/'.$_FILES["userfile"]["name"];
   if(file_exists($path))
   {
     $status = "error";
      $msg = "This file  already existed.";
      	$imagepath='';
		$image_id='';      
   }
	  
 if ($status != "error")
 {
  $config['upload_path'] = 'assets/design/designupload/admin/large';
  $config['allowed_types'] = 'gif|jpg|png';
  $config['max_size'] = 1024 * 8;
  
  $config['min_width'] = '1280';
  $config['min_height'] ='854';
  $config['max_width'] = '3024';
  $config['max_height'] = '2200';
  
  $config['encrypt_name'] = FALSE;

  $this->load->library('upload', $config);
  if (!$this->upload->do_upload($file_element_name))
  {
    $status = 'error';
    $msg = $this->upload->display_errors('', '');
	$imagepath='';
	$image_id='';
  }
  else
   {
   $data = $this->upload->data();

   $image_path = $data['full_path'];

   if(file_exists($image_path))
   {
      $this->small_img($data['file_name']);
	 
	 $image_id=$this->admin_model->data_insert("design_images",array("design_id"=>$id,"img_name"=>$data['file_name']));
	  
	  $status = "success";
      
	  $msg = "File successfully uploaded";
	  $filename=str_replace(".","_thumb.",$data['file_name']);
	  $imagepath=base_url('assets/design/designupload/admin/thumb/'.$filename.'');
  }
  else
  {
  $status = "error";
  $msg = "Something went wrong when saving the file, please try again.";
  $imagepath="";
  $image_id='';
 }
}
 @unlink($_FILES[$file_element_name]);
 }
 echo json_encode(array('status' => $status, 'msg' => $msg, 'imagepath'=>$imagepath,'image_id'=>$image_id));
		
}
public function deleteimage()
{
      $this->getdata();
      $result="";
      $img_name=$this->admin_model->getdatawithcondition("img_name",$this->senddata[$this->datakey[1]],array("img_id"=>$this->senddata[$this->datakey[0]]));
      $main_img=$img_name[0]->img_name;
      $small_img=str_replace(".","_thumb.",$main_img);

       @chmod('assets/design/designupload/admin/large/'.$main_img.'', 0777);
	   @unlink('assets/design/designupload/admin/large/'.$main_img.'');
       @chmod('assets/design/designupload/admin/small/'.$small_img.'', 0777);
       @unlink('assets/design/designupload/admin/small/'.$small_img.'');
       @chmod('assets/design/designupload/admin/thumb/'.$small_img.'', 0777);
       @unlink('assets/design/designupload/admin/thumb/'.$small_img.'');

$this->admin_model->row_delete_with_othertable($this->senddata[$this->datakey[1]],array("img_id"=>$this->senddata[$this->datakey[0]]));

$result["status"]="success";


echo json_encode($result);

}
private function small_img($filename)
	{
	   $this->load->library('image_lib');
	    unset($config);
	    $config['image_library'] = 'gd2';
        $config['source_image']	= 'assets/design/designupload/admin/large/'.$filename.'';
        $config['new_image'] = 'assets/design/designupload/admin/small/';
		$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']	 =411;
        $config['height']	= 274;
        $this->image_lib->initialize($config);
		$this->image_lib->resize();
	    $this->image_lib->clear();
		unset($config);
		$config['image_library'] = 'gd2';
        $config['source_image']	= 'assets/design/designupload/admin/large/'.$filename.'';
        $config['new_image'] = 'assets/design/designupload/admin/thumb/';
		$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']	 =100;
        $config['height']	= 67;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	    $this->image_lib->clear();
	}
	
	private function add_img($field_name,$filename)
	{
	
	      
		   $config['upload_path'] = 'assets/design/designupload/admin/large';
           $config['allowed_types'] = 'gif|jpg|png';
           $config['max_size']	= '5000';
		   $config['file_name']	= $filename;
           $config['image_width'] = 1280;
		   $config['image_height'] =854;
					   
           $config['min_width'] = '1280';
           $config['min_height'] ='854';
           $config['max_width'] = '3024';
           $config['max_height'] = '2200';
           $this->load->library('upload', $config);
           $this->upload->do_upload($field_name);
	       
		   return $this->upload->display_errors();
	
	}
    public function new_design()
	{
	    $this->form_validation->set_rules('designname', 'Name',
              'required|max_length[500]',
              array(
                'required'      => 'You have not provided %s.'
                ));
 $this->form_validation->set_rules('designinfo', 'Design Information','required|max_length[1000]');

$this->form_validation->set_rules('designprice', 'Price','required|max_length[15]|numeric|xss_clean');
		       
			    if($this->form_validation->run() == FALSE)
                return validation_errors();
                else
				return "";
	
	}
	private function design_validation()
	{
	      
		  
	      $error=$this->new_design();
		  if(empty($error))
		  {
			   $path ='assets/design/designupload/admin/large/'.$_FILES['uploadimg']['name'];
               if(file_exists($path))
               {

                    $error = "This file  already existed.";
      	            
                }else
				{
			    $error= $this->add_img('uploadimg',$_FILES['uploadimg']['name']);
		        
	            

				} 
			 
			 if(empty($error))
			 {
			  
			  $this->small_img($_FILES['uploadimg']['name']); 
			  $this->admin_model->insert_data('our_design',array("name"=>$_POST["designname"],"cat_id"=>$_POST["designcategory"],"design_info"=>$_POST["designinfo"],"images_name"=>$_FILES['uploadimg']['name'],"price"=>$_POST["designprice"]));
			 
			 redirect('/admin/design/displaydesign','refresh');
			 }
			 else
			 {
			 return $error; 
			 }
		  }
		  else
		  {
		  return $error;
		  }
	
	}
	public function displaydesign()
	{
	
	  	
	      if($this->checksession())
		   {
           $userdata["name"]=$this->get_name();
		   $data["design"]=$this->admin_model->leftright_join_with_limit("our_design.design_id,our_design.name,category.name as categoryname,our_design.design_info,our_design.price,our_design.images_name","our_design","category","our_design.cat_id=category.cat_id",'inner',15, 0);

	       $this->load->view('dashboard_header',$userdata);
		   $this->load->view('design/displaydesign',$data);
		   $this->load->view('dashboard_footer');
		   }else
		   {
		   redirect('/admin','refresh');
		   }
	
	}
	
	public function createdesign()
	   {
	   
	       if($this->checksession())
		   {
           $userdata["name"]=$this->get_name();
	       $this->load->view('dashboard_header',$userdata);
		   if($_POST)
		   {
		   $designdata['error']=$this->design_validation();
		   }
		   
		  $result= $this->admin_model->getdatawithfieldname("cat_id,name","category");
		   
		   if(!count($result))
		   {
		   redirect('/admin/design/category','refresh');
		   }
		   $category='';
		    foreach($result as $row)
		    {
		     $category[$row->cat_id]=$row->name;
		     }
           $designdata['category']=$category;
		   $this->load->view('design/createdesign',$designdata);
           
		   $this->load->view('dashboard_footer');
		   }
		   else
		   {
		   redirect('/admin','refresh');
		   
		   }
	   
	   
	   }
	   public function displaycategory()
	   {
	       if($this->checksession())
		   {
           $userdata["name"]=$this->get_name();
	       $this->load->view('dashboard_header',$userdata);
		   $result["category"]= $this->admin_model->getalldata("cat_id,name,descreption","category",10, 0);
		   $this->load->view('design/displaycategory',$result);
           $this->load->view('dashboard_footer');
		   }
		   else
		   {
		   redirect('/admin','refresh');
		   
		   }
	   
	   }
    public function category()
	{
	
	       if($this->checksession())
		   {
		   $data="";
		            $userdata["name"]=$this->get_name();
	                $this->load->view('dashboard_header',$userdata);
                    if($_POST)
					{
				    $data["error"]=$this->addcategory();
					$data["actiontype"]=(isset($_POST["actiontype"])?$_POST["actiontype"]:'');
					$data["categoryid"]=(isset($_POST["categoryid"])?$_POST["categoryid"]:'');
					}
					else
					{
					$data["actiontype"]="add";
					}
					$this->load->view('design/addcategory',$data);
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