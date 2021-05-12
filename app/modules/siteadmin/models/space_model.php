<?php
class space_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('email');
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

    public function space_count()
    {
    	$result = $this->db->query("SELECT * FROM space_details WHERE is_deleted = 0")->result();
    	return count($result);
    }

    public function sendemail($emails,$sub,$msg)
    {
        $message = '';
        $message = '<html><head><title>Settle</title></head><body><div style="overflow: hidden;" class="a3s" id=":16z"><div class="adM"></div><div><div class="adM"></div><div style="border-left: 1px solid #ddd;min-height: 52px;border-right: 1px solid #ddd;border-top: 1px solid #ddd;color: #666;margin: 0 auto;padding: 11px 0 10px 12px; background-color:#00aeaf;"><div class="adM"> </div><a target="_blank" href="'.base_url().'"><img style="border:0 none;color:#666;height:50px;width:140px; vertical-align:middle;" src="'.base_url().'themes/frontend/images/logo-1.png" alt="settle" class="CToWUd"></a>  </div><div style="border:1px solid #ddd;color:#666;margin:0 auto;padding:0 20px 20px"><div style="color:#666"><h4 style="font-family:arial!important"> </h4><div style="font-size:12px;line-height:20px;font-family:arial!important">'.$msg.' </div></div></div><div><div style="color:#606060;font-family:Helvetica,Arial,sans-serif;font-size:11px;line-height:150%; padding-right:20px;padding-bottom:5px;padding-left:20px;text-align:center">This email is sent to you, as you are a part of <span class="il">Settle</span>.</div><div style="background-color:rgb(51,51,51)!important;margin:0px auto;padding:10px 20px;min-height:50px;clear:both"><div style="width:70%;float:left;color:#666;padding-top:10px;font-size:12px">Mail Us @ <a target="_blank" href="mailto:info@settle.com" style="color:#666!important">info@<span class="il">settle</span>.ind.in</a><span style="margin:0 10px">OR</span> <b>SMS</b>  to 00000</div><div style="float:right"><div style="overflow:hidden;padding-top:5px"><a target="_blank" href="https://www.facebook.com/arteventus/?fref=ts" style="color:#666;display:block;float:left;margin-left:15px"><img alt="facebook" src="'.base_url().'themes/frontend/images/social/fb.png" class="CToWUd"></a><a target="_blank" href="https://twitter.com/" style="color:#666;display:block;float:left;margin-left:8px"><img alt="tweet" src="'.base_url().'themes/frontend/images/social/tw.png" class="CToWUd"></a><a style="color:#666;display:block;float:left;margin-left:12px" href="https://www.pinterest.com"><img alt="pinterest" src="'.base_url().'themes/frontend/images/social/pinterest.png" class="CToWUd"></a></div></div></div></div><img height="1px" width="1px" src="" alt="" class="CToWUd"></div><div class="yj6qo"></div><div class="adL"></div></div></body></html>';
        $this->email->set_mailtype("html");
        $this->email->from('noreply@settle.ind.in', 'Settle');
        $this->email->to($emails);
        $this->email->subject($sub);
        $this->email->message($message);
        $this->email->send();
            
        return 1;
    }
    // public function get_allspaces($start, $end)
    // {
    // 	$result = $this->db->query("SELECT sd.*,sd.unique_id as my_spc_id,us.fname as my_fname, us.lname as my_lname,us.mobileno as mobile,(SELECT location_name FROM locations WHERE location_id = sd.country) AS cou_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd LEFT JOIN users us ON us.user_id = sd.user_id  WHERE sd.is_deleted = 0 ORDER BY sd.space_id DESC LIMIT ".$start.", ".$end."");
    // 	return $result->result();
    // }
    public function get_allspaces()
    {
        $result = $this->db->query("SELECT sd.*,sd.unique_id as my_spc_id,us.fname as my_fname, us.lname as my_lname,us.mobileno as mobile,(SELECT location_name FROM locations WHERE location_id = sd.country) AS cou_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd LEFT JOIN users us ON us.user_id = sd.user_id  WHERE sd.is_deleted = 0 ORDER BY sd.space_id DESC");
        return $result->result();
    }

    public function get_dayname($id)
    {
    	$result = $this->db->query("SELECT *,( CASE WHEN day_id = 1 THEN 'Mon' WHEN day_id = 2 THEN 'Tue' WHEN day_id = 3 THEN 'Wed' WHEN day_id = 4 THEN 'Thur' WHEN day_id = 5 THEN 'Fri' WHEN day_id = 6 THEN 'Sat' ELSE 'Sun' END) AS day FROM space_avaiable_on WHERE space_id = '".$id."'")->result();
    	return $result;
    }

    public function get_space($unique_id)
    {
    	$result = $this->db->query("SELECT sd.*,sd.unique_id as my_spc_id,us.fname as my_fname, us.lname as my_lname,us.mobileno as mobile,(SELECT location_name FROM locations WHERE location_id = sd.country) AS cou_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '".$unique_id."'");
    	return $result->row_array();
    }

    public function get_spaceimages($id)
    {
    	$result = $this->db->query("SELECT * FROM space_images WHERE space_id = '".$id."'");
    	return $result->result();
    }

    public function activatespace($banner_id)
	{
        $data = array('status'=>'1');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('space_details',$data);	
	}

    public function deactivatespace($banner_id)
	{
        $data = array('status'=>'0');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('space_details',$data);	
	}

	public function delete_thatspace($banner_id)
	{
        $data = array('is_deleted'=>'1');
        $this->db->where('unique_id',$banner_id);
        $this->db->update('space_details',$data);
        return 1;	
	}

    public function get_spaceevent($id)
    {
        $result = $this->db->query("SELECT * FROM space_event WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')");
        return $result->result();
    }

    public function get_allevents()
    {
        $result = $this->db->query("SELECT * FROM event_master WHERE is_active = 1 AND is_deleted = 0");
        return $result->result();
    }

    public function booked_space_count()
    {
        $result = $this->db->query("SELECT * FROM space_booking")->result();
        return count($result);
    }

    // public function get_all_booked_space($start, $end)
    // {

    //     $result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.address as address ,sd.unique_id as uni_id ,sb.status as chk_status ,us.fname as host_fname ,us.lname as host_lname ,us2.fname as user_fname ,us2.lname as user_lname ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT event_name FROM event_master WHERE event_id = sb.event_id) AS event FROM space_booking sb INNER JOIN space_details sd ON sb.space_id = sd.space_id INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN users us2 ON sd.user_id = us2.user_id  ORDER BY sb.space_booking_id DESC LIMIT ".$start.", ".$end."");

    //     return $result->result();
    // }
    public function get_all_booked_space()
    {

        $result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.address as address ,sd.unique_id as uni_id ,sb.status as chk_status ,us.fname as host_fname ,us.lname as host_lname ,us2.fname as user_fname ,us2.lname as user_lname ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT event_name FROM event_master WHERE event_id = sb.event_id) AS event FROM space_booking sb INNER JOIN space_details sd ON sb.space_id = sd.space_id INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN users us2 ON sd.user_id = us2.user_id  ORDER BY sb.space_booking_id DESC");

        return $result->result();
    }

    public function get_booked_space($id)
    {
        $result = $this->db->query("SELECT sb.*,sd.*,us.*,em.event_name AS event_name,sb.status AS chk_status FROM space_booking sb INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN space_details sd ON sd.space_id = sb.space_id INNER JOIN event_master em ON sb.event_id = em.event_id WHERE sb.space_booking_id = '$id'");

        return $result->row_array();

    }

    public function get_spaceimage($id)
    {
        $result = $this->db->query("SELECT * FROM space_images WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')");
        return $result->result();
    }


}