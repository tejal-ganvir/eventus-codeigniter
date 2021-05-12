<?php
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home/home_model');
		$this->load->library('pagination'); 
		$this->load->helper('form'); 
		$this->load->library('session');
		$this->load->library('email');
		$this->load->helper('cookie');

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

	public function index()
	{
		$data_testimonial = $this->home_model->get_testimonialdata();
		$data['data_testimonial'] = $data_testimonial;
		$data['address'] = $this->home_model->get_allservices_details();
		$data['space_list'] = $this->home_model->get_indexspacelist();
		$data['service_list'] = $this->home_model->get_indexservicelist();
		$data['events'] = $this->home_model->get_allevents();
		$data["selected_menu"] = "home";
		$data['include'] = 'index';
		$this->load->view('frontend/container',$data);
	} 


/*************************************User Login And Registration Start**************************/	
	
	public function host_register()
	{
		if(isset($_POST['signup']))
		{
			if(empty($_POST['email_id']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['password'])){
				$this->session->set_flashdata("message","Please Fill All Fields");
				redirect('home/host_register');
			}
			if($_POST['password'] != $_POST['conpassword']){
				$this->session->set_flashdata("message","Password and Confirm Password Must Match");
				redirect('home/host_register');
			}
			$is_present = $this->home_model->check_emailid($_POST['email_id']); 
			if(count($is_present) > 0)
			{
				$this->session->set_flashdata("message","Email id is already present. Please use another email id for registration.");
				redirect('home/host_register'); 
			}
			else
			{
				$insert_id = $this->home_model->register_thehost();
				if($insert_id)
				{
					$this->session->set_flashdata("message1","Registration has been done successfully, Please check your email id to verify it...");
					redirect('home/host_login');
				}
				else
				{
					$this->session->set_flashdata("message","Unable to create new user. Please try again.");
					redirect('home/host_register');
				}
			}
		}  
		$data['include'] = 'home/host_register';
		$this->load->view('frontend/container',$data);
	}

	public function host_login()
	{
		if(isset($_POST['login']))
		{
			if(empty($_POST['email_id']) || empty($_POST['password'])){
				$this->session->set_flashdata("message","Please Fill All Fields");
				redirect('home/host_login');
			}
			$is_present = $this->home_model->login_thatuser(); 
			if($is_present == 1)
			{ 
				$blocked = $this->session->userdata('is_deleted');
				if($blocked == 1 ){
					redirect('home/blocked');
				}else{
					redirect('home/myaccount');
				}

			}
			else
			{
				$this->session->set_flashdata("message","Invalid email id or password. Please try again.");
				redirect('home/host_login');
			}
		} 	
		$data['include'] = 'home/host_login';
		$this->load->view('frontend/container',$data);
	}

	public function users_signup()
	{
		$is_present = $this->home_model->check_emailid($_POST['email_id']); 
		if(count($is_present) > 0)
		{

			echo -1; //Email id already exist
		}
		else
		{
			$insert_id = $this->home_model->register_thehost();
			if($insert_id)
				echo 1; //Register successfully
			else
				echo 0; //Unable to regiter it
		}
	}

	public function users_signin()
	{
		$is_present = $this->home_model->login_thatuser(); 
		if($is_present == true){
				$blocked = $this->session->userdata('is_deleted');
				if($blocked == 1 ){
					echo 3; ///Blocked page
				}else{
					echo 1;//Login that user
				}
			 
		}
		else
			echo 0; //Invalid id or password
	}


	public function blocked()
	{ 
		$result = $this->home_model->logout();
		if($result){
			$data['include'] = 'home/blocked';
    		$this->load->view('frontend/container',$data);
		}
	}


	public function user_logout()
	{ 
		$result = $this->home_model->logout();
		if($result)
			redirect('home');
		else
			redirect('home/myaccount');
	}

	public function email_verification($id = '')
	{
		$result = $this->home_model->get_emailverifed($id);
		if($result == 1)
		{
			$this->session->set_flashdata("message1","Your email id has been verifed successfully.");
			redirect("home/myaccount");
		}
		else
		{
			$this->session->set_flashdata("message","Sorry this link has expired.");
			redirect("home/host_login");
		}
	}

	public function checklogin()
	{
		$user_id = $this->home_model->isloggeduserIn();
		$user_details = $this->home_model->get_userinformation($user_id);
		if($user_id <= 0){
			redirect("home");
		}
   		elseif($user_details['is_noconfirm'] == 0)
		{
			$this->session->set_flashdata("message","Please verify your number first!");
	    	redirect('home/verify_number');
		}
	}

	public function forgotpassword()
    {
    	if(isset($_POST['submit']))
    	{
    		$is_send = $this->home_model->send_passwordbyemail();
    		if($is_send)
	    	{
	    		$this->session->set_flashdata("message1","Password has been sent on your email");
	    		redirect('home/host_login');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata("message","Unable to send password on your email id. Please try again.");
	    		redirect('home/forgotpassword');
	    	}
    	}
    	$data['include'] = 'home/forgotpassword';
    	$this->load->view('frontend/container',$data);
    }

/**************************************User Login And Registration End**************************/
	public function change_pic()
	{
		//var_dump($_FILES); 
		$user_id = $this->home_model->isloggeduserIn();
		//echo $user_id;
		$file='';		
        if(!empty($_FILES['file']['name']))
        {
            $file=time().$_FILES['file']['name'];
            $target_file='./uploads/profile_pic/'.$file;
             $new_file = explode(".", $file);
             $extention = end($new_file);     

             if($extention == 'jpg' || $extention=='jpeg' || $extention=='gif' || $extention=='png') // Check for extention of file
             {
             	if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
	            {
	            	$result = $this->db->query("SELECT profile_image FROM users WHERE user_id = '".$user_id."'");
					$result= $result->result();	 
					if($result)   
					{
						if(file_exists('./uploads/profile_pic/'.$result[0]->profile_image))
						{
							unlink('./uploads/profile_pic/'.$result[0]->profile_image);
						}						
					}   	            	
	            	$data = array(
						'profile_image' => $file);
					$this->db->Where('user_id',$user_id);
					$update_id = $this->db->Update('users',$data);
					echo json_encode($file);
	            }
	            else
	            {
	            	echo 3;
	            }
             } 
             else
             {
             	echo 2;
             }           
        }
        else
        {
        	echo 1;
        }
	}
/*********************************User Login And Registration By Social Sites*******************/

	public function google_signup()
	{
		require_once APPPATH.'libraries/Google/autoload.php';
		// $client_id = '82253963139-66ul4q136ct0esdv71usslqqln9o4vmb.apps.googleusercontent.com'; 
		// $client_secret = 'WsHQeu0_gyEWpAlu79pvvONl';
		$client_id = '249839726641-0h2qub6ri3nh5d7eg3hu05ttt9jqo8v1.apps.googleusercontent.com'; 
		$client_secret = 'tTSGCfhSrOoicwnnyusB_kXl';
		$redirect_uri = base_url().'home/google_signup';
		//$redirect_uri ='http://localhost/neweventus/home/google_signup';
		//$redirect_uri = 'http://tissatech.in/settle/home/google_signup';
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");
		$service = new Google_Service_Oauth2($client);

		if (isset($_GET['code']))
		{
			$client->authenticate($_GET['code']);
			$access_token = $client->getAccessToken();
			$this->session->set_userdata('access_token',$access_token);
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
			exit;
		}
		$access_token = $this->session->userdata('access_token');

		if($access_token)
		{
			$client->setAccessToken($access_token);
		}
		else
		{
			$authUrl = $client->createAuthUrl();
		}
		if(isset($authUrl))
		{ 	  
			return $authUrl;
		}
		else
		{ 
			$user = $service->userinfo->get();
			$check_userexist = $this->home_model->check_emailid($user->email); //Check if email id is present
			if(count($check_userexist) > 0)
			{
				$is_loginset = $this->home_model->set_sociallogic($user->email);
				if($is_loginset > 0)
				{
					redirect('home/myaccount');
				}
				else
				{
					$this->session->set_flashdata('message','Please verify your email id to login, as verification link is already sent to your email id.');
					redirect('home/host_register');
				}
			}
			else
			{
				$name_array = explode(" ",$user->name);
				$fname = $name_array[0];
				$lname = $name_array[1];
				$data['fname'] = $fname;
				$data['lname'] = $lname;
				$data['email'] = $user->email;
				$data['picture'] = $user->picture;
				$data['include'] = 'home/social_profilelogin';
				$this->load->view('frontend/container',$data);
			}
		}
	}

	public function create_google_ajaxurl()
	{
		$this->session->set_userdata('access_token',''); // Clear access token form session to open gmail window
 		$google_url = $this->google_signup();
 		echo $google_url; 
	}

	public function social_register()
	{
		if(isset($_POST['signup']))
		{
			$insert_id = $this->home_model->get_registerbysocial();
			if($insert_id)
			{
				$this->session->set_flashdata("message1","Registration has been done successfully");
				redirect('home/host_login');
			}
			else
			{
				$this->session->set_flashdata("message","Unable to create new user. Please try again.");
				redirect('home/host_register');
			}
		}
	}

	public function facebook_signup()
	{
		$check_userexist = $this->home_model->check_emailid($_POST['email']);
		if(count($check_userexist) > 0)
		{
			$is_loginset = $this->home_model->set_sociallogic($_POST['email']);
			if($is_loginset > 0)
			{
				echo 1; //Get user login
			}
			else
			{
				$this->session->set_flashdata('message','Please verify your email id to login, as verification link is already sent to your email id.');
				echo 2; //Verify your email id
			}
		}
		else
		{ 
			echo 3; //Transfer data to register page
		}
	} 

	public function social_profilelogin($fname = '',$lname = '',$email = '')
	{
		$data['fname'] = $fname;
		$data['lname'] = $lname;
		$data['email'] = urldecode($email);
		$data['picture'] = '';
		$data['include'] = 'home/social_profilelogin';
		$this->load->view('frontend/container',$data);
	}

/*****************************User Login And Registration By Social Sites End*******************/

/*****************************Change Password And Mobile Number Verification********************/
	public function verify_number()
    {
   		$user_id = $this->home_model->isloggeduserIn();
   		$user_details = $this->home_model->get_userinformation($user_id);
   		$data['user_details'] = $user_details;
    	$data['include'] = 'home/verify_number';
		$this->load->view('frontend/container',$data);
    }

	public function changepassword()
    {
    	$this->checklogin();
   		$user_id = $this->home_model->isloggeduserIn();
    	$data['include'] = 'home/changepassword';
		$this->load->view('frontend/container',$data);
    }

    public function change_thatpass()
    {
    	parse_str($_POST['dataString'], $form_data); //convert serialize form to post string
    	$user_id = $this->home_model->isloggeduserIn();
    	if($form_data['oldpass'] != $form_data['conpass'])
    	{
    		if($form_data['newpass'] == $form_data['conpass'])
			{
				$result = $this->home_model->change_changepwd($user_id, $form_data['oldpass'], $form_data['newpass']);
				if($result > 0)
				{
					echo 1; //Change successfully
				}
				else
				{
					echo 2; //Enter old password wrong
				}
			}
			else
			{
				echo 3; //New password and confirm password not match
			}		
    	}
    	else
    	{
    		echo 4; //New and old password cannot be same
    	}    		
    }

  //   public function otp()
  //   {
  //   	$this->checklogin();
  //  		$user_id = $this->home_model->isloggeduserIn();
  //  		if(isset($_POST['send']))
  //  		{
  //  			//die();
  //  			$is_set = $this->home_model->insert_otp($user_id);
  //  			if($is_set)
  //  			{
  //  				$this->session->set_flashdata("message","Otp has been send to your mobile number.");
  //  				redirect('home/otp_verify');
  //  			}
  //  			else
  //  			{
  //  				$this->session->set_flashdata("message","Unable to sent otp to your mobile number. Please try again.");
  //  				redirect('home/otp');
  //  			}
  //  		}
  //  		$data['otp_places'] = $this->home_model->locationlist();
  //   	$result = $this->home_model->get_number($user_id);
		// $data['user_details'] = $result;
  //   	$data['include'] = 'home/otp1';
		// $this->load->view('frontend/container',$data);
  //   }

     public function otp($unique_id='')
    {
    	//$this->checklogin();
   		$user_id = $this->home_model->isloggeduserIn();   
   		if(isset($unique_id) && isset($_POST['send']))
   		{
   			$is_set = $this->home_model->insert_otp($user_id,$unique_id);
   			if($is_set)
   			{
   				$this->session->set_flashdata("message","OTP has been sent to your mobile number.");
   				redirect('home/otp_verify/'.$unique_id);
   			}
   			else
   			{
   				$this->session->set_flashdata("message","Unable to send OTP to your mobile number. Please try again.");
   				redirect('home/otp'.$unique_id);
   			}   			
   		}
   		elseif(isset($_POST['send']))
   		{
   			$is_set = $this->home_model->insert_otp($user_id);
   			if($is_set)
   			{
   				$this->session->set_flashdata("message","OTP has been sent to your mobile number.");
   				redirect('home/otp_verify');
   			}
   			else
   			{
   				$this->session->set_flashdata("message","Unable to send OTP to your mobile number. Please try again.");
   				redirect('home/otp');
   			}

   		}
   		if(isset($unique_id))
   		{
   			$data['unique_id']=$unique_id;
   		}
   		$data['otp_places'] = $this->home_model->locationlist();
    	$result = $this->home_model->get_number($user_id);
		$data['user_details'] = $result;
		$data['menu'] = 'account';
    	$data['include'] = 'home/otp1';
		$this->load->view('frontend/container',$data);
    }

    public function otp_verify()
    {
    	//$this->checklogin(); 
   		if(isset($_POST['send']))
   		{
   			$is_set = $this->home_model->verified_thatnumber();
   			if($is_set)
   			{
   				$this->session->set_flashdata("success","Your mobile number is successfully verified.");
   				redirect('home/myaccount');
   			}
   			else
   			{
   				$this->session->set_flashdata("message","Invalid OTP. Please enter valid OTP.");
   				redirect('home/otp_verify');
   			}
   		}
    	$data['include'] = 'home/otp_verify';
    	$this->load->view('frontend/container',$data);
    }

    public function resend_otp()
    {
    	$is_send = $this->home_model->resent_thatotp();
    	if($is_send)
    	{
    		$this->session->set_flashdata("message","OTP has been sent to your mobile number");
    		redirect('home/otp_verify');
    	}
    	else
    	{
    		$this->session->set_flashdata("message","Unable to send OTP to your mobile number. Please try again.");
    		redirect('home/otp_verify');
    	}
    } 

/***************************Change Password And Mobile Number Verification End******************/

/***********************************Load State And City*****************************************/

	public function get_states($location_id = 0)
    {
        $state_result = $this->db->query("SELECT * FROM locations WHERE parent_id = $location_id AND location_type = 2 ORDER BY location_name");
        $state_result = $state_result->result();
        $msg = '';
        //$msg .= '<option value="">--Select State--</option>';
        for ($i = 0; $i < count($state_result); $i++) 
        {
            $msg = $msg.'<option value="'.$state_result[$i]->location_id.'">'.ucfirst($state_result[$i]->location_name).'</option>';
        }
        echo $msg;
    }

    public function get_cities($location_id = 0)
    {
        $city_result = $this->db->query("SELECT * FROM locations WHERE parent_id = $location_id AND location_type = 3 AND is_published = 1 ORDER BY location_name");
        $city_result = $city_result->result();
        $msg = '';
        //$msg .= '<option value="">--Select City--</option>';
        for ($i = 0; $i < count($city_result); $i++) 
        {
            $msg = $msg.'<option value="'.$city_result[$i]->location_id.'">'.ucfirst($city_result[$i]->location_name).'</option>';
        }
        echo $msg;
    } 

/*********************************Load State And City End***************************************/

/*****************************************User my account start*********************************/
	
	public function myaccount($id = "")
	{
   		$this->checklogin();
   		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['submit']))
		{
			$add_images = $_FILES['profile_pic']['name'];
            $count_image = 0;
            if($add_images!='')
            {  
	            $file_name = $_FILES['profile_pic']['name'];
	            $new_file = explode(".", $file_name);
	            $extention = end($new_file);     

	            if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'gif' || $extention == 'bmp' || $extention == 'png') // Check for extention of file
	            {

	            }
	            else
	            {
	                $count_image++;
	            }  
	            if($count_image > 0)    
	            {
	                $this->session->set_flashdata("error", "Please Upload Only Images.");
	                redirect('home/myaccount');
	            }
	        }
            $update_id = $this->home_model->update_userdetails($id);
			if($update_id)
			{
				$this->session->set_flashdata("success","Profile has been updated successfully");
				redirect('home/myaccount');
			}
			else
			{
				$this->session->set_flashdata("error","Unable to update the profile, please try again.");
				redirect('home/myaccount');
			}
		}
		$user_details = $this->home_model->get_userinformation($user_id);
		$data['user_details'] = $user_details;
		$this->session->set_userdata('profile_image',$user_details['profile_image']);
		$data['menu'] = 'account';
		$data['submenu'] = 'myaccount';
		$data['include'] = 'home/myaccount';
		$this->load->view('frontend/container',$data);
	}

/***************************************User my account end**********************************/

/***************************************Space details start**********************************/
	
	public function list_ofspace()
	{
		$this->checklogin();
		$data["selected_menu"] = "list_ofspace";
   		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['commit']))
		{
			for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
			{ 	
				$add_images = $_FILES['images']['name'][$i];
	            $count_image = 0;
	            if($add_images!='')
	            {  
		            $file_name = $_FILES['images']['name'][$i];
		            $new_file = explode(".", $file_name);
		            $extention = end($new_file);     

		            if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'gif' || $extention == 'bmp' || $extention == 'png') // Check for extention of file
		            {

		            }
		            else
		            {
		                $count_image++;
		            }  
		            if($count_image > 0)    
		            {
		                $this->session->set_flashdata("message1", "Please Upload Only Images.");
		                redirect('home/list_ofspace');
		            }
		        }
			}
			$space = $this->home_model->fill_thespace();
			if($space)
			{
				//$this->session->set_flashdata("message","Space has been saved successfully. Provide documents for approval");
				// $this->session->set_flashdata("message","Thank you ! Space listing request has been submitted successfully. Your space will be active on Settle once it approved by the Admin.");
				$this->session->set_flashdata("message","Please Upload your KYC Documents For Space Verification!!.");
				redirect('home/kyc_ofspace/'.$space);
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to save space.");
				redirect('home/list_ofspace');
			}
		}
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['venue'] = $this->home_model->get_allvenue(); //Get venue
		$data['country_result'] = $this->home_model->location_getlist(0,1);  //Get countries
		$result = $this->home_model->get_number($user_id); //Get mobile number
		$data['user_details'] = $result;
		$data['menu'] = 'space';
		$data['submenu'] = 'list_ofspace';
		$data['include'] = 'home/list_ofspace';
		$this->load->view('frontend/container',$data);
	} 

	public function spacelist($page = 0)
	{ 
		$this->checklogin();
		//For pagination start
		$config = array();  
       	$config["base_url"] = base_url()."home/spacelist/"; 
       	$config["total_rows"] = $this->home_model->get_space_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $spacelist = $this->home_model->get_thespacelist($page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		//$spacelist = $this->home_model->get_thespacelist();
		$data['spacelist'] = $spacelist;
		$data['menu'] = 'space';
		$data['include'] = 'home/spacelist';
		$this->load->view('frontend/container',$data);
	} 

	public function spacedetail_host($unique_id = '')
	{
		$this->checklogin();
		$space_detail = $this->home_model->get_thatspace($unique_id); //Get space details
		$space_image = $this->home_model->get_spaceimage($unique_id); //Get space images
		$space_days = $this->home_model->get_spacedays($unique_id); //Get space days
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['review'] = $this->home_model->get_space_review($unique_id); 
		$data['venue'] = $this->home_model->get_spacevenue($unique_id); //Get venue
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_location'] = $space_location;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		$data['include'] = 'home/spacedetail_host';
		$this->load->view('frontend/container',$data);
	} 

	public function editspace($unique_id = '')
	{ 
		$this->checklogin();
		$user_id = $this->home_model->isloggeduserIn();

		if(isset($_POST['commit']))
		{
			if(strlen($unique_id) > 0)
			{
				$update_id = $this->home_model->update_thespace($unique_id);
				$this->home_model->edit_space_email(); /////EMAIL after updation
				if($update_id)
				{
					$this->session->set_flashdata("success","Space has been updated successfully.");
					redirect('home/spacelist');
				}
				else
				{
					$this->session->set_flashdata("message1","Unable to update space.");
					redirect('home/editspace');
				}
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to update space.");
				redirect('home/editspace');
			}
		}

		$space_detail = $this->home_model->get_thatspace($unique_id); //Get space details
		$space_days = $this->home_model->get_spacedays($unique_id); //Get days on which that space avaiable
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$state_list = '';
		$city_list = '';
		if($space_detail)
		{
			$state_list = $this->home_model->location_getlist($space_detail['country'],2); //Get state list
			$city_list = $this->home_model->location_getlist($space_detail['state'],3); //Get city list
		}
		$data['state_list'] = $state_list;
		$data['city_list'] = $city_list;
		$data['space_detail'] = $space_detail;
		$data['space_days'] = $space_days;
		$data['space_event'] = $space_event;
		$data['menu'] = 'space';

		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['venue'] = $this->home_model->get_spacevenue($unique_id); //Get venue
		$data['country_result'] = $this->home_model->location_getlist(0,1);  //Get countries 

		$data['include'] = 'home/editspace';
		$this->load->view('frontend/container',$data);
	} 

	public function editspace_image($unique_id = '')
	{
		$this->checklogin();
		if(isset($_POST['save']))
		{
			if(strlen($unique_id) > 0)
			{
				for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
				{ 	
					$add_images = $_FILES['images']['name'][$i];
		            $count_image = 0;
		            if($add_images!='')
		            {  
			            $file_name = $_FILES['images']['name'][$i];
			            $new_file = explode(".", $file_name);
			            $extention = end($new_file);     

			            if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'gif' || $extention == 'bmp' || $extention == 'png') // Check for extention of file
			            {

			            }
			            else
			            {
			                $count_image++;
			            }  
			            if($count_image > 0)    
			            {
			                $this->session->set_flashdata("message1", "Please Upload Only Images.");
			                redirect('home/editspace_image/'.$unique_id);
			            }
			        }
				}
				$insert_id = $this->home_model->save_thespaceimages($unique_id);
				if($insert_id)
				{
					$this->session->set_flashdata("message","Space images has been uploaded successfully");
					redirect('home/editspace_image/'.$unique_id);
				}
				else
				{
					$this->session->set_flashdata("message1","Unable to upload space images.");
					redirect('home/editspace_image/'.$unique_id);
				}
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to upload space images.");
				redirect('home/editspace_image');
			}
		}
		$space_images = $this->home_model->get_spaceimages($unique_id); //Get images of the space
		$data['space_images'] = $space_images;
		$data['uni_id'] = $unique_id;
		$data['include'] = 'home/editspace_image';
		$this->load->view('frontend/container',$data);
	}

	public function delete_oneimage($unique_id = '',$id = '')
	{
		$is_deleted = $this->home_model->delete_thatspaceimage($id,$unique_id);
		if($is_deleted > 0) 
        {
            echo 1; //Deleted successfully
        }
        elseif($is_deleted == -1) 
        {
        	echo 2; //Last image is present
        }
        else
        {
        	echo 3; //Unable to delete
        }
	}

	public function delete_thatspace($id = '')
	{
		$is_deleted = $this->home_model->delete_thatspace($id);
		if($is_deleted > 0) 
        {
            echo 1; //Deleted successfully
        } 
        else
        {
        	echo 3; //Unable to delete
        }
	}

/***************************************Space details End**********************************/

/*******************************Venue And Its Searching Start******************************/

	public function venue()
	{ 
		$data['event_places'] = $this->home_model->location_getlist(2,3);
		$data['events'] = $this->home_model->get_allevents();
		$data['venue'] = $this->home_model->get_allvenue(); //Get venue
		$data['include'] = 'home/venue';
		$this->load->view('frontend/container',$data);
	} 


	public function search_bycity($place = '' ,$startdate = '',$event = 0,$guest = 0,$budget = ''){

				redirect('home/search/0/'.$place);

	}


	//public function search($page = 0,$place = 0,$state = 0,$startdate = '',$event = 0,$guest = 0,$budget = '')
	public function search($page = 0,$place = 0,$startdate = '',$venue_id= 0,$event = 0,$guest = 0,$budget = '')
	{   
		$user_id = $this->home_model->isloggeduserIn();
        if(isset($_POST['search']))
		{
			$place = intval($_POST['places']);
			// $state_list = $this->home_model->location_getlist($place,3); //Get state
			// if($state_list) 
			// {
			// 	for ($i=0; $i < count($state_list); $i++) 
			// 	{ 
			// 		//Check if state id that post is present in state list or not
			// 		if($state_list[$i]->location_id == intval($_POST['state']))
			// 		{
			// 			$state = intval($_POST['state']); //Present insert state id to that varaible
			// 			break; //Break the loop after receiving state id
			// 		}
			// 		else
			// 		{
			// 			$state = 0; //If state id not match post state id then insert zero to variable
			// 		}
			// 	}
			// }
			// else
			// {
			// 	$state = 0; //If state list empty insert zero to variable
			// } 
			$venue_id = intval($_POST['venue_id']);
			$startdate = $_POST['startdate']; 
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert date to string for url
			$event = intval($_POST['events']);
			$guest = intval($_POST['guest']);
			$budget = $_POST['budget'];  

			if (!isset($startdate)) {
				redirect('home/search/0/'.$place.'/'.$venue_id.'/'.$event.'/'.$guest.'/'.$budget);
			}else{
				redirect('home/search/0/'.$place.'/'.$startdate.'/'.$venue_id.'/'.$event.'/'.$guest.'/'.$budget);
			}
 			 
			///redirect('home/search/0/'.$place.'/'.$state.'/'.$startdate.'/'.$event.'/'.$guest.'/'.$budget);
		}

		$wh = ''; //Query variable
		if(intval($place) > 0) 
			$wh .= " AND sd.city =".$place.""; 
		
		if(intval($venue_id) > 0) 
			$wh .= " AND sd.venue_id =".$venue_id.""; 
		
		// if(intval($state) > 0)
		// 	$wh .= " AND sd.state =".$state.""; 

	if (isset($startdate)) {
		if(strlen($startdate) > 0)
		{ 
			$startdate = str_replace("-", "/", $startdate); //Convert string to date
			$newstart = date("Y-m-d", strtotime($startdate)); //Change date format to get day 

			$timestamp = strtotime($newstart);
			$day = date('D', $timestamp); //Get day from date
			$day_id = 0;
			if($day == "Mon")
				$day_id = 1;
			else if($day == "Tue")
				$day_id = 2;
			else if($day == "Wed")
				$day_id = 3;
			else if($day == "Thu")
				$day_id = 4;
			else if($day == "Fri")
				$day_id = 5;
			else if($day == "Sat")
				$day_id = 6;
			else if($day == "Sun")
				$day_id = 7; 
			//Compare day id and check whether that space is already book on that date
			$wh .= " AND(sa.day_id = ".$day_id." AND (('".$newstart."' NOT BETWEEN sb.startdate AND sb.enddate) OR (NOT EXISTS (SELECT * FROM space_booking WHERE space_id = sd.space_id))))";
		} 
	}
		 
		if(intval($event) > 0) 
			$wh .= "AND se.event_id =".$event."";

		if(intval($guest) > 0) 
			$wh .= " AND sd.guest =".$guest."";

		if(strlen($budget) > 0 && $budget != 0)  
		{
			if($budget == 10000)
			{
				$wh .= " AND sd.base_price >=".$budget."";
			}
			else
			{
				$rate = explode("-", $budget); //Seperate it to compare
				$wh .= " AND (sd.base_price BETWEEN ".$rate[0]." AND ".$rate[1].")"; 
			}
		}  

		if($startdate != 0)
		{  
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert it to string for url
		} 
		//For pagination start
		$config = array();  
		$config["suffix"] = '/'.$place.'/'.$startdate.'/'.$event.'/'.$guest.'/'.$budget;
       	$config["base_url"] = base_url()."home/search/"; 
        $config["total_rows"] = $this->home_model->space_count($wh);
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->get_searchpage($page, $config["per_page"],$wh);  //Select result per page
        $data["links"] = $this->pagination->create_links();

        $current_fav = $this->home_model->current_fav_space();
		$data['current_fav'] = $current_fav;
        
        
        $data["page_sr"] = $page + 1;
        $data['space_list'] = $result;  
        //End pagination
        if($startdate != 0) 
			$startdate = str_replace("-", "/", $startdate);  //Convert string to date
		//Data to fill input fields
        $data['place'] = $place;
        //$data['state'] = $state;
        $data['startdate'] = $startdate; 
        $data['event'] = $event;
        $data['guest'] = $guest;
        $data['budget'] = $budget;
        $data['venue_id'] = $venue_id; 
        $data['user_id'] = $user_id; 

        $data['event_places'] = $this->home_model->location_getlist(2,3); //Get country
        //$data['event_state'] = $this->home_model->location_getlist($place,2); //Get state
		$data['events'] = $this->home_model->get_allevents(); //Get events list
		$data['include'] = 'home/search';
		$this->load->view('frontend/container',$data);
	} 

	public function space_details($unique_id = '',$id='',$event='',$guest='')
	{  
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['user_id'] = $this->home_model->isloggeduserIn();
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		$data['current_date'] = $this->home_model->current_date_space($unique_id); //Get timings
		$data['booked_date'] = $this->home_model->booked_date_space($unique_id); //Get timings
		$data['review'] = $this->home_model->get_space_review($unique_id); 
		$data['venue'] = $this->home_model->get_spacevenue($unique_id); //Get venue
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		$data['event'] = $event;
		$data['guest'] = $guest;
		
		$data['include'] = 'home/space_details';
		$this->load->view('frontend/container',$data);
	} 

/*********************************Venue And Its Searching End******************************/

/***********************************Service details Start**********************************/

	public function list_ofservice()
	{
		$this->checklogin();
		$data["selected_menu"] = "list_ofservice";
   		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['commit']))
		{
			for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
			{ 	
				$add_images = $_FILES['images']['name'][$i];
	            $count_image = 0;
	            if($add_images!='')
	            {  
		            $file_name = $_FILES['images']['name'][$i];
		            $new_file = explode(".", $file_name);
		            $extention = end($new_file);     

		            if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'gif' || $extention == 'bmp' || $extention == 'png') // Check for extention of file
		            {

		            }
		            else
		            {
		                $count_image++;
		            }  
		            if($count_image > 0)    
		            {
		                $this->session->set_flashdata("message1", "Please Upload Only Images.");
		                redirect('home/list_ofservice');
		            }
		        }
			}
			$service = $this->home_model->fill_theservice();
			if($service)
			{
				// $this->session->set_flashdata("message","Service has been saved successfully.");.
				$this->session->set_flashdata("message","Please Upload your KYC Documents For Service Verification!!");
				redirect('home/kyc_ofservice/'.$service);
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to save service.");
				redirect('home/list_ofservice');
			}
		}
		$result = $this->home_model->get_number($user_id); //Get mobile number
		$data['user_details'] = $result;
		$data['country_result'] = $this->home_model->location_getlist(0,1);
		$services_list = $this->home_model->list_ofservice(); //List of services
		$data['services_list'] = $services_list;
		$data['menu'] = 'service';
		$data['submenu'] = 'list_ofservice';
		$data['include'] = 'home/list_ofservice';
		$this->load->view('frontend/container',$data);
	} 

	public function servicelist()
	{ 
		$this->checklogin();
		//For pagination start
		$config = array();  
       	$config["base_url"] = base_url()."home/servicelist/"; 
       	$config["total_rows"] = $this->home_model->count_theservicelist();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $servicelist = $this->home_model->get_theservicelist($page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		//$servicelist = $this->home_model->get_theservicelist();
		$data['servicelist'] = $servicelist;
		$data['menu'] = 'service';
		$data['include'] = 'home/servicelist';
		$this->load->view('frontend/container',$data);
	} 

	public function servicedetail_host($unique_id = '')
	{
		$this->checklogin();
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['review'] = $this->home_model->get_service_review($unique_id); 
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_location'] = $service_location;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['include'] = 'home/servicedetail_host';
		$this->load->view('frontend/container',$data);
	} 

	public function editservice($unique_id = '')
	{ 
		$this->checklogin();
		$user_id = $this->home_model->isloggeduserIn();

		if(isset($_POST['commit']))
		{
			if(strlen($unique_id) > 0)
			{
				$update_id = $this->home_model->update_theservice($unique_id);
				$this->home_model->edit_service_email(); /////EMAIL after updation
				if($update_id)
				{
					$this->session->set_flashdata("success","Service has been updated successfully.");
					redirect('home/servicelist');
				}
				else
				{
					$this->session->set_flashdata("message1","Unable to update service.");
					redirect('home/editservice');
				}
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to update service.");
				redirect('home/editservice');
			}
		}

		$service_detail = $this->home_model->get_thatservice($unique_id); //Get service details
		$service_days = $this->home_model->get_servicedays($unique_id); //Get days on which that service avaiable 
		$state_list = '';$city_list = '';
		if($service_detail)
		{
			$state_list = $this->home_model->location_getlist($service_detail['country'],2); //Get state list
			$city_list = $this->home_model->location_getlist($service_detail['state'],3); //Get city list
		}
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['service_package'] = $service_package;

		$data['state_list'] = $state_list;
		$data['city_list'] = $city_list;
		$data['service_detail'] = $service_detail;
		$data['service_days'] = $service_days; 

		$data['service'] = $this->home_model->list_ofservice(); //Get service list
		$data['country_result'] = $this->home_model->location_getlist(0,1);  //Get countries 
		$data['menu'] = 'service';
		$data['include'] = 'home/editservice';
		$this->load->view('frontend/container',$data);
	} 

	public function editservice_image($unique_id = '')
	{
		$this->checklogin();
		if(isset($_POST['save']))
		{
			if(strlen($unique_id) > 0)
			{
				for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
				{ 	
					$add_images = $_FILES['images']['name'][$i];
		            $count_image = 0;
		            if($add_images!='')
		            {  
			            $file_name = $_FILES['images']['name'][$i];
			            $new_file = explode(".", $file_name);
			            $extention = end($new_file);     

			            if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'gif' || $extention == 'bmp' || $extention == 'png') // Check for extention of file
			            {

			            }
			            else
			            {
			                $count_image++;
			            }  
			            if($count_image > 0)    
			            {
			                $this->session->set_flashdata("message1", "Please Upload Only Images.");
			                redirect('home/editservice_image/'.$unique_id);
			            }
			        }
				}
				$insert_id = $this->home_model->save_theserviceimages($unique_id);
				if($insert_id)
				{
					$this->session->set_flashdata("message","Service images has been uploaded successfully.");
					redirect('home/editservice_image/'.$unique_id);
				}
				else
				{
					$this->session->set_flashdata("message1","Unable to upload service images.");
					redirect('home/editservice_image/'.$unique_id);
				}
			}
			else
			{
				$this->session->set_flashdata("message1","Unable to upload service images.");
				redirect('home/editservice_image');
			}
		}
		$service_images = $this->home_model->get_serviceimages($unique_id); //Get images of the service
		$data['service_images'] = $service_images;
		$data['uni_id'] = $unique_id;
		$data['include'] = 'home/editservice_image';
		$this->load->view('frontend/container',$data);
	}

	public function delete_serviceimage($unique_id = '',$id = '')
	{
		$is_deleted = $this->home_model->delete_thatserviceimage($id,$unique_id);
		if($is_deleted > 0) 
        {
            echo 1; //Deleted successfully
        }
        elseif($is_deleted == -1) 
        {
        	echo 2; //Last image is present
        }
        else
        {
        	echo 3; //Unable to delete
        }
	}

	public function delete_thatservice($id = '')
	{
		$is_deleted = $this->home_model->delete_thatservice($id);
		if($is_deleted > 0) 
        {
            echo 1; //Deleted successfully
        } 
        else
        {
        	echo 3; //Unable to delete
        }
	} 

/***********************************Service details End**********************************/ 

/*****************************Service And Its Searching Start****************************/

	public function service()
	{ 
		$data["selected_menu"] = "service";
		$data['event_places'] = $this->home_model->location_getlist(2,3);
		$data['service'] = $this->home_model->list_ofservice();
		$data['include'] = 'home/service';
		$this->load->view('frontend/container',$data);
	}

	//public function search_service($page = 0,$place = 0,$state = 0,$startdate = '',$service = 0,$guest = 0,$budget = '')
	public function search_service($page = 0,$place = 0,$startdate = '',$service = 0,$guest = 0,$budget = '')
	{
		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['search']))
		{
			$place = intval($_POST['places']);
			// $state_list = $this->home_model->location_getlist($place,2); //Get state
			// if($state_list) 
			// {
			// 	for ($i=0; $i < count($state_list); $i++) 
			// 	{ 
			// 		//Check if state id that post is present in state list or not
			// 		if($state_list[$i]->location_id == intval($_POST['state']))
			// 		{
			// 			$state = intval($_POST['state']); //Present insert state id to that varaible
			// 			break; //Break the loop after receiving state id
			// 		}
			// 		else
			// 		{
			// 			$state = 0; //If state id not match post state id then insert zero to variable
			// 		}
			// 	}
			// }
			// else
			// {
			// 	$state = 0; //If state list empty insert zero to variable
			// } 
			$startdate = $_POST['startdate']; 
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert date to string for url
			$service = intval($_POST['service']);
			$guest = intval($_POST['guest']);
			$budget = $_POST['budget'];  
 			 
			if (!isset($startdate)) {
				redirect('home/search_service/0/'.$place.'/'.$service.'/'.$guest.'/'.$budget);
			}else{
				redirect('home/search_service/0/'.$place.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget);
			}
			//redirect('home/search_service/0/'.$place.'/'.$state.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget);
			

		}

		$wh = ''; //Query variable
		if(intval($place) > 0) 
			$wh .= " AND sd.city =".$place." "; 
		
		// if(intval($state) > 0)
		// 	$wh .= " AND sd.state =".$state.""; 

		if (isset($startdate)) {
			if(strlen($startdate) > 0)
		{ 
			$startdate = str_replace("-", "/", $startdate); //Convert string to date
			$newstart = date("Y-m-d", strtotime($startdate)); //Change date format to get day 

			$timestamp = strtotime($newstart);
			$day = date('D', $timestamp); //Get day from date
			$day_id = 0;
			if($day == "Mon")
				$day_id = 1;
			else if($day == "Tue")
				$day_id = 2;
			else if($day == "Wed")
				$day_id = 3;
			else if($day == "Thu")
				$day_id = 4;
			else if($day == "Fri")
				$day_id = 5;
			else if($day == "Sat")
				$day_id = 6;
			else if($day == "Sun")
				$day_id = 7; 
			//Compare day id and check whether that space is already book on that date
			$wh .= " AND (sa.day_id = ".$day_id." AND (('".$newstart."' NOT BETWEEN sb.startdate AND sb.enddate) OR (NOT EXISTS (SELECT * FROM service_booking WHERE service_id = sd.service_details_id))))";
		} 
		}
		
		 
		if(intval($service) > 0) 
			$wh .= "AND sd.service_id =".$service."";

		if(intval($guest) > 0) 
			$wh .= " AND sd.guest =".$guest."";

		if(strlen($budget) > 0 && $budget != 0)  
		{
			if($budget == 1000)
			{
				$wh .= " AND sd.base_price >=".$budget."";
			}
			else
			{
				$rate = explode("-", $budget); //Seperate it to compare
				$wh .= " AND (sd.base_price BETWEEN ".$rate[0]." AND ".$rate[1].")"; 
			}
		}  


		if($startdate != 0)
		{  
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert it to string for url
		} 

		//For pagination start
		$config = array();  
		//$config["suffix"] = '/'.$place.'/'.$state.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget;
		$config["suffix"] = '/'.$place.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget;
       	$config["base_url"] = base_url()."home/search_service/"; 
        $config["total_rows"] = $this->home_model->servicelist_count($wh);
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->get_searchservice($page, $config["per_page"],$wh);  //Select result per page


		$current_fav = $this->home_model->current_fav_service();
		$data['current_fav'] = $current_fav;
		$data['all_service'] = $this->home_model->get_allservices();
        
		//print_r($current_fav);

        $data["links"] = $this->pagination->create_links();
        $data["page_sr"] = $page + 1;
        $data['service_list'] = $result;  
        //End pagination
        if($startdate != 0) 
			$startdate = str_replace("-", "/", $startdate);  //Convert string to date
		//Data to fill input fields


        $data['place'] = $place;
        //$data['state'] = $state;
        $data['startdate'] = $startdate; 
        $data['service'] = $service;
        $data['guest'] = $guest;
        $data['budget'] = $budget;
        $data['user_id'] = $user_id; 

        $data['event_places'] = $this->home_model->location_getlist(2,3); //Get country
        //$data['event_state'] = $this->home_model->location_getlist($place,2); //Get state
		$data['service_alllist'] = $this->home_model->list_ofservice(); //Get service list
		$data['include'] = 'home/search_service';
		$this->load->view('frontend/container',$data);
	}

	public function service_details($unique_id = '',$id='',$service = '',$guest = '')
	{ 
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['user_id'] = $this->home_model->isloggeduserIn();
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		$data['current_date'] = $this->home_model->current_date_service($unique_id); //Get timings
		$data['booked_date'] = $this->home_model->booked_date_service($unique_id); //Get timings
		$data['review'] = $this->home_model->get_service_review($unique_id); 
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		$data['services'] = $this->home_model->get_allservices(); //Get Services
		$data['service'] = $service;
		//$data['guest'] = $guest;
		$data['service'] = $service;
		$data['guest'] = $guest;
		$data['include'] = 'home/service_details';
		$this->load->view('frontend/container',$data);
	} 

/*****************************Service And Its Searching End****************************/

	public function scenario()
	{
		$services_list = $this->home_model->get_allservices_details(); //List of services
		$data['services_list'] = $services_list;
		$data['events'] = $this->home_model->get_allevents();
		$data['service'] = $this->home_model->get_allservices();
		$data["selected_menu"] = "scenario";
		$data['include'] = 'home/scenario';
		$this->load->view('frontend/container',$data);
	} 

	public function search_scenario($page=0)
	{	
		$user_id = $this->home_model->isloggeduserIn();
		if (!empty($_POST['service'])) {
			$service=implode(',',$_POST['service']);
		}else{
			$service='';
		}
		
		if (!empty($_POST['location']) || !empty($_POST['events']) || !empty($_POST['service'])) {
			$newdata = array(
                   'scenarion_loc'  => $this->input->post('location'),
                   'scenarion_eve'     => $this->input->post('events'),
                   'scenarion_ser' => $service
               );
			$this->session->set_userdata($newdata);
		}
		


			$location= $this->session->userdata('scenarion_loc');
			$event= $this->session->userdata('scenarion_eve');
			$services= $this->session->userdata('scenarion_ser');

			$wh ="";
			if (strlen($location) > 0 ) {
				$wh .= " AND (sd.address LIKE '%".$location."%' OR sd.address='".$location."')";
			}else{
				$wh .="";
			}

			if (intval($event) > 0) {
				$wh .= " AND se.event_id =".$event."";
			}else{
				$wh .="";
			}

			if (strlen($services) >= 1) {
				$services="AND sd.service_id IN (".$services.")";
			}else{
				$services="";
			}

			//For pagination start
		$config = array();  
		$config["suffix"] = '/'.$page;
       	$config["base_url"] = base_url()."home/search_scenario/"; 
        $config["total_rows"] = $this->home_model->space_count($wh);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->scenario_space($page, $config["per_page"],$wh);  //Select result per page

        $data['current_cart_service'] = $this->home_model->current_cart_service();
        $data['current_cart_space'] = $this->home_model->current_cart_space();
        
        $data["links"] = $this->pagination->create_links();
        $data["page_sr"] = $page + 1;

        $data["mylocation"] = $location;
        $data["myevent"] = $event;
        $data["myservices"] = $this->session->userdata('scenarion_ser');


        $space_add = $this->home_model->get_allservices_details(); //List of services
		$data['space_add'] = $space_add;
		$data['events'] = $this->home_model->get_allevents();
		$data['service'] = $this->home_model->get_allservices();

		$data['user_id'] = $user_id;
		$data['event_id'] = $event;
		
		$data["service_list"] = $this->home_model->scenario_service($services);
		$data["space_list"] = $result;
		$data["selected_menu"] = "scenario";
		$data['include'] = 'home/search_scenario';
		$this->load->view('frontend/container',$data);

	} 

	public function activity($page=0)
	{	

		
		
		// if (!empty($_POST['location']) || !empty($_POST['events'])) {
		// 	$newdata = array(
  //                  'activity_loc'  => $_POST['location'],
  //                  'activity_eve'     => $_POST['events']
  //              );
		// 	$this->session->set_userdata($newdata);
		// }
		


		// 	$location= $this->session->userdata('activity_loc');
		// 	$event= $this->session->userdata('activity_eve');
		if (!empty($_POST['location']) || !empty($_POST['events'])) {
			$location = $_POST['location'];
			$event = $_POST['event_list'];
		}
		else{
			$location = '';
			$event = '';
		}

			$wh ="";
			if (strlen($location) > 0 ) {
				$wh .= " AND (sd.address LIKE '%".$location."%' OR sd.address = '".$location."' OR sd.zip_code = '".$location."')";
			}else{
				$wh .="";
			}

			if (intval($event) > 0) {
				$wh .= " AND se.event_id =".$event."";
			}else{
				$wh .="";
			}

			

			//For pagination start
		$config = array();  
       	$config["base_url"] = base_url()."home/activity/"; 
        $config["total_rows"] = $this->home_model->space_count($wh);
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->get_searchpage($page, $config["per_page"],$wh);  //Select result per page

        $current_fav = $this->home_model->current_fav_space();
		$data['current_fav'] = $current_fav;
        
        $data["links"] = $this->pagination->create_links();
        $data["page_sr"] = $page + 1;

        $data["mylocation"] = $location;
        $data["myevent"] = $event;


        $space_add = $this->home_model->get_allservices_details(); //List of services
		$data['space_add'] = $space_add;
		$data['events'] = $this->home_model->get_allevents();
		$data['service'] = $this->home_model->get_allservices();
        $data['event'] = $event;
        $data['user_id'] = $this->home_model->isloggeduserIn();

        $data['event_places'] = $this->home_model->location_getlist(2,3); //Get country
	
		
		//$data["service_list"] = $this->home_model->scenario_service($services);
		$data["space_list"] = $result;
		$data["selected_menu"] = "activity";
		$data['include'] = 'home/activity';
		$this->load->view('frontend/container',$data);

	} 

	public function generator()
	{
		$data['event_places'] = $this->home_model->location_getlist(2,3);
		$data["selected_menu"] = "generator";
		$data['include'] = 'home/generator';
		$this->load->view('frontend/container',$data);
	} 

	public function about()
	{
		$data['event_places'] = $this->home_model->location_getlist(2,3);
		$data["selected_menu"] = "about";
		$data['include'] = 'home/about';
		$this->load->view('frontend/container',$data);
	} 

	public function service_request($page=0, $filter ='')
	{
		$this->checklogin();
		if(isset($_POST['filter'])){
			$filter = $_POST['filter'];
			if($filter == 4)
				$filter = '0';

			redirect('home/service_request/'.$page.'/'.$filter);
		}

		$wh = ''; //Query variable
		if($filter != ''){
			$wh = " AND sb.status =".$filter."";
			//$wh .= " AND sd.city =".$place."";
		}
		$config = array();
		$config["suffix"] = '/'.$filter; 
       	$config["base_url"] = base_url()."home/service_request/"; 
       	$config["total_rows"] = $this->home_model->count_service_request($wh);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $servicelist = $this->home_model->get_service_request($wh,$page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		//$servicelist = $this->home_model->get_service_request();
		$data['servicelist'] = $servicelist;
		if($filter === '0' )
			$filter = 4;
		$data['filter'] = $filter;
		$data['menu'] = 'service';
		$data['include'] = 'home/service_request';
		$this->load->view('frontend/container',$data);
	}

	public function space_request($page=0, $filter ='')
	{
		$this->checklogin();
		if(isset($_POST['filter'])){
			$filter = $_POST['filter'];
			if($filter == 4)
				$filter = '0';

			redirect('home/space_request/'.$page.'/'.$filter);
		}

		$wh = ''; //Query variable
		if($filter != ''){
			$wh = " AND sb.status =".$filter."";
			//$wh .= " AND sd.city =".$place."";
		}


		$config = array(); 
		$config["suffix"] = '/'.$filter;
       	$config["base_url"] = base_url()."home/space_request/"; 
       	$config["total_rows"] = $this->home_model->count_space_request($wh);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $spacelist = $this->home_model->get_space_request($wh,$page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		$data['spacelist'] = $spacelist;
		if($filter === '0' )
			$filter = 4;
		$data['filter'] = $filter;
		// $data['page'] = $page;
		$data['menu'] = 'space';
		$data["selected_menu"] = "space_request";
		$data['include'] = 'home/space_request';
		$this->load->view('frontend/container',$data);
	} 

	public function fav_space()
	{
		$fav_id = $this->home_model->add_favspace(); 
		if($fav_id == true)
			echo 1; //space added
		else
			echo 0; //space not added\
	}

	public function delete_fav_space()
	{

		$result = $this->home_model->delete_favspace(); 
		if($result == true)
			echo $result; //space deleted
		else
			echo 0; //space not deleted\
	}

	public function fav_service()
	{
		$fav_id = $this->home_model->add_favservice(); 
		if($fav_id == true)
			echo 1; //space added
		else
			echo 0; //space not added\
	}

	public function delete_fav_service()
	{
		
		$result = $this->home_model->delete_favservice(); 
		if($result == true)
			echo $result; //space deleted
		else
			echo 0; //space not deleted\
	}
	
	//////////////For Fav Space////////////////////
	public function favourites($page = 0)
	{ 
		$this->checklogin();
		$config = array();  
       	$config["base_url"] = base_url()."home/favourites/"; 
       	$config["total_rows"] = $this->home_model->count_favspacelist();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $spacelist = $this->home_model->get_favspacelist($page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		//$spacelist = $this->home_model->get_favspacelist();
		$data['spacelist'] = $spacelist;
		$data['menu'] = 'space';
		$data['include'] = 'home/favourites';
		$this->load->view('frontend/container',$data);
	}

	public function delete_myfav_space()
	{	
		$user_id = $this->home_model->isloggeduserIn();
		$space_id = ucfirst($_POST['space_id']);
		$result = $this->db->query("DELETE FROM fav_spaces where space_id = '$space_id' AND user_id='$user_id'");
		if($result)
			echo 1; //space deleted
		else
			echo 0; //space not deleted\
	}
	/////////////For Fav Service///////////////////
	public function favourites_services()
	{ 
		$this->checklogin();
		$config = array();  
       	$config["base_url"] = base_url()."home/favourites_services/"; 
       	$config["total_rows"] = $this->home_model->count_favservicelist();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $servicelist = $this->home_model->get_favservicelist($page, $config["per_page"]);  //Select result per page
        $data["links"] = $this->pagination->create_links();
		//$servicelist = $this->home_model->get_favservicelist();

		$data['servicelist'] = $servicelist;
		$data['menu'] = 'service';
		$data['include'] = 'home/favourites_services';
		$this->load->view('frontend/container',$data);
	}
	public function delete_myfav_service()
	{	
		$user_id = $this->home_model->isloggeduserIn();
		$service_id = ucfirst($_POST['service_id']);
		$result = $this->db->query("DELETE FROM fav_services where service_id = '$service_id' AND user_id='$user_id'");
		if($result)
			echo 1; //space deleted
		else
			echo 0; //space not deleted\
	}


	public function getlocation()
{
    $address = "gadge";
    $city = "amravati";
    $state = "maharashtra";
    $array  = $this->home_model->get_longitude_latitude($address,$city,$state);
    $latitude  = round($array['latitude'], 6);
    $longitude = round($array['longitude'], 6); 

    echo $latitude;
    echo $longitude;          
}
 
    


	public function req_book($unique_id)
	{	
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		//$data['event'] = $event;
		//$data['guest'] = $guest;
		$data['include'] = 'home/req_book';
		//$data['otp_places'] = $this->home_model->locationlist();
		$this->load->view('frontend/container',$data);
	}

	public function service_req_book($unique_id)
	{	
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$data['service_detail'] = $service_detail;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		$data['services'] = $this->home_model->get_allservices(); //Get Services
		//$data['service'] = $service;
		//$data['event'] = $event;
		//$data['guest'] = $guest;
		$data['include'] = 'home/service_req_book';
		//$data['otp_places'] = $this->home_model->locationlist();
		$this->load->view('frontend/container',$data);
	}



	public function mymap()
	{
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/mymap';
		$this->load->view('frontend/container',$data);
	}

	public function booked_space($unique_id,$id = 0)
	{
		$this->checklogin();
		if (isset($_POST['amount'])) {
			$insert_id= $this->home_model->insert_booked_space();
			$mail= $this->home_model->booked_space_email($unique_id,$insert_id);
			redirect('home/booked_space/'.$unique_id.'/'.$insert_id);
		}
		
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['booked_space'] = $this->home_model->get_booked_space($id); //Get events
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/booked_space';
		$this->load->view('frontend/container',$data);
	}

	public function booked_service($unique_id,$id = 0)
	{
		$this->checklogin();
		if (isset($_POST['amount'])) {
			$insert_id= $this->home_model->insert_booked_service();
			$mail= $this->home_model->booked_service_email($unique_id,$insert_id);
			redirect('home/booked_service/'.$unique_id.'/'.$insert_id);
		}
		
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['booked_service'] = $this->home_model->get_booked_service($id); //Get events
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/booked_service';
		$this->load->view('frontend/container',$data);
	}

	public function between_dates()
	{
		$event_start= explode(" ", $_POST['start_time']);
        $event_end= explode(" ", $_POST['end_time']);
        $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
        $end_time = $event_end[0].":00 ".strtolower($event_end[1]);
        $time = explode(",", $_POST['time_array']);

        $date2 = date('H:i',strtotime($start_time));
        $date3 = date('H:i',strtotime($end_time));

        for ($l=0; $l < count($time); $l++) 
            {
            	if ($time[$l] >= $date2 && $time[$l] <= $date3) {
                       $is_disable = 1;
                       break;
                    }else{
                    	$is_disable = 0;
                    	// break;
                    }
            }
            echo $is_disable;
	}

	public function update_booked_status()
	{	

		if ($_POST['table'] == 'service') {
			$table = 'service_booking';
			$field = 'service_booking_id';
		}else{
			$table = 'space_booking';
			$field = 'space_booking_id';
		}
		/////////////// Confirm email ///////////////////
		if($_POST['status'] == 1 && $_POST['table'] == 'space')
		{
			$this->home_model->confirm_space_email($_POST['unique_id'],$_POST['id']);
		}
		if($_POST['status'] == 1 && $_POST['table'] == 'service')
		{
			$this->home_model->confirm_service_email($_POST['unique_id'],$_POST['id']);
		}
		/////////////// Confirm email ///////////////////
		if($_POST['status'] == 2 && $_POST['table'] == 'space')
		{
			$this->home_model->complete_space_email($_POST['unique_id'],$_POST['id']);
		}
		if($_POST['status'] == 2 && $_POST['table'] == 'service')
		{
			$this->home_model->complete_service_email($_POST['unique_id'],$_POST['id']);
		}
		/////////////// Cancel email ///////////////////
		if($_POST['status'] == 3 && $_POST['table'] == 'space')
		{
			$this->home_model->cancel_space_email($_POST['unique_id'],$_POST['id']);
		}
		if($_POST['status'] == 3 && $_POST['table'] == 'service')
		{
			$this->home_model->cancel_service_email($_POST['unique_id'],$_POST['id']);
		}
		/////////////// Cancel email ///////////////////


		$data = array('status' => $_POST['status']);
		$this->db->Where($field,$_POST['id']);
		$update_id = $this->db->Update($table,$data);
		if ($update_id) {
			echo $_POST['id'];
		}else{
			echo 0;
		}

	}

	public function my_booking()
	{
		$this->checklogin();
		$spacelist = $this->home_model->get_booked_space_request();
		$data['spacelist'] = $spacelist;
		$servicelist = $this->home_model->get_booked_service_request();
		$data['servicelist'] = $servicelist;
		$data["selected_menu"] = "my_booking";
		$data["menu"] = "account";
		$data['include'] = 'home/my_booking';
		$this->load->view('frontend/container',$data);
	}

	public function service_review()
	{	

		$this->home_model->insert_service_review();
		$data = array('is_reviewed' => 1);
		$this->db->Where('service_booking_id',$_POST['id']);
		$update_id = $this->db->Update('service_booking',$data);
		if ($update_id) {
			echo $_POST['id'];
		}else{
			echo 0;
		}

	}

	public function space_review()
	{	

		$this->home_model->insert_space_review();
		$data = array('is_reviewed' => 1);
		$this->db->Where('space_booking_id',$_POST['id']);
		$update_id = $this->db->Update('space_booking',$data);
		if ($update_id) {
			echo $_POST['id'];
		}else{
			echo 0;
		}

	}

	public function update_service_review()
	{	
		$data = array(
			'stars' => $_POST['stars'],
			'review' => $_POST['review'] );

		$this->db->Where('booking_id',$_POST['id']);
		$update_id = $this->db->Update('service_review',$data);
		if ($update_id) {
			echo $_POST['id'];
		}else{
			echo 0;
		}

	}

	public function update_space_review()
	{	
		$data = array(
			'stars' => $_POST['stars'],
			'review' => $_POST['review'] );

		$this->db->Where('booking_id',$_POST['id']);
		$update_id = $this->db->Update('space_review',$data);
		if ($update_id) {
			echo $_POST['id'];
		}else{
			echo 0;
		}

	}

	public function kyc_ofspace($id='')
	{	

		if (isset($_POST['submit'])) {
		
			$insert_id = $this->home_model->update_space_document();
			if($insert_id)
			{
				$this->session->set_flashdata("success","Documents saved successfully.");
				redirect('home/spacelist');
			}
			else
			{
				$this->session->set_flashdata("error","Unable to save documents.");
				redirect('home/kyc_ofspace/'.$id);
			}

		}
			$data['documents'] = $this->home_model->get_space_document($id);
			$data['id'] = $id;
			$data['menu'] = 'space';
			$data['include'] = 'home/kyc_ofspace';
			$this->load->view('frontend/container',$data);

	}

	public function kyc_ofservice($id='')
	{	

		if (isset($_POST['submit'])) {
		
			$insert_id = $this->home_model->update_service_document();
			if($insert_id)
			{
				$this->session->set_flashdata("success","Documents saved successfully.");
				redirect('home/servicelist');
			}
			else
			{
				$this->session->set_flashdata("error","Unable to save documents.");
				redirect('home/kyc_ofservice/'.$id);
			}

		}
			$data['documents'] = $this->home_model->get_service_document($id);
			$data['id'] = $id;
			$data["menu"] = "service";
			$data['include'] = 'home/kyc_ofservice';
			$this->load->view('frontend/container',$data);

	}

	public function razorpay()
	{	
			
			$data['include'] = 'home/razor-pay';
			$this->load->view('frontend/container',$data);

	}

	public function razorpay2()
	{	
			//print_r($_POST);
			$ch = $this->home_model->get_curl_handle($_POST['razorpay_payment_id'], 400);
			$result = curl_exec($ch);
			$response_array = json_decode($result, true);
			print_r($response_array);
			$data['include'] = 'home/razor-pay';
			$this->load->view('frontend/container',$data);

	}

	 // initialized cURL Request
	public function view_booked_space($unique_id,$id = 0)
	{
		$this->checklogin();
		if (isset($_POST['amount'])) {
			$insert_id= $this->home_model->insert_booked_space();
			redirect('home/booked_space/'.$unique_id.'/'.$insert_id);
		}
		
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['booked_space'] = $this->home_model->get_booked_space($id); //Get events
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/view_booked_space';
		$this->load->view('frontend/container',$data);
	}

	public function view_booked_service($unique_id,$id = 0)
	{
		$this->checklogin();
		if (isset($_POST['amount'])) {
			$insert_id= $this->home_model->insert_booked_service();
			redirect('home/booked_service/'.$unique_id.'/'.$insert_id);
		}
		
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['booked_service'] = $this->home_model->get_booked_service($id); //Get events
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/view_booked_service';
		$this->load->view('frontend/container',$data);
	}

	public function scenario_space($page=0,$place = 0,$startdate = '',$event = 0,$guest = 0,$budget = '')
	{	
		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['search']))
		{
			$place = intval($_POST['places']);
			$startdate = $_POST['startdate']; 
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert date to string for url
			$event = intval($_POST['events']);
			$guest = intval($_POST['guest']);
			$budget = $_POST['budget'];  

			if (!isset($startdate)) {
				redirect('home/scenario_space/0/'.$place.'/'.$event.'/'.$guest.'/'.$budget);
			}else{
				redirect('home/scenario_space/0/'.$place.'/'.$startdate.'/'.$event.'/'.$guest.'/'.$budget);
			}
		}

		$wh = ''; //Query variable
		if(intval($place) > 0) 
			$wh .= " AND sd.city =".$place.""; 
		 

		if (isset($startdate)) {
			if(strlen($startdate) > 0)
			{ 
				$startdate = str_replace("-", "/", $startdate); //Convert string to date
				$newstart = date("Y-m-d", strtotime($startdate)); //Change date format to get day 

				$timestamp = strtotime($newstart);
				$day = date('D', $timestamp); //Get day from date
				$day_id = 0;
				if($day == "Mon")
					$day_id = 1;
				else if($day == "Tue")
					$day_id = 2;
				else if($day == "Wed")
					$day_id = 3;
				else if($day == "Thu")
					$day_id = 4;
				else if($day == "Fri")
					$day_id = 5;
				else if($day == "Sat")
					$day_id = 6;
				else if($day == "Sun")
					$day_id = 7; 
				//Compare day id and check whether that space is already book on that date
				$wh .= " AND(sa.day_id = ".$day_id." AND (('".$newstart."' NOT BETWEEN sb.startdate AND sb.enddate) OR (NOT EXISTS (SELECT * FROM space_booking WHERE space_id = sd.space_id))))";
			} 
		}
		 
		if(intval($event) > 0) 
			$wh .= "AND se.event_id =".$event."";

		if(intval($guest) > 0) 
			$wh .= " AND sd.guest =".$guest."";

		if(strlen($budget) > 0 && $budget != 0)  
		{
			if($budget == 10000)
			{
				$wh .= " AND sd.base_price >=".$budget."";
			}
			else
			{
				$rate = explode("-", $budget); //Seperate it to compare
				$wh .= " AND (sd.base_price BETWEEN ".$rate[0]." AND ".$rate[1].")"; 
			}
		}  

			$location= $this->session->userdata('scenarion_loc');
			$event2= $this->session->userdata('scenarion_eve');
			
			if (strlen($location) > 0 ) {
				$wh .= " AND (sd.address LIKE '%".$location."%' OR sd.address='".$location."')";
			}else{
				$wh .="";
			}

			if (intval($event) > 0) {
				$wh .= " AND se.event_id =".$event2."";
			}else{
				$wh .="";
			}

		if($startdate != 0)
		{  
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert it to string for url
		} 

		//For pagination start
		$config = array();  
		$config["suffix"] = '/'.$place.'/'.$startdate.'/'.$event.'/'.$guest.'/'.$budget;
       	$config["base_url"] = base_url()."home/scenario_space/"; 
        $config["total_rows"] = $this->home_model->space_count($wh);
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->get_searchpage($page, $config["per_page"],$wh);  //Select result per page

        $current_fav = $this->home_model->current_fav_space();
		$data['current_fav'] = $current_fav;
        
        $data["links"] = $this->pagination->create_links();
        $data["page_sr"] = $page + 1;
        $data['space_list'] = $result;  
        //End pagination
        if($startdate != 0) 
			$startdate = str_replace("-", "/", $startdate);  //Convert string to date
		//Data to fill input fields
        $data['place'] = $place;
        //$data['state'] = $state;
        $data['startdate'] = $startdate; 
        $data['event'] = $event;
        $data['guest'] = $guest;
        $data['budget'] = $budget; 
        $data['user_id'] = $user_id; 

        $data['event_places'] = $this->home_model->location_getlist(2,3); //Get country
        //$data['event_state'] = $this->home_model->location_getlist($place,2); //Get state
		$data['events'] = $this->home_model->get_allevents(); //Get events list

		$data['include'] = 'home/scenario_space';
		$this->load->view('frontend/container',$data);

	}

	public function scenario_service($page = 0,$place = 0,$startdate = '',$service = 0,$guest = 0,$budget = '')
	{
		$user_id = $this->home_model->isloggeduserIn();
		if(isset($_POST['search']))
		{
			$place = intval($_POST['places']);
			$startdate = $_POST['startdate']; 
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert date to string for url
			$service = intval($_POST['service']);
			$guest = intval($_POST['guest']);
			$budget = $_POST['budget'];  
 			 
			if (!isset($startdate)) {
				redirect('home/scenario_service/0/'.$place.'/'.$service.'/'.$guest.'/'.$budget);
			}else{
				redirect('home/scenario_service/0/'.$place.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget);
			}
			//redirect('home/search_service/0/'.$place.'/'.$state.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget);
			

		}

		$wh = ''; //Query variable
		if(intval($place) > 0) 
			$wh .= " AND sd.city =".$place.""; 
		
		// if(intval($state) > 0)
		// 	$wh .= " AND sd.state =".$state.""; 

		if (isset($startdate)) {
			if(strlen($startdate) > 0)
		{ 
			$startdate = str_replace("-", "/", $startdate); //Convert string to date
			$newstart = date("Y-m-d", strtotime($startdate)); //Change date format to get day 

			$timestamp = strtotime($newstart);
			$day = date('D', $timestamp); //Get day from date
			$day_id = 0;
			if($day == "Mon")
				$day_id = 1;
			else if($day == "Tue")
				$day_id = 2;
			else if($day == "Wed")
				$day_id = 3;
			else if($day == "Thu")
				$day_id = 4;
			else if($day == "Fri")
				$day_id = 5;
			else if($day == "Sat")
				$day_id = 6;
			else if($day == "Sun")
				$day_id = 7; 
			//Compare day id and check whether that space is already book on that date
			$wh .= " AND (sa.day_id = ".$day_id." AND (('".$newstart."' NOT BETWEEN sb.startdate AND sb.enddate) OR (NOT EXISTS (SELECT * FROM service_booking WHERE service_id = sd.service_details_id)))) ";
		} 
		}

		if(intval($guest) > 0) 
			$wh .= " AND sd.guest =".$guest." ";

		if(strlen($budget) > 0 && $budget != 0)  
		{
			if($budget == 1000)
			{
				$wh .= " AND sd.base_price >=".$budget."";
			}
			else
			{
				$rate = explode("-", $budget); //Seperate it to compare
				$wh .= " AND (sd.base_price BETWEEN ".$rate[0]." AND ".$rate[1].")"; 
			}
		}  


		if($startdate != 0)
		{  
			$start = explode('/',$startdate);
			$startdate = implode("-",$start); //Convert it to string for url
		} 

		if(intval($service) > 0) {
				$wh .= " AND sd.service_id =".$service."";
			}else{
				$services= $this->session->userdata('scenarion_ser');
				if (strlen($services) >= 1) {
						$wh .="AND sd.service_id IN (".$services.")";
					}
		}

		//For pagination start
		$config = array();  
		//$config["suffix"] = '/'.$place.'/'.$state.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget;
		$config["suffix"] = '/'.$place.'/'.$startdate.'/'.$service.'/'.$guest.'/'.$budget;
       	$config["base_url"] = base_url()."home/scenario_service/"; 
        $config["total_rows"] = $this->home_model->servicelist_count($wh);
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        $config['cur_tag_close'] = "</b></a></li>";

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result = $this->home_model->get_searchservice($page, $config["per_page"],$wh);  //Select result per page


		$current_fav = $this->home_model->current_fav_service();
		$data['current_fav'] = $current_fav;
		$data['all_service'] = $this->home_model->get_allservices();
        
		//print_r($current_fav);

        $data["links"] = $this->pagination->create_links();
        $data["page_sr"] = $page + 1;
        $data['service_list'] = $result;  
        //End pagination
        if($startdate != 0) 
			$startdate = str_replace("-", "/", $startdate);  //Convert string to date
		//Data to fill input fields


        $data['place'] = $place;
        //$data['state'] = $state;
        $data['startdate'] = $startdate; 
        $data['service'] = $service;
        $data['guest'] = $guest;
        $data['budget'] = $budget;
        $data['user_id'] = $user_id; 

        $data['event_places'] = $this->home_model->location_getlist(2,3); //Get country
        //$data['event_state'] = $this->home_model->location_getlist($place,2); //Get state
		$data['service_alllist'] = $this->home_model->list_ofservice(); //Get service list
		$data['include'] = 'home/scenario_service';
		$this->load->view('frontend/container',$data);
	}


	public function cart_space()
	{
		$insert_id = $this->home_model->add_cartspace(); 
		if($insert_id == true)
			echo 1; //space added
		else
			echo 0; //space not added\
	}

	public function delete_cart_space()
	{

		$result = $this->home_model->delete_cartspace(); 
		if($result == true)
			echo $result; //space deleted
		else
			echo 0; //space not deleted\
	}

	public function cart_service()
	{
		$insert_id = $this->home_model->add_cartservice(); 
		if($insert_id == true)
			echo 1; //space added
		else
			echo 0; //space not added\
	}

	public function delete_cart_service()
	{
		
		$result = $this->home_model->delete_cartservice(); 
		if($result == true)
			echo $result; //space deleted
		else
			echo 0; //space not deleted\
	}

	public function view_cart()
	{
		
		$this->checklogin();
		$event= $this->session->userdata('scenarion_eve');
		$user_id = $this->home_model->isloggeduserIn();
		$spacelist = $this->home_model->get_cart_space();
		$data['spacelist'] = $spacelist;
		$servicelist = $this->home_model->get_cart_service();
		//$data['event_name'] = $this->home_model->get_event($event);
		$data['servicelist'] = $servicelist;
		$data['user_id'] = $user_id;
		$data['menu'] = 'space';
		$data['include'] = 'home/view_cart';
		$this->load->view('frontend/container',$data);
	}


	public function delete_mycart_service()
	{	
		$user_id = $this->home_model->isloggeduserIn();
		$service_id = ucfirst($_POST['cart_id']);
		$result = $this->db->query("DELETE FROM cart_services where service_cart_id = '$service_id'");
		if($result)
			echo 1; //space deleted
		else
			echo 0; //space not deleted\
	}

	public function delete_mycart_space()
	{	
		$user_id = $this->home_model->isloggeduserIn();
		$space_id = ucfirst($_POST['cart_id']);
		$result = $this->db->query("DELETE FROM cart_spaces where space_cart_id = '$space_id'");
		if($result)
			echo 1; //space deleted
		else
			echo 0; //space not deleted\
	}


	public function view_space_details($unique_id = '',$id='',$event='',$guest='')
	{  
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['user_id'] = $this->home_model->isloggeduserIn();
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		$data['current_date'] = $this->home_model->current_date_space($id); //Get timings
		$data['review'] = $this->home_model->get_space_review($unique_id);
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		$data['event'] = $event;
		$data['guest'] = $guest;
		
		$data['include'] = 'home/view_space_details';
		$this->load->view('frontend/container',$data);
	}


	public function view_service_details($unique_id = '',$id='',$service = '',$guest = '')
	{ 
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['user_id'] = $this->home_model->isloggeduserIn();
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		$data['current_date'] = $this->home_model->current_date_service($id); //Get timings
		$data['review'] = $this->home_model->get_service_review($unique_id); 
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		$data['services'] = $this->home_model->get_allservices(); //Get Services
		$data['service'] = $service;
		//$data['guest'] = $guest;
		$data['service'] = $service;
		$data['guest'] = $guest;
		$data['include'] = 'home/view_service_details';
		$this->load->view('frontend/container',$data);
	}

	public function book_cart_space()
	{
		$insert_id= $this->home_model->insert_booked_space();
		if ($insert_id) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function book_cart_service()
	{
		$insert_id= $this->home_model->insert_booked_service();
		if ($insert_id) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function service_subscribe()
	{
		$insert_id= $this->home_model->insert_service_subscription();
		$mail= $this->home_model->service_subscription_email();

		if ($insert_id) {
			echo $insert_id;
		}else{
			echo 0;
		}
	}

	public function space_subscribe()
	{
		$insert_id= $this->home_model->insert_space_subscription();
		$mail= $this->home_model->space_subscription_email();

		if ($insert_id) {
			echo $insert_id;
		}else{
			echo 0;
		}
	}

	public function check_service_subscription()
	{
		$user_id = $this->home_model->isloggeduserIn();
		$service_id = $_POST['service_id'];
		$result = $this->db->query("SELECT * FROM service_subscription WHERE user_id = '$user_id' AND service_id ='$service_id' AND is_paid =1 ORDER BY subscription_id DESC LIMIT 1");
		$row = $result->row_array();
		if($row){
			if($row['is_completed'] == 0){
				echo "1|".$row['plan_id']."|".$row['subscription_id'];
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}

	}

	public function check_space_subscription()
	{
		$user_id = $this->home_model->isloggeduserIn();
		$venue_id = $_POST['venue_id'];
		$result = $this->db->query("SELECT * FROM space_subscription WHERE user_id = '$user_id' AND venue_id ='$venue_id' AND is_paid =1 ORDER BY subscription_id DESC LIMIT 1");
		$row = $result->row_array();
		if($row){
			if($row['is_completed'] == 0){
				echo "1|".$row['plan_id']."|".$row['subscription_id'];
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}

	}

	public function my_subscription()
	{
		$this->checklogin();
		$spacelist = $this->home_model->get_subscribed_space();
		$data['spacelist'] = $spacelist;
		$servicelist = $this->home_model->get_subscribed_service();
		$data['servicelist'] = $servicelist;
		$data["selected_menu"] = "my_subscription";
		$data["menu"] = "account";
		$data['include'] = 'home/my_subscription';
		$this->load->view('frontend/container',$data);
	}

	public function view_booked_space_host($unique_id,$id = 0)
	{
		$this->checklogin();
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$space_image = $this->home_model->get_spaceimage($unique_id);
		$space_days = $this->home_model->get_spacedays($unique_id);
		$space_location = $this->home_model->get_thatspace_location($unique_id);
		$space_event = $this->home_model->get_spaceevent($unique_id); //Get events of that space
		$data['events'] = $this->home_model->get_allevents(); //Get events
		$data['booked_space'] = $this->home_model->get_booked_space($id); //Get events
		$data['space_location'] = $space_location;
		$data['space_event'] = $space_event;
		$data['space_detail'] = $space_detail;
		$data['space_image'] = $space_image;
		$data['space_days'] = $space_days;
		$data['unique_id'] = $unique_id;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/view_booked_space_host';
		$this->load->view('frontend/container',$data);
	}

	public function view_booked_service_host($unique_id,$id = '')
	{
		$this->checklogin();
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$service_image = $this->home_model->get_serviceimage($unique_id);
		$service_days = $this->home_model->get_servicedays($unique_id);
		$service_location = $this->home_model->get_thatservice_location($unique_id);
		$service_package = $this->home_model->get_service_package($unique_id);
		$data['booked_service'] = $this->home_model->get_booked_service($id); //Get events
		$data['service_detail'] = $service_detail;
		$data['service_package'] = $service_package;
		$data['service_image'] = $service_image;
		$data['service_days'] = $service_days;
		$data['service_location'] = $service_location;
		$data['unique_id'] = $unique_id;
		//$data["selected_menu"] = "spacebooking";
		$data['include'] = 'home/view_booked_service_host';
		$this->load->view('frontend/container',$data);
	}

	public function edit_spacebooking_details($unique_id = '', $id ='')
	{
		$data['space_detail'] = $this->home_model->get_thatspace($unique_id);
		$data['current_date'] = $this->home_model->current_date_space($unique_id); //Get timings
		$data['booked_date'] = $this->home_model->booked_date_space($unique_id); //Get timings
		$data['booked_space'] = $this->home_model->get_booked_space($id); //Get events
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		//$data["selected_menu"] = "spacebooking";
		$data['unique_id'] = $unique_id;
		$data['include'] = 'home/edit_spacebooking_details';
		$this->load->view('frontend/container',$data);
	}

	public function update_booked_space($id ='')
	{
		$data = array(
			'startdate' => $_POST['startdate'],
			'start_time' => $_POST['start_time'],
			'enddate' => $_POST['enddate'],
			'end_time' => $_POST['end_time'],
			'amount' => $_POST['amount'],
			 );

		$this->db->Where('space_booking_id',$id);
		$update_id = $this->db->Update('space_booking',$data);
		if($update_id)
			{
				$this->session->set_flashdata("success","Booking details updated successfully.");
				redirect('home/view_booked_space_host/'.$_POST['unique_id'].'/'.$id);
			}
			else
			{
				$this->session->set_flashdata("error","Unable to update booking details.");
				redirect('home/view_booked_space_host/'.$_POST['unique_id'].'/'.$id);
			}

	}

	public function edit_servicebooking_details($unique_id = '', $id ='')
	{
		$data['service_detail'] = $this->home_model->get_thatservice($unique_id);
		$data['current_date'] = $this->home_model->current_date_service($unique_id); //Get timings
		$data['booked_date'] = $this->home_model->booked_date_service($unique_id); //Get timings
		$data['booked_service'] = $this->home_model->get_booked_service($id); //Get events
		$data['timings'] = $this->home_model->get_timings(); //Get timings
		//$data["selected_menu"] = "servicebooking";
		$data['unique_id'] = $unique_id;
		$data['include'] = 'home/edit_servicebooking_details';
		$this->load->view('frontend/container',$data);
	}

	public function update_booked_service($id ='')
	{
		$data = array(
			'startdate' => $_POST['startdate'],
			'start_time' => $_POST['start_time'],
			'enddate' => $_POST['enddate'],
			'end_time' => $_POST['end_time'],
			'amount' => $_POST['amount'],
			 );

		$this->db->Where('service_booking_id',$id);
		$update_id = $this->db->Update('service_booking',$data);
		if($update_id)
			{
				$this->session->set_flashdata("success","Booking details updated successfully.");
				redirect('home/view_booked_service_host/'.$_POST['unique_id'].'/'.$id);
			}
			else
			{
				$this->session->set_flashdata("error","Unable to update booking details.");
				redirect('home/view_booked_service_host/'.$_POST['unique_id'].'/'.$id);
			}

	}

	public function check_booking($unique_id)
	{
		$date = $_POST['startdate'];
		$end = $_POST['enddate'];
		if($_POST['table'] == 'space'){
			$table = 'space_booking';
			$fields = 'space_id';
			$fields2 = 'space_id';
			$table2 = 'space_details';
		}else{
			$table = 'service_booking';
			$fields = 'service_details_id';
			$fields2 = 'service_id';
			$table2 = 'service_details';
		}
		$query = $this->db->query("SELECT * FROM ".$table." WHERE (startdate <= '".$date."' AND enddate >= '".$date."') OR (startdate <= '".$end."' AND enddate >= '".$end."') AND status = 1 AND ".$fields2." IN (SELECT ".$fields." FROM ".$table2." WHERE unique_id = '".$unique_id."')")->row_array();

		if($query) {
			$event_start= explode(" ", $query['start_time']);
	        $event_end= explode(" ", $query['end_time']);
	        $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
	        $end_time = $event_end[0].":00 ".strtolower($event_end[1]);

	        $current= explode(" ", $_POST['start_time']);
	        //$current= explode(" ", '6 PM');
	        $current_time = $current[0].":00 ".strtolower($current[1]);

	        $date1 = date('H:i',strtotime($current_time));
	        $date2 = date('H:i',strtotime($start_time));
	        $date3 = date('H:i',strtotime($end_time));

	        if ($date1 >= $date2 && $date1 <= $date3) {
	        	echo 1;
	        }else{
	        	echo 0;
	        }
	    }else{
	    	echo 0;
	    }

	}

	public function send_sms()
	{
		$msg = "bike service hhoy";
		$response = $this->home_model->sendmessage($msg,'7972152043');
		echo $response;
	}

	public function renew_space_subscription($unique_id)
	{
		$this->checklogin();
		$data['space_images'] = $this->home_model->get_spaceimage($unique_id);
		$data['subscribed_space'] = $this->home_model->get_thatsubscribed_space($unique_id); //Get events
		$data['unique_id'] = $unique_id;
		$data['include'] = 'home/renew_space_subscription';
		$this->load->view('frontend/container',$data);
	}

	public function space_renewal()
	{
		$end_date = date('Y-m-d',strtotime($_POST['ends_on']));
		$date = date('Y-m-d');
		if($_POST['renew_amount'] == '0')
			$amount  = $_POST['amount'] + $_POST['amount'];
		else
			$amount  = $_POST['renew_amount'] + $_POST['amount'];

		if( $date >= $end_date ){
			if($_POST['plan_id'] == '1'){
				$end = date('d-m-Y', strtotime('+1 years'));
				$start = date('d-m-Y');
			}else{
				$end = date('d-m-Y', strtotime('+6 month'));
				$start = date('d-m-Y');
			} 
		}else{
			if($_POST['plan_id'] == '1'){
				$end = date('d-m-Y', strtotime('+1 years', strtotime($_POST['ends_on'])));
				$start = $_POST['starts_on'];
			}else{
				$end = date('d-m-Y', strtotime('+6 month', strtotime($_POST['ends_on'])));
				$start = $_POST['starts_on'];
			} 
		}

		$data = array(
						'starts_on' => $_POST['starts_on'],
						'ends_on' => $end,
						'renew_amount' => $amount
					);
		$this->db->Where('subscription_id',$_POST['subscription_id']);
		$update_id = $this->db->Update('space_subscription',$data);
		if($update_id)
			{
				$this->session->set_flashdata("success","Renewal of your package is successfully done.");
				redirect('home/renew_space_subscription/'.$_POST['unique_id']);
			}
			else
			{
				$this->session->set_flashdata("error","Unable to renew your package.");
				redirect('home/renew_space_subscription/'.$_POST['unique_id']);
			}
	}

	public function renew_service_subscription($unique_id)
	{
		$this->checklogin();
		$data['service_images'] = $this->home_model->get_serviceimage($unique_id);
		$data['subscribed_service'] = $this->home_model->get_thatsubscribed_service($unique_id); //Get events
		$data['unique_id'] = $unique_id;
		$data['include'] = 'home/renew_service_subscription';
		$this->load->view('frontend/container',$data);
	}

	public function service_renewal()
	{
		$end_date = date('Y-m-d',strtotime($_POST['ends_on']));
		$date = date('Y-m-d');
		if($_POST['renew_amount'] == '0')
			$amount  = $_POST['amount'] + $_POST['amount'];
		else
			$amount  = $_POST['renew_amount'] + $_POST['amount'];

		if( $date >= $end_date ){
			if($_POST['plan_id'] == '1'){
				$end = date('d-m-Y', strtotime('+1 years'));
				$start = date('d-m-Y');
			}else{
				$end = date('d-m-Y', strtotime('+6 month'));
				$start = date('d-m-Y');
			} 
		}else{
			if($_POST['plan_id'] == '1'){
				$end = date('d-m-Y', strtotime('+1 years', strtotime($_POST['ends_on'])));
				$start = $_POST['starts_on'];
			}else{
				$end = date('d-m-Y', strtotime('+6 month', strtotime($_POST['ends_on'])));
				$start = $_POST['starts_on'];
			} 
		}

		$data = array(
						'starts_on' => $_POST['starts_on'],
						'ends_on' => $end,
						'renew_amount' => $amount
					);
		$this->db->Where('subscription_id',$_POST['subscription_id']);
		$update_id = $this->db->Update('service_subscription',$data);
		if($update_id)
			{
				$this->session->set_flashdata("success","Renewal of your package is successfully done.");
				redirect('home/renew_service_subscription/'.$_POST['unique_id']);
			}
			else
			{
				$this->session->set_flashdata("error","Unable to renew your package.");
				redirect('home/renew_service_subscription/'.$_POST['unique_id']);
			}
	}

	public function subscription_cornjob()
	{
		$this->home_model->space_renewal_record();
		$this->home_model->service_renewal_record();
		$this->home_model->space_expired_record();
		$this->home_model->service_expired_record(); 
		//print_r($subscribed_space);
	}


	//*******04-08-2016*******//
	
	
}


	 

	 
             