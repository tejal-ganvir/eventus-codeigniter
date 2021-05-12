<?php
class timeslot_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function NewGuid() 
	{ 
		$s = strtoupper(md5(uniqid(rand(),true))); 
		$guidText = 
		substr($s,0,8) . '-' . 
		substr($s,8,4) . '-' . 
		substr($s,12,4). '-' . 
		substr($s,16,4). '-' . 
		substr($s,20); 
		return $guidText;
	}
	public function isloggedIn()
    {
        $user_id = 0;
        $user_id = intval($this->session->userdata('admin_id'));
        return $user_id;
    }

    public function getlocation($parent,$location)
    {
        $result = $this->db->query("SELECT * from locations where parent_id = '".$parent."' AND  location_type = '".$location."'");
        return $result->result();
    }

    public function insert_country()
    {
    	date_default_timezone_set ("Asia/Calcutta");
    	$user_id = $this->isloggedIn();
        $date = date('Y-m-d h-i-s');
        $data = array(
        	'unique_id' => $this->NewGuid(),
			'parent_id' => 0,
			'location_type' => 1,
			'location_name' => $_POST['location_name'],
			'created_on' => $date,
			'is_published' => 1,
			'created_by' => $user_id );
		$insert_id = $this->db->Insert("locations",$data);
		return $insert_id;
    }

    public function insert_state()
    {
    	date_default_timezone_set ("Asia/Calcutta");
    	$user_id = $this->isloggedIn();
        $date = date('Y-m-d h-i-s');
        $data = array(
        	'unique_id' => $this->NewGuid(),
			'parent_id' => 1,
			'location_type' => 2,
			'location_name' => $_POST['location_name'],
			'created_on' => $date,
			'is_published' => 1,
			'created_by' => $user_id );
		$insert_id = $this->db->Insert("locations",$data);
		return $insert_id;
    }

    public function insert_city()
    {
    	date_default_timezone_set ("Asia/Calcutta");
    	$user_id = $this->isloggedIn();
        $date = date('Y-m-d h-i-s');
        $data = array(
        	'unique_id' => $this->NewGuid(),
			'parent_id' => $_POST['state'],
			'location_type' => 3,
			'location_name' => $_POST['location_name'],
			'created_on' => $date,
			'is_published' => 1,
			'created_by' => $user_id );
		$insert_id = $this->db->Insert("locations",$data);
		return $insert_id;
    }

    public function location_id($id)
    {
        $result = $this->db->query("SELECT * from locations where location_id = '$id' ");
        return $result->row_array();
    }

    public function update_location($id)
    {
        date_default_timezone_set ("Asia/Calcutta");
        $date = date('Y-m-d h-i-s');
        $user_id = $this->isloggedIn(); 
        $data = array(
                        'location_name' => $_POST['location_name'],
                        'updated_by' => $user_id,
                        'updated_on' => $date
                        );
        $this->db->where('location_id',$id);
        $update_id = $this->db->Update('locations',$data);
    }

    public function getstate()
    {
        $result = $this->db->query("SELECT * from locations where location_type = 2 AND is_published = 1");
        return $result->result();
    }
    public function getcountry()
    {
        $result = $this->db->query("SELECT * from locations where location_type = 1 AND is_published = 1");
        return $result->result();
    }
    public function getcity()
    {
        $result = $this->db->query("SELECT * from locations where location_type = 3 AND is_published = 1");
        return $result->result();
    }
 
}