<?php
class admin_model extends CI_Model
{
 var $table = "user_login";
function __construct() 
{
parent::__construct();

}
public function getdatawithfieldname($fieldname,$tablename)
{
$result=$this->db->select($fieldname)->from($tablename)->get()->result();
return $result;
}
public function getalldata($fieldname,$tablename,$limit, $start)
{
$result=$this->db->select($fieldname)->from($tablename)->limit($limit, $start)->get()->result();
return $result;
}
public function getdatawithconditionwith_limit($fieldname,$tablename,$condition,$limit, $start)
{
$result=$this->db->select($fieldname)->from($tablename)->where($condition)->limit($limit, $start)->get()->result();
return $result;
}
public function getdatawithcondition($fieldname,$tablename,$condition)
{
$result=$this->db->select($fieldname)->from($tablename)->where($condition)->get()->result();
return $result;
}
function data_insert($tablename,$data)
{
$this->db->insert($tablename, $data);
}
public function row_delete_with_othertable($tablename,$condision)
{
   $this->db->where($condision);
   $this->db->delete($tablename); 
}

function row_delete($condision)
{
   $this->db->where($condision);
   $this->db->delete($this->table); 
}
public function countresult($condition,$table)
{
 if(is_null($condition))
 $result = $this->db->count_all_results($table);
 else
 $result = $this->db->where($condition)->count_all_results($table);
 return $result;
} 
function has_record($tablename,$data)
{

    $query = $this->db->get_where($tablename, $data);
	$getresult=$query->result();
	
	return ($query->num_rows()!=0?$getresult[0]->user_id:0);
} 
public function get_has_record_with_condition($tablename,$condition)
{

   $query = $this->db->get_where($tablename, $condition);
   $getresult=$query->result(); 
   return ($query->num_rows()!=0?$getresult[0]->user_id:0);
} 
public function get_info($tablename,$data)
{

    $query = $this->db->get_where($tablename, $data);
	$getresult=$query->result();
	return $getresult;
}

public function update_info($tablename,$field,$field_value,$data)
{
    $this->db->where($field, $field_value);
    $this->db->update($tablename, $data);
}
public function leftright_join($selectdata,$tablename1,$tablename2,$condition,$type,$fieldname,$fieldvalue)
{
    $this->db->select($selectdata);
    $this->db->from($tablename1);
    $this->db->join($tablename2, $condition, $type)->where($fieldname,$fieldvalue);
    $getresult=$this->db->get()->result();
	return $getresult;
} 
public function leftright_join_with_limit($selectdata,$tablename1,$tablename2,$condition,$type,$limit, $start)
{

    $this->db->select($selectdata);
    $this->db->from($tablename1);
    $this->db->join($tablename2, $condition, $type)->limit($limit, $start);
    $getresult=$this->db->get()->result();
	return $getresult;


}
public function insert_data($tablename,$data)
{
   $this->db->insert($tablename,$data);
   $insert_id = $this->db->insert_id();
   return $insert_id;
} 
}


?>