<?php
class master_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$functionName = $this->router->fetch_method();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
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

/*************************************Services query start***********************************/

	public function service_ispresent($name)
	{
		$result = $this->db->query("SELECT * FROM service_master WHERE service_name = '".ucfirst($name)."' AND is_deleted = 0");
		return $result->result();
	}

    public function fill_services()
    { 
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
    	$unique_id = $this->NewGuid();
        // if(empty($_POST['feature']))
        //     $feature='';
        // else
        //     $feature=implode(",", $_POST['feature']);
    	$data = array(          
            'service_name' => ucfirst($_POST['service_name']),
            'amount' => $_POST['amount'],
            'halfly' => $_POST['halfly'],
            // 'features' => $feature,
			'created_by' => $user_id,
			'created_on' => $date,
			'unique_id' => $unique_id,
			'is_active' => 1	
            );
    	$insert_id = $this->db->Insert('service_master',$data); 
        return $insert_id;              
    }

    public function get_servicedetails()
    {
    	$result = $this->db->query("SELECT * FROM service_master WHERE is_deleted = 0");
    	return $result->result();
    }

    public function get_thatservice($unique_id)
    {
    	$result = $this->db->query("SELECT * FROM service_master WHERE unique_id = '".$unique_id."'");
    	return $result->row_array();
    }

    public function update_services($unique_id)
    {   
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
        // if(empty($_POST['feature']))
        //     $feature='';
        // else
        //     $feature=implode(",", $_POST['feature']);
    	$data = array(          
            'service_name' => ucfirst($_POST['service_name']),
            'amount' => $_POST['amount'],
            'halfly' => $_POST['halfly'],
            // 'features' => $feature,
			'updated_by' => $user_id,
			'updated_on' => $date			
            );
        $this->db->where('unique_id',$unique_id); 
        $update_id = $this->db->Update('service_master',$data); 
        return $update_id;              
    }

    public function service_activates($id)
    {
    	$data = array('is_active'=>'1');
        $this->db->where('unique_id',$id);
        $this->db->update('service_master',$data); 
    }

    public function service_deactivates($id)
    {
    	$data = array('is_active'=>'0');
        $this->db->where('unique_id',$id);
        $this->db->update('service_master',$data); 
    }

    public function delete_thatservice($id)
    {
    	$update_id = 0;
    	$data = array('is_deleted'=>1);
        $this->db->where('unique_id',$id);
        $update_id = $this->db->update('service_master',$data); 
        return $update_id;
    }

/*************************************Services query end***********************************/

/*************************************VENUE query start***********************************/

    public function venue_ispresent($name)
    {
        $result = $this->db->query("SELECT * FROM venue_type WHERE venue_name = '".ucfirst($name)."' AND is_deleted = 0");
        return $result->result();
    }

    public function fill_venue()
    { 
        $date = date('Y-m-d h-i-s');
        $user_id = $this->master_model->isloggedIn();
        $unique_id = $this->NewGuid();
        // if(empty($_POST['feature']))
        //     $feature='';
        // else
        //     $feature=implode(",", $_POST['feature']);
        $data = array(          
            'venue_name' => ucfirst($_POST['venue_name']),
            'amount' => $_POST['amount'],
            'halfly' => $_POST['halfly'],
            // 'features' => $feature,
            'created_by' => $user_id,
            'created_on' => $date,
            'unique_id' => $unique_id,
            'is_active' => 1    
            );
        $insert_id = $this->db->Insert('venue_type',$data); 
        return $insert_id;              
    }

    public function get_venuedetails()
    {
        $result = $this->db->query("SELECT * FROM venue_type WHERE is_deleted = 0");
        return $result->result();
    }

    public function get_thatvenue($unique_id)
    {
        $result = $this->db->query("SELECT * FROM venue_type WHERE unique_id = '".$unique_id."'");
        return $result->row_array();
    }

    public function update_venue($unique_id)
    {   
        $date = date('Y-m-d h-i-s');
        $user_id = $this->master_model->isloggedIn();
        // if(empty($_POST['feature']))
        //     $feature='';
        // else
        //     $feature=implode(",", $_POST['feature']);
        $data = array(          
            'venue_name' => ucfirst($_POST['venue_name']),
            'amount' => $_POST['amount'],
            'halfly' => $_POST['halfly'],
            // 'features' => $feature,
            'updated_by' => $user_id,
            'updated_on' => $date           
            );
        $this->db->where('unique_id',$unique_id); 
        $update_id = $this->db->Update('venue_type',$data); 
        return $update_id;              
    }

    public function venue_activates($id)
    {
        $data = array('is_active'=>'1');
        $this->db->where('unique_id',$id);
        $this->db->update('venue_type',$data); 
    }

    public function venue_deactivates($id)
    {
        $data = array('is_active'=>'0');
        $this->db->where('unique_id',$id);
        $this->db->update('venue_type',$data); 
    }

    public function delete_thatvenue($id)
    {
        $update_id = 0;
        $data = array('is_deleted'=>1);
        $this->db->where('unique_id',$id);
        $update_id = $this->db->update('venue_type',$data); 
        return $update_id;
    }

/*************************************VENUE query end***********************************/

/*************************************Event location query start***********************************/

	public function eventplace_ispresent($name)
	{
		$result = $this->db->query("SELECT * FROM event_location WHERE location_name = '".ucfirst($name)."' AND is_deleted = 0");
		return $result->result();
	}

    public function fill_event_location()
    { 
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
    	$unique_id = $this->NewGuid();
    	$data = array(          
            'location_name' => ucfirst($_POST['location_name']),
			'created_by' => $user_id,
			'created_on' => $date,
			'unique_id' => $unique_id,
			'is_active' => 1	
            );
    	$insert_id = $this->db->Insert('event_location',$data); 
        return $insert_id;              
    }

    public function get_event_locationdetails()
    {
    	$result = $this->db->query("SELECT * FROM event_location WHERE is_deleted = 0");
    	return $result->result();
    }

    public function get_thatevent_location($unique_id)
    {
    	$result = $this->db->query("SELECT * FROM event_location WHERE unique_id = '".$unique_id."'");
    	return $result->row_array();
    }

    public function update_event_location($unique_id)
    {   
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
    	$data = array(          
            'location_name' => ucfirst($_POST['location_name']),
			'updated_by' => $user_id,
			'updated_on' => $date			
            );
        $this->db->where('unique_id',$unique_id); 
        $update_id = $this->db->Update('event_location',$data); 
        return $update_id;              
    }

    public function eventlocation_activates($id)
    {
    	$data = array('is_active'=>'1');
        $this->db->where('unique_id',$id);
        $this->db->update('event_location',$data); 
    }

    public function eventlocation_deactivates($id)
    {
    	$data = array('is_active'=>'0');
        $this->db->where('unique_id',$id);
        $this->db->update('event_location',$data); 
    }

    public function delete_thateventlocation($id)
    {
    	$update_id = 0;
    	$data = array('is_deleted'=>1);
        $this->db->where('unique_id',$id);
        $update_id = $this->db->update('event_location',$data); 
        return $update_id;
    }

/*************************************Event location query end***********************************/

/*************************************Events query start***********************************/

	public function events_ispresent($name)
	{
		$result = $this->db->query("SELECT * FROM event_master WHERE event_name = '".ucfirst($name)."' AND is_deleted = 0");
		return $result->result();
	}

    public function fill_events()
    { 
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
    	$unique_id = $this->NewGuid();
    	$data = array(          
            'event_name' => ucfirst($_POST['event_name']),
			'created_by' => $user_id,
			'created_on' => $date,
			'unique_id' => $unique_id,
			'is_active' => 1	
            );
    	$insert_id = $this->db->Insert('event_master',$data); 
        return $insert_id;              
    }

    public function get_eventdetails()
    {
    	$result = $this->db->query("SELECT * FROM event_master WHERE is_deleted = 0");
    	return $result->result();
    }

    public function get_thatevent($unique_id)
    {
    	$result = $this->db->query("SELECT * FROM event_master WHERE unique_id = '".$unique_id."'");
    	return $result->row_array();
    }

    public function update_events($unique_id)
    {   
    	$date = date('Y-m-d h-i-s');
    	$user_id = $this->master_model->isloggedIn();
    	$data = array(          
            'event_name' => ucfirst($_POST['event_name']),
			'updated_by' => $user_id,
			'updated_on' => $date			
            );
        $this->db->where('unique_id',$unique_id); 
        $update_id = $this->db->Update('event_master',$data); 
        return $update_id;              
    }

    public function event_activates($id)
    {
    	$data = array('is_active'=>'1');
        $this->db->where('unique_id',$id);
        $this->db->update('event_master',$data); 
    }

    public function event_deactivates($id)
    {
    	$data = array('is_active'=>'0');
        $this->db->where('unique_id',$id);
        $this->db->update('event_master',$data); 
    }

    public function delete_thatevent($id)
    {
    	$update_id = 0;
    	$data = array('is_deleted'=>1);
        $this->db->where('unique_id',$id);
        $update_id = $this->db->update('event_master',$data); 
        return $update_id;
    }

/*************************************Events query end***********************************/
/*************************************testimonial query start***********************************/
    public function insert_test()
    {
        date_default_timezone_set ("Asia/Calcutta");
        $date = date('Y-m-d h-i-s');
        $insert_id = 0;
        $unique_id = $this->NewGuid();
         $banner_image = time().$_FILES['testimonial_image']['name'];
            if(isset($_FILES['testimonial_image']['name']))
            {
                move_uploaded_file($_FILES['testimonial_image']['tmp_name'], "./uploads/testimonial_image/$banner_image");
            }
        $data_test = array(
            'unique_id'=>$unique_id,
            'testimonial_name'=>$_POST['testimonial_name'],
            'testimonial_image'=>$banner_image,
            'testimonial_tittle'=>$_POST['testimonial_tittle'],
            'testimonial_description'=>$_POST['testimonial_description'],
            'is_publised' => 1,
            'is_deleted'=>1,
            'created_date'=>$date,
            'updated_date'=>$date,
              );
        $insert_id = $this->db->insert('testimonial',$data_test);
        return $insert_id;

    }
    public function get_test_list()
    {
        $result_listid = $this->db->query("select * from testimonial")->result();
        return $result_listid;
    }
    public function testimonial_get($unique_id)
    {
        $get_id = $this ->db->query("select * from testimonial where unique_id = '".$unique_id."'")->row_array();
        return $get_id;  
    }
    public function update_testimonial($unique_id)
    {
        date_default_timezone_set ("Asia/Calcutta");
        $date = date('Y-m-d h-i-s');
        
        if(!empty($_FILES['testimonial_image']['name']))
            {
                $banner_image = time().$_FILES['testimonial_image']['name'];
                move_uploaded_file($_FILES['testimonial_image']['tmp_name'], "./uploads/testimonial_image/$banner_image");
            }
        else
            {
                $banner_image = $_POST['prev_img'];
            }
            $data_test = array(
            'testimonial_name'=>$_POST['testimonial_name'],
            'testimonial_image'=>$banner_image,
            'testimonial_tittle'=>$_POST['testimonial_tittle'],
            'testimonial_description'=>$_POST['testimonial_description'],
            'updated_date'=>$date
            );
        $this->db->where('unique_id',$unique_id);
        $editinfo_id = $this->db->update('testimonial',$data_test);
        return $editinfo_id;
    }
    public function delete_test($unique_id)
    {
        $get_id = $this->db->query("delete from testimonial where unique_id = '".$unique_id."'");
        return $get_id;
    }
    public function test_active($id)
    {
        $data = array('is_publised'=>1);
        $this->db->where('unique_id',$id);
       $result = $this->db->update('testimonial',$data);
       return $result;
    }
    public function test_deactive($id)
    {
       $data = array('is_publised'=>0);
        $this->db->where('unique_id',$id);
        $result = $this->db->update('testimonial',$data);
        return $result;

    }
 
}
