<?php
class service_model extends CI_Model
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

    public function service_count()
    {
    	$result = $this->db->query("SELECT * FROM service_details WHERE is_deleted = 0")->result();
    	return count($result);
    }

    // public function get_allservices($start, $end)
    // {
    // 	$result = $this->db->query("SELECT sd.*,us.*,sd.unique_id as my_serv_id,sd.company_name as my_company,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS services FROM service_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.is_deleted = 0 ORDER BY sd.service_details_id DESC LIMIT ".$start.", ".$end."");
    // 	return $result->result();
    // }
    public function get_allservices()
    {
        $result = $this->db->query("SELECT sd.*,us.*,sd.unique_id as my_serv_id,sd.company_name as my_company,sd.address as address ,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS services FROM service_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.is_deleted = 0 ORDER BY sd.service_details_id DESC");
        return $result->result();
    }

    public function get_service($unique_id)
    {
    	$result = $this->db->query("SELECT sd.*,us.*,sd.company_name as company ,sd.address as address ,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS services FROM service_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '".$unique_id."'");
    	return $result->row_array();
    }

    public function get_spaceimages($id)
    {
    	$result = $this->db->query("SELECT * FROM service_images WHERE service_details_id = '".$id."'");
    	return $result->result();
    }

    public function get_dayname($id)
    {
    	$result = $this->db->query("SELECT *,( CASE WHEN day_id = 1 THEN 'Mon' WHEN day_id = 2 THEN 'Tue' WHEN day_id = 3 THEN 'Wed' WHEN day_id = 4 THEN 'Thur' WHEN day_id = 5 THEN 'Fri' WHEN day_id = 6 THEN 'Sat' ELSE 'Sun' END) AS day FROM service_avaiable_on WHERE service_details_id = '".$id."'")->result();
    	return $result;
    }

    public function activateservice($banner_id)
	{
        $data = array('status'=>'1');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('service_details',$data);	
	}

    public function deactivateservice($banner_id)
	{
        $data = array('status'=>'0');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('service_details',$data);	
	}

	public function delete_thatservice($banner_id)
	{
        $data = array('is_deleted'=>'1');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('service_details',$data);
        return 1;	
	}

    public function booked_service_count()
    {
        $result = $this->db->query("SELECT * FROM service_booking ")->result();
        return count($result);
    }

    public function get_service_package($id)
    {
        $result = $this->db->query("SELECT * FROM service_package_details WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')");
        return $result->result();
    }

    public function get_all_booked_services()
    {

        $result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company ,sd.address as address ,sd.unique_id as uni_id ,sb.status as chk_status ,us.fname as host_fname ,us.lname as host_lname ,us2.fname as user_fname ,us2.lname as user_lname ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_booking sb INNER JOIN service_details sd ON sb.service_id = sd.service_details_id INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN users us2 ON sd.user_id = us2.user_id  ORDER BY sb.service_booking_id DESC");

        return $result->result();
    }

    public function get_booked_service($id)
    {
        $result = $this->db->query("SELECT sb.*,sd.*,us.*,pd.*,sd.company_name as company,sb.status AS chk_status,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS service_name FROM service_booking sb INNER JOIN users us ON sb.user_id = us.user_id  INNER JOIN service_details sd ON sd.service_details_id = sb.service_id INNER JOIN service_package_details pd ON sb.package_id = pd.package_id WHERE sb.service_booking_id = '$id'");

        return $result->row_array();

    }
    // public function get_booked_service($id)
    // {
    //     $result = $this->db->query("SELECT sb.*,sb.status AS chk_status,(SELECT package_name FROM service_package_details WHERE package_id = sb.package_id) AS package_name FROM service_booking sb  WHERE sb.service_booking_id = '$id'");

    //     return $result->row_array();

    // }

    public function get_serviceimage($id)
    {
        $result = $this->db->query("SELECT * FROM service_images WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')");
        return $result->result();
    }

}