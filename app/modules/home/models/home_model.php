<?php
class Home_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('encrypt');
 
        //$this->load->library('Facebook', $config);
	} 

/***************************************Constant Functions Start**********************************/	
	
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

	public function randomPassword()
	{
	    $alphabet = '1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 4; $i++)
	    {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	public function sendemail($emails,$sub,$msg)
	{
		$message = '';
        $message = '<html><head><title>Settle</title></head><body><div style="overflow: hidden;" class="a3s" id=":16z"><div class="adM"></div><div><div class="adM"></div><div style="border-left: 1px solid #ddd;min-height: 52px;border-right: 1px solid #ddd;border-top: 1px solid #ddd;color: #666;margin: 0 auto;padding: 11px 0 10px 12px; background-color:#00aeaf;"><div class="adM"> </div><a target="_blank" href="'.base_url().'"><img style="border:0 none;color:#666;height:50px;width:140px; vertical-align:middle;" src="'.base_url().'themes/frontend/images/logo-1.png" alt="Settle" class="CToWUd"></a>  </div><div style="border:1px solid #ddd;color:#666;margin:0 auto;padding:0 20px 20px"><div style="color:#666"><h4 style="font-family:arial!important"> </h4><div style="font-size:12px;line-height:20px;font-family:arial!important">'.$msg.' </div></div></div><div><div style="color:#606060;font-family:Helvetica,Arial,sans-serif;font-size:11px;line-height:150%; padding-right:20px;padding-bottom:5px;padding-left:20px;text-align:center">This email is sent to you, as you are a part of <span class="il">Settle</span>.</div><div style="background-color:rgb(51,51,51)!important;margin:0px auto;padding:10px 20px;min-height:50px;clear:both"><div style="width:70%;float:left;color:#666;padding-top:10px;font-size:12px">Mail Us @ <a target="_blank" href="mailto:info@settle.com" style="color:#666!important">hello@<span class="il">settle</span>.ind.in</a><span style="margin:0 10px">OR</span> <b>SMS</b>  to 00000</div><div style="float:right"><div style="overflow:hidden;padding-top:5px"><a target="_blank" href="https://www.facebook.com/arteventus/?fref=ts" style="color:#666;display:block;float:left;margin-left:15px"><img alt="facebook" src="'.base_url().'themes/frontend/images/social/fb.png" class="CToWUd"></a><a target="_blank" href="https://twitter.com/" style="color:#666;display:block;float:left;margin-left:8px"><img alt="tweet" src="'.base_url().'themes/frontend/images/social/tw.png" class="CToWUd"></a><a style="color:#666;display:block;float:left;margin-left:12px" href="https://www.pinterest.com"><img alt="pinterest" src="'.base_url().'themes/frontend/images/social/pinterest.png" class="CToWUd"></a></div></div></div></div><img height="1px" width="1px" src="" alt="" class="CToWUd"></div><div class="yj6qo"></div><div class="adL"></div></div></body></html>';
		$this->email->set_mailtype("html");
		$this->email->from('noreply@settle.ind.in', 'Settle');
		$this->email->to($emails);
		$this->email->subject($sub);
		$this->email->message($message);
		$this->email->send();
            
        return 1;
	}

	public function sendmessage($msg,$phone)
	{ 
		// $message_new 	= rawurlencode($msg);	
		// $message_new = html_entity_decode( $msg, ENT_QUOTES, "utf-8" );
		// $message = str_replace(" ","%20",$message_new);
		// $url = "http://bhashsms.com/api/sendmsg.php?user=prafullanathile&pass=Qaz!1234&sender=GLOBLF&phone=".$phone."&text=".$message."&priority=ndnd&stype=normal";
					// $ch = curl_init();
					// curl_setopt($ch, CURLOPT_URL, $url);
					// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					// curl_exec($ch);
					// $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					// curl_close($ch); 
		//$sms_sent=file_get_contents($url);

		return 1;
	}

/***************************************Constant Functions End***********************************/	

/*************************************User Login And Registration Start**************************/	

	public function isloggeduserIn()
    {
        $user_id = 0;
        $user_id = intval($this->session->userdata('user_id')); //Get value form session
        return $user_id;
    }

	public function check_emailid($id)
	{
		$result = $this->db->query("SELECT * FROM users WHERE is_deleted = 0 AND email_id = '".$id."'");
		return $result->result();
	}

	public function register_thehost()
	{
		$insert_id = 0;
		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$data = array(
			'unique_id' => $unique_id,
			'fname' => ucfirst($_POST['fname']),
			'lname' => ucfirst($_POST['lname']),
			'email_id' => $_POST['email_id'],
			'password' => $_POST['password'],
			'profile_image' => 'profile_pic.png', 
			'created_on' => $date );
		$insert_id = $this->db->Insert("users",$data); 

		//Sent email for verification
		$sub = 'Email Verification';
		$msg = 'Hello <b>'.ucfirst($_POST['fname']).'</b>,<br>
				You have just created an account on Settle.<br>
				Please click the link below to verify your email id<br>
				<a href="'.base_url().'home/email_verification/'.$unique_id.'" target="_blank">'.base_url().'home/email_verification/'.$unique_id.'</a><br>
				This step is required to confirm the email you entered is valid. We need the valid
				email address to contact if you forgot your password.<br>
				If you did not sign up for this account you can ignore this email.<br><br>
				<b>Thank You!!</b><br>
				<b>Team Settle!</b>';
		// $msg = 'Hello <b>'.ucfirst($_POST['fname']).'</b>,<br> You have just created account on Settle .<br>Please click the link below to verify your email id <br><a href="'.base_url().'home/email_verification/'.$unique_id.'" target="_blank">'.base_url().'home/email_verification/'.$unique_id.'</a><br>This step is required to confirm the email you entered is valid. We need the valid email address to contact if you forgot your password. Please read our privacy policy if you have any concerns<br><br>Thank You!!<br><b>Team Settle!</b>';			
		if($this->home_model->sendemail($_POST['email_id'],$sub,$msg)){
			return $insert_id;
		}
		else{
			return 0;
		}
		//End
	} 

	public function get_emailverifed($id)
	{
		$result =  $this->db->query("SELECT * FROM users WHERE unique_id = '".$id."'")->row_array();
		if(count($result) > 0)
		{
			$data = array(
				'is_idconfirm' => 1);
			$this->db->Where('unique_id',$id);
			$this->db->Update('users',$data);

			$data['user_id'] = $result['user_id'];
			$data['fname'] = $result['fname'];
			$data['email_id'] = $result['email_id'];
			$this->session->set_userdata($data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function login_thatuser()
	{
		$row = $this->db->query("SELECT * FROM users WHERE is_deleted = 0 AND email_id = '".$_POST['email_id']."' AND password = '".$_POST['password']."' AND is_idconfirm = 1")->row();
		//$row = $this->db->query("SELECT * FROM users WHERE email_id = '".$_POST['email_id']."' AND password = '".$_POST['password']."'")->row();
		if($row == true)
		{
			$data['user_id'] = $row->user_id;
			$data['fname'] = $row->fname;
			$data['email_id'] = $row->email_id;
			$data['is_deleted'] = $row->is_deleted;
			$this->session->set_userdata($data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function send_passwordbyemail()
	{
		$user = $this->db->query("SELECT * FROM users WHERE email_id = '".$_POST['email_id']."' AND is_idconfirm = 1")->row_array();
		if($user)
		{
			$sub = 'Forgot Password Message';
			$msg = 'Hello '.ucfirst($user['fname']).',<br>Someone(hopefully you) has request a password for Settle account.<br>Your account password is :&nbsp;&nbsp;'.$user['password'].'<br>Thank You!!<br>Team Settle!';			
			if($this->home_model->sendemail($user['email_id'],$sub,$msg))
				return 1;
			else
				return 0;
		}
	}

	public function logout()
	{ 
		$this->session->set_userdata('access_token','');
		$data = array('user_id' => '','fname' => '');
		$this->session->set_userdata($data);
		return 1;
	}

/**************************************User Login And Registration End**************************/

/********************************User Login And Registration By Social Sites********************/

	public function set_sociallogic($email_id)
	{
		$row = $this->db->query("SELECT * FROM users WHERE is_deleted = 0 AND email_id = '".$email_id."' AND is_idconfirm = 1")->row();
		if(count($row) == 1) //If present made it login
		{
			$data['user_id'] = $row->user_id;
			$data['fname'] = $row->fname;
			$this->session->set_userdata($data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function get_registerbysocial()
	{
		$insert_id = 0;
		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$pass=$this->randomPassword();
		$data = array(
			'unique_id' => $unique_id,
			'fname' => ucfirst($_POST['fname']),
			'lname' => ucfirst($_POST['lname']),
			'email_id' => $_POST['email_id'],
			'mobileno' => $_POST['mobile'],
			'profile_image' => 'profile_pic.png', 
			'password' => $pass, 
			'is_idconfirm' => 1,
			'created_on' => $date );
		$insert_id = $this->db->Insert("users",$data); 
		return $insert_id;

		//Sent email for verification
		// $sub = 'Email Verification Message';
		// $msg = 'Hello '.ucfirst($_POST['fname']).',<br> You have just created account on eventus .<br>Please click the link below to verify your email id <br><a href="'.base_url().'home/email_verification/'.$unique_id.'" target="_blank">'.base_url().'home/email_verification/'.$unique_id.'</a><br>This step is required to confirm the email you entered is valid. We need the valid email address to contact if you forgot your password. Please read our privacy policy if you have any concerns<br>Thank You!!<br>Team eventus!';			
		// if($this->home_model->sendemail($_POST['email_id'],$sub,$msg))
		// 	return $insert_id;
		// else
		// 	return 0;
		//End
	} 

/*****************************User Login And Registration By Social Sites End*******************/

/*****************************Change Password And Mobile Number Verification********************/

	public function change_changepwd($user_id, $password, $new_login_pwd)
	{
		$query = $this->db->get_where('users', array('user_id' => $user_id,'password' => $password))->result();
		$result = 0;
		if($this->db->affected_rows() == 1)
		{
			$this->db->where('user_id', $user_id);
			$this->db->update('users', array('password' => $new_login_pwd));
			$result = $this->db->affected_rows();
			$result = 1; 
		}
		return $result;
	}

	public function get_userdetials($id)
	{
		$result = $this->db->query("SELECT * FROM users WHERE user_id ='".$id."'");
		return $result->row_array();
	}

	// public function insert_otp($id)
	// {
	// 	$user_details = $this->get_userdetials($id);
	// 	if($user_details)
	// 	{
	// 		$mobile = $_POST['mobile'];
	// 		$countrycode = $_POST['countrycode'];
	// 		if($user_details['mobileno'] == '') //Check if number already present if not insert it
	// 		{
	// 			$number = array(
	// 				'mobileno' => $mobile);
	// 			$this->db->Where('user_id',$id);
	// 			$this->db->Update('users',$number);
	// 		}
	// 		$insert_id = 0;
	// 		$date = date('Y-m-d H:i:s');
	// 		$otp = $this->randomPassword(); //Generate random otp
	// 		$data = array(
	// 			'otp' => $otp, 
	// 			'otp_time' => $date, 
	// 			'con_code' => $countrycode );
	// 		$this->db->Where('user_id',$id);
	// 		$insert_id = $this->db->Update("users",$data); 
	// 		//var_dump($insert_id); die();
			
	// 		//Send otp to verify your mobile number 
	// 		$text = "".$user_details['fname']." : Please input this One-Time Password : ".$otp." to verify your mobile number.This OTP will be expired after 15 minutes";
	// 		$message_new 	= rawurlencode($text);	
	// 		$message_new = html_entity_decode( $text, ENT_QUOTES, "utf-8" );
	// 		$message = str_replace(" ","%20",$message_new);
			
	// 		if($this->sendmessage($message,$mobile))
	// 			return $insert_id;
	// 		else
	// 			return 0;
	// 		//End  
	// 	} 
	// }

	public function insert_otp($id,$unique_id='')
	{
		$user_details = $this->get_userdetials($id);
		if($user_details)
		{
			$mobile = $_POST['mobile'];
			$countrycode = $_POST['countrycode'];
			$places=$_POST['places'];
			//if($user_details['mobileno'] == '') //Check if number already present if not insert it
			//{
				$number = array(
					'mobileno' => $mobile);
				$this->db->Where('user_id',$id);
				$this->db->Update('users',$number);
			//}
			$insert_id = 0;
			$date = date('Y-m-d H:i:s');
			$otp = $this->randomPassword(); //Generate random otp
			if(isset($unique_id))
			{
				$data = array(
				'otp' => $otp, 
				'otp_time' => $date, 
				'con_code' => $countrycode,
				'country_id' => $places,
				'is_noconfirm' => 0
				);
			}
			else
			{
				$data = array(
				'otp' => $otp, 
				'otp_time' => $date, 
				'con_code' => $countrycode
				);
			}			
			$this->db->Where('user_id',$id);
			$insert_id = $this->db->Update("users",$data); 
			
			//Send otp to verify your mobile number 
			$text = $otp." is your One Time Password (OTP) to verify your Mobile Number. This OTP will be expired after 15 minutes";
			// $text = "".$user_details['fname']." : Please input this One-Time Password : ".$otp." to verify your mobile number.This OTP will be expired after 15 minutes";
			
			if($this->sendmessage($text,$mobile))
				return $insert_id;
			else
				return 0;
			//End  
		} 
	}

	public function resent_thatotp()
	{
		$user_id = $this->isloggeduserIn();
		$user_details = $this->get_userdetials($user_id);
		if($user_details)
		{
			//Check if otp is valid 
			$minutes_to_add = 15;
			$time = new DateTime($user_details['otp_time']);
			$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
			$stamp = $time->format('Y-m-d H:i:s'); 
			$current_time = date('Y-m-d H:i:s'); 

			if($stamp > $current_time)
			{
				$otp = $user_details['otp']; //Valid send old otp
			}
			else
			{
				$otp = $this->randomPassword(); //Invalid send new otp and save in database
				$data = array(
					'otp' => $otp, 
					'otp_time' => $date );
				$this->db->Where('user_id',$user_id);
				$this->db->Update("users",$data);
			}

			//Send otp to verify your mobile number 
			$text = $otp." is your One Time Password (OTP) to verify your Mobile Number. This OTP will be expired after 15 minutes";
			
			if($this->sendmessage($text,$user_details['mobileno']))
				return 1;
			else
				return 0;
			//End 
		} 
	}

	public function verified_thatnumber()
	{
		$user_id = $this->isloggeduserIn(); 
		$date = date('Y-m-d H:i:s'); //Get today date to check is it valid otp
		$user_details = $this->db->query("SELECT * FROM users WHERE otp ='".$_POST['otp']."' AND user_id = '".$user_id."' AND ('".$date."' < DATE_ADD(otp_time , INTERVAL 15 MINUTE))")->row_array();
		if($user_details)
		{
			$data = array(
				'is_noconfirm' => 1);
			$this->db->Where('user_id',$user_id);
			$this->db->Update('users',$data); 
			return 1;
		}
	} 

/***************************Change Password And Mobile Number Verification End******************/

/*****************************************User my account start*********************************/
	
	public function get_userinformation($user_id)
	{
		$result = $this->db->query("SELECT * FROM users WHERE user_id = '".$user_id."'");
		return $result->row_array();
	}

	public function update_userdetails($id)
	{ 
		$update_id = 0;
		$date = date('Y-m-d'); 
		if(!empty($_FILES['profile_pic']['name']))
        {
            $profile_pic = time().$_FILES['profile_pic']['name'];
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], "./uploads/profile_pic/$profile_pic");
        }
        else
        {
            $profile_pic = $this->input->post('previous_profileimage');
        }

        $phone = $this->db->query("SELECT mobileno,is_noconfirm FROM users WHERE unique_id = '".$id."'")->row_array();
        if($phone['mobileno'] == $_POST['mobileno']) //Check if mobile number is change
        	$status = $phone['is_noconfirm']; //Status remain same
        else
        	$status = 0; //Status change to zero

		$data = array( 
			'fname' => $_POST['fname'], 
			'lname' => $_POST['lsname'], 
			'mobileno' => $_POST['mobileno'], 
			'about_them' => $_POST['about_me'],
			'profile_image' => $profile_pic, 
			'address' => $_POST['address'],  
			'company_name' => $_POST['organization'], 
			'job_title' => $_POST['job_title'], 
			'business_phone' => $_POST['business_phone'], 
			'update_on' => $date,
			'is_noconfirm' => $status);
		$this->db->Where('unique_id',$id);
		$update_id = $this->db->Update('users',$data);
		return $update_id;
	} 

/***************************************User my account end**********************************/

/*******************************************Insert Space*************************************/

	public function location_getlist($parent_id , $location_type ) // location_type => 0 - Country, 1 - State, 2 - City by default it will return list of countries
	{
		$result = $this->db->query("SELECT *  FROM locations WHERE parent_id = ".$parent_id." AND location_type = ".$location_type." AND is_published = 1 ORDER BY location_name ");
		return $result->result();
	}

	public function fill_thespace()
	{
		$user_id = $this->isloggeduserIn();
		if(isset($_POST['amenities']))
			$amenities = implode(",",$_POST['amenities']);
		else
			$amenities = 0;

		if(isset($_POST['rules']))
			$rules = implode(",",$_POST['rules']);
		else
			$rules = 0;

		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$data = array(
			'unique_id' => $unique_id,
			'title' => $_POST['space_title'],
			'fname' => '',
			'lname' => '',
			'mobile' => $_POST['phone'],
			'venue_id' => $_POST['venue_id'],
			'subscription_id' => $_POST['subscription_id'],
			// 'min_hr' => $_POST['min_hr'],
			'accomodates' => $_POST['accommodate'], 
			'country' => $_POST['country'],
			'state' => $_POST['state'],
			'city' => $_POST['city'],
			'guest' => $_POST['guest'],
			'user_id' => $user_id,
			'address' => $_POST['address'],
			'lat' => $_POST['latitude'],
			'lon' => $_POST['longitude'],
			'landmark' => $_POST['landmark'],
			'zip_code' => $_POST['zip_code'],
			'description' => $_POST['description'],
			'price_type' => $_POST['price'],
			'base_price' => $_POST['base_price'],
			'discount' => $_POST['discount'],
			'amenities' => $amenities,
			'rules' => $rules,
			'from_time' => $_POST['from_time'],
			'to_time' => $_POST['to_time'],
			'update_date' => $date,
			'date' => $date);
		$this->db->Insert('space_details',$data);
		$insert_id = $this->db->insert_id();

		$data2 = array('is_completed' => 1);
		$this->db->Where('subscription_id',$_POST['subscription_id']);
		$update_id = $this->db->Update('space_subscription',$data2);


		for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
		{ 
			$banner_image = time().$_FILES['images']['name'][$i];
	        if(!empty($_FILES['images']['name'][$i]))
	        {
	            move_uploaded_file($_FILES['images']['tmp_name'][$i], "./uploads/space_image/$banner_image");
	        
			$data = array(
			 	'name' => $banner_image,
			 	'user_id' => $user_id,
			 	'space_id' => $insert_id,
			 	'unique_id' => $this->NewGuid()
			 	);
			$this->db->Insert('space_images',$data);
			}
		}
		$day = $_POST['days'];
		for ($j=0; $j <	count($day) ; $j++) 
		{  
			$data = array(
			 	'day_id' => $day[$j],
			 	'user_id' => $user_id,
			 	'space_id' => $insert_id,
			 	'unique_id' => $this->NewGuid()
			 	);
			$this->db->Insert('space_avaiable_on',$data);
		}
		$event = $_POST['event'];
		for ($j=0; $j <	count($event) ; $j++) 
		{  
			$data = array(
			 	'event_id' => $event[$j],
			 	'event_price' => $_POST['event_price'][$j],
			 	'user_id' => $user_id,
			 	'space_id' => $insert_id, 
			 	);
			$this->db->Insert('space_event',$data);
		}

		return $insert_id;
	}

	public function get_thatspace($id)
	{
		$result = $this->db->query("SELECT sd.*,us.*,sd.unique_id AS uni_id,sd.address AS my_add FROM space_details sd INNER JOIN users us ON sd.user_id = us.user_id WHERE sd.unique_id = '".$id."'");
		return $result->row_array();
	}

	public function get_spaceimage($id)
	{
		$result = $this->db->query("SELECT * FROM space_images WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function get_spacedays($id)
	{
		$result = $this->db->query("SELECT *,( CASE WHEN day_id = 1 THEN 'Mon' WHEN day_id = 2 THEN 'Tue' WHEN day_id = 3 THEN 'Wed' WHEN day_id = 4 THEN 'Thur' WHEN day_id = 5 THEN 'Fri' WHEN day_id = 6 THEN 'Sat' ELSE 'Sun' END) AS day FROM space_avaiable_on WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')")->result();
    	return $result;
	}

	public function get_thespacelist($start, $end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sd.*,si.name AS image_name,(SELECT AVG(stars) FROM space_review WHERE space_id = sd.space_id) as stars,(SELECT COUNT(*) FROM space_review WHERE space_id = sd.space_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd INNER JOIN space_images si ON sd.space_id = si.space_id WHERE sd.is_deleted = 0 AND sd.user_id = '".$user_id."' GROUP BY sd.space_id DESC LIMIT ".$start.",".$end."");
		return $result->result();
	}

	public function get_space_count()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT * FROM space_details WHERE user_id = '$user_id' AND is_deleted = 0 ");
		return $result->num_rows();
	}

	public function get_spaceevent($id)
	{
		$result = $this->db->query("SELECT se.*,em.* FROM event_master em INNER JOIN space_event se ON se.event_id = em.event_id WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function get_spacevenue($id)
	{
		$result = $this->db->query("SELECT * FROM venue_type WHERE venue_id IN (SELECT venue_id FROM space_details WHERE unique_id = '".$id."')");
    	return $result->row_array();
	}

	public function update_thespace($id)
	{
		$user_id = $this->isloggeduserIn();
		$space = $this->db->query("SELECT space_id FROM space_details WHERE unique_id = '".$id."'")->row_array();
		if(isset($_POST['amenities']))
			$amenities = implode(",",$_POST['amenities']);
		else
			$amenities = 0;

		if(isset($_POST['rules']))
			$rules = implode(",",$_POST['rules']);
		else
			$rules = 0;

		if($space)
		{
			$space_id = 0;
			$space_id = intval($space['space_id']);
			$this->db->query("DELETE FROM space_avaiable_on WHERE space_id = '".$space_id."'");
			//$this->db->query("DELETE FROM space_event WHERE space_id = '".$space_id."'"); 
			$date = date('Y-m-d'); 
			$data = array( 
				'title' => $_POST['space_title'],
				'fname' => $_POST['fname'],
				'lname' => $_POST['lname'],
				'mobile' => $_POST['phone'],
				'venue_id' => $_POST['venue_id'],
				//'min_hr' => $_POST['min_hr'],
				'accomodates' => $_POST['accommodate'], 
				'country' => $_POST['country'],
				'state' => $_POST['state'],
				'city' => $_POST['city'],
				'guest' => $_POST['guest'],
				'user_id' => $user_id,
				'address' => $_POST['address'],
				'lat' => $_POST['latitude'],
				'lon' => $_POST['longitude'],
				'landmark' => $_POST['landmark'],
				'zip_code' => $_POST['zip_code'],
				'description' => $_POST['description'],
				'price_type' => $_POST['price'],
				'base_price' => $_POST['base_price'],
				'discount' => $_POST['discount'],
				'amenities' => $amenities,
				'rules' => $rules,
				'from_time' => $_POST['from_time'],
				'to_time' => $_POST['to_time'],
				'status' => 0,
				'update_date' => $date
				);
			$this->db->Where('unique_id',$id);
			$insert_id = $this->db->Update('space_details',$data);  
			 
			$day = $_POST['days'];
			for ($j=0; $j <	count($day) ; $j++) 
			{  
				$data = array(
				 	'day_id' => $day[$j],
				 	'user_id' => $user_id,
				 	'space_id' => $space_id,
				 	'unique_id' => $this->NewGuid()
				 	);
				$this->db->Insert('space_avaiable_on',$data);
			}
			if (isset($_POST['space_event_id'])) {
				for ($l=0; $l <	count($_POST['space_event_id']) ; $l++) 
				{
					$data = array(
				 	'event_id' => $_POST['event_id'][$l],
				 	'event_price' => $_POST['event_price'][$l]
				 	);
				 	//$this->db->Insert('service_package_details',$data);
				 	$this->db->where('space_event_id',$_POST['space_event_id'][$l]);
        			$this->db->update('space_event',$data);
				}
			}
			return $insert_id;
		} 
	}

	public function get_spaceimages($id)
	{
		$result = $this->db->query("SELECT * FROM space_images WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function save_thespaceimages($id)
	{
		$user_id = $this->isloggeduserIn();
		$space = $this->db->query("SELECT space_id FROM space_details WHERE unique_id = '".$id."'")->row_array();
		if($space)
		{
			$space_id = 0;
			$space_id = intval($space['space_id']);
			for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
			{ 
				$banner_image = time().$_FILES['images']['name'][$i];
		        if(isset($_FILES['images']['name'][$i]))
		        {
		            move_uploaded_file($_FILES['images']['tmp_name'][$i], "./uploads/space_image/$banner_image");
		        }
				$data = array(
				 	'name' => $banner_image,
				 	'user_id' => $user_id,
				 	'space_id' => $space_id,
				 	'unique_id' => $this->NewGuid()
				 	);
				$this->db->Insert('space_images',$data);
			}
			return 1;
		} 
	}

	public function delete_thatspaceimage($id,$unique_id)
	{
		$space = $this->db->query("SELECT * FROM space_images WHERE space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$unique_id."')")->result();
		if(count($space) > 1)
		{
	        $result = $this->db->query("DELETE FROM space_images where unique_id = '".$id."'");
	        return $result;
	    }
	    else
	    {
	    	return -1;
	    }
	}

	public function delete_thatspace($id)
	{
		$update_id = 0;
		$data = array('is_deleted' => 1);
		$this->db->Where('unique_id',$id);
		$update_id = $this->db->update('space_details',$data);
		return $update_id;
	} 

	public function get_number($id)
	{
		$result = $this->db->query("SELECT * FROM users WHERE user_id ='".$id."'");
		return $result->row_array();
	} 

/****************************************Insert Space End************************************/

/***************************************Insert Service Start*********************************/

	public function list_ofservice()
	{
		$result = $this->db->query("SELECT * FROM service_master WHERE is_active = 1 AND is_deleted = 0");
		return $result->result();
	}

	public function fill_theservice()
	{
		$user_id = $this->isloggeduserIn();
		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$data = array(
			'unique_id' => $unique_id,
			'service_id' => $_POST['service_type'],
			'subscription_id' => $_POST['subscription_id'],
			//'min_hrs' => $_POST['min_hr'],
			'company_name' => $_POST['company'],
			'mobile' => $_POST['mobile'],
			'country' => $_POST['country'],
			'state' => $_POST['state'],
			'city' => $_POST['city'],
			'guest' => $_POST['guest'],
			'host_name' => $_POST['host_name'], 
			'user_id' => $user_id,
			'address' => $_POST['address'],
			'lat' => $_POST['latitude'],
			'lon' => $_POST['longitude'],
			'landmark' => $_POST['landmark'],
			'zip_code' => $_POST['zip_code'],
			'description' => $_POST['description'],
			'price_type' => $_POST['price'],
			'base_price' => $_POST['base_price'],
			'discount' => $_POST['discount'],
			'from_time' => $_POST['from_time'],
			'to_time' => $_POST['to_time'],
			'update_date' => $date,
			'date' => $date);
		$this->db->Insert('service_details',$data);
		$insert_id = $this->db->insert_id();

		$data2 = array('is_completed' => 1);
		$this->db->Where('subscription_id',$_POST['subscription_id']);
		$update_id = $this->db->Update('service_subscription',$data2);

		for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
		{ 
			$banner_image = time().$_FILES['images']['name'][$i];
	        if(!empty($_FILES['images']['name'][$i]))
	        {
	            move_uploaded_file($_FILES['images']['tmp_name'][$i], "./uploads/service_image/$banner_image");
	        
			$data = array(
			 	'name' => $banner_image,
			 	'user_id' => $user_id,
			 	'service_details_id' => $insert_id,
			 	'unique_id' => $this->NewGuid()
			 	);
			$this->db->Insert('service_images',$data);
			}
		}
		$day = $_POST['days'];
		for ($j=0; $j <	count($day) ; $j++) 
		{  
			$data = array(
			 	'day_id' => $day[$j],
			 	'user_id' => $user_id,
			 	'service_details_id' => $insert_id,
			 	'unique_id' => $this->NewGuid()
			 	);
			$this->db->Insert('service_avaiable_on',$data);
		} 
		if (isset($_POST['package_name'])) {
			for ($l=0; $l <	count($_POST['package_name']) ; $l++) 
			{
				$data = array(
			 	'user_id' => $user_id,
			 	'service_details_id' => $insert_id,
			 	'package_name' => $_POST['package_name'][$l],
			 	'package_description' => $_POST['package_description'][$l],
			 	'package_price' => $_POST['package_price'][$l],
			 	);
			 	$this->db->Insert('service_package_details',$data);
			}
		}
		return $insert_id;
	}

	public function get_thatservice($id)
	{
		$result = $this->db->query("SELECT sd.*,us.*,sd.unique_id AS uni_id,sd.company_name AS company,sd.address AS address,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS ser_name FROM service_details sd INNER JOIN users us ON sd.user_id = us.user_id WHERE sd.unique_id = '".$id."'");
		return $result->row_array();
	}

	public function get_thatservice_location($id){

		$result = $this->db->query("SELECT (SELECT location_name FROM locations lo INNER JOIN service_details sd ON lo.location_id = sd.country WHERE sd.unique_id = '$id') as country, (SELECT location_name FROM locations lo INNER JOIN service_details sd ON lo.location_id = sd.state WHERE sd.unique_id = '$id') as state, (SELECT location_name FROM locations lo INNER JOIN service_details sd ON lo.location_id = sd.city WHERE sd.unique_id = '$id') as city");
		return $result->row_array();

	}

	public function get_thatspace_location($id){

		$result = $this->db->query("SELECT (SELECT location_name FROM locations lo INNER JOIN space_details sd ON lo.location_id = sd.country WHERE sd.unique_id = '$id') as country, (SELECT location_name FROM locations lo INNER JOIN space_details sd ON lo.location_id = sd.state WHERE sd.unique_id = '$id') as state, (SELECT location_name FROM locations lo INNER JOIN space_details sd ON lo.location_id = sd.city WHERE sd.unique_id = '$id') as city");
		return $result->row_array();

	}

	public function get_service_package($id)
	{
		$result = $this->db->query("SELECT * FROM service_package_details WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function get_serviceimage($id)
	{
		$result = $this->db->query("SELECT * FROM service_images WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function get_servicedays($id)
	{
		$result = $this->db->query("SELECT *,( CASE WHEN day_id = 1 THEN 'Mon' WHEN day_id = 2 THEN 'Tue' WHEN day_id = 3 THEN 'Wed' WHEN day_id = 4 THEN 'Thur' WHEN day_id = 5 THEN 'Fri' WHEN day_id = 6 THEN 'Sat' ELSE 'Sun' END) AS day FROM service_avaiable_on WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')")->result();
    	return $result;
	}

	public function get_theservicelist($start,$end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sd.*,si.name AS image_name,(SELECT AVG(stars) FROM service_review WHERE service_id = sd.service_details_id) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN service_images si ON sd.service_details_id = si.service_details_id WHERE sd.is_deleted = 0 AND sd.user_id = '".$user_id."' GROUP BY sd.service_details_id DESC LIMIT ".$start.",".$end."");
		return $result->result();
	}
	public function count_theservicelist()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sd.*,si.name AS image_name,(SELECT AVG(stars) FROM service_review WHERE service_id = sd.service_details_id) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN service_images si ON sd.service_details_id = si.service_details_id WHERE sd.is_deleted = 0 AND sd.user_id = '".$user_id."' GROUP BY sd.service_details_id DESC");
		return $result->num_rows();
	}

	public function update_theservice($id)
	{
		$user_id = $this->isloggeduserIn();
		$service = $this->db->query("SELECT service_details_id FROM service_details WHERE unique_id = '".$id."'")->row_array();
		if($service)
		{
			$service_id = 0;
			$service_id = intval($service['service_details_id']);
			$this->db->query("DELETE FROM service_avaiable_on WHERE service_details_id = '".$service_id."'"); 
			// $this->db->query("DELETE FROM service_package_details WHERE service_details_id = '".$service_id."'"); 
			$date = date('Y-m-d'); 
			$data = array( 
				'company_name' => $_POST['company'],
				'host_name' => $_POST['host_name'], 
				'mobile' => $_POST['mobile'],
				//'min_hrs' => $_POST['min_hr'],
				'service_id' => $_POST['service_type'], 
				'country' => $_POST['country'],
				'state' => $_POST['state'],
				'city' => $_POST['city'],
				'guest' => $_POST['guest'], 
				'address' => $_POST['address'],
				'lat' => $_POST['latitude'],
				'lon' => $_POST['longitude'],
				'landmark' => $_POST['landmark'],
				'zip_code' => $_POST['zip_code'],
				'description' => $_POST['description'],
				'price_type' => $_POST['price'],
				'base_price' => $_POST['base_price'],
				'discount' => $_POST['discount'],
				'from_time' => $_POST['from_time'],
				'to_time' => $_POST['to_time'],
				'status' => 0,
				'update_date' => $date
				);
			$this->db->Where('unique_id',$id);
			$insert_id = $this->db->Update('service_details',$data);  
			 
			$day = $_POST['days'];
			for ($j=0; $j <	count($day) ; $j++) 
			{  
				$data = array(
				 	'day_id' => $day[$j],
				 	'user_id' => $user_id,
				 	'service_details_id' => $service_id,
				 	'unique_id' => $this->NewGuid()
				 	);
				$this->db->Insert('service_avaiable_on',$data);
			} 

			if (isset($_POST['package_name'])) {
				for ($l=0; $l <	count($_POST['package_name']) ; $l++) 
				{
					$data = array(
				 	'user_id' => $user_id,
				 	'service_details_id' => $service_id,
				 	'package_name' => $_POST['package_name'][$l],
				 	'package_description' => $_POST['package_description'][$l],
				 	'package_price' => $_POST['package_price'][$l]
				 	);
				 	//$this->db->Insert('service_package_details',$data);
				 	$this->db->where('package_id',$_POST['package_id'][$l]);
        			$this->db->update('service_package_details',$data);
				}
			}

			return $insert_id;
		} 
	}

	public function get_serviceimages($id)
	{
		$result = $this->db->query("SELECT * FROM service_images WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$id."')");
    	return $result->result();
	}

	public function save_theserviceimages($id)
	{
		$user_id = $this->isloggeduserIn();
		$service = $this->db->query("SELECT service_details_id FROM service_details WHERE unique_id = '".$id."'")->row_array();
		if($service)
		{
			$service_id = 0;
			$service_id = intval($service['service_details_id']);
			for ($i=0; $i <	count($_FILES['images']['name']) ; $i++) 
			{ 
				$banner_image = time().$_FILES['images']['name'][$i];
		        if(isset($_FILES['images']['name'][$i]))
		        {
		            move_uploaded_file($_FILES['images']['tmp_name'][$i], "./uploads/service_image/$banner_image");
		        }
				$data = array(
				 	'name' => $banner_image,
				 	'user_id' => $user_id,
				 	'service_details_id' => $service_id,
				 	'unique_id' => $this->NewGuid()
				 	);
				$this->db->Insert('service_images',$data);
			}
			return 1;
		} 
	}

	public function delete_thatserviceimage($id,$unique_id)
	{
		$space = $this->db->query("SELECT * FROM service_images WHERE service_details_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$unique_id."')")->result();
		if(count($space) > 1)
		{
	        $result = $this->db->query("DELETE FROM service_images where unique_id = '".$id."'");
	        return $result;
	    }
	    else
	    {
	    	return -1;
	    }
	}

	public function delete_thatservice($id)
	{
		$update_id = 0;
		$data = array('is_deleted' => 1);
		$this->db->Where('unique_id',$id);
		$update_id = $this->db->update('service_details',$data);
		return $update_id;
	} 

/***************************************Insert Service End***********************************/

/*********************************Venue And Its Searching Start******************************/ 

	public function get_alleventplaces()
	{
		$result = $this->db->query("SELECT * FROM event_location WHERE is_active = 1 AND is_deleted = 0");
		return $result->result();
	}

	public function get_allevents()
	{
		$result = $this->db->query("SELECT * FROM event_master WHERE is_active = 1 AND is_deleted = 0");
		return $result->result();
	}

	public function get_allvenue()
	{
		$result = $this->db->query("SELECT * FROM venue_type WHERE is_active = 1 AND is_deleted = 0");
		return $result->result();
	}

	public function get_allservices()
	{
		$result = $this->db->query("SELECT * FROM service_master WHERE is_active = 1 AND is_deleted = 0");
		return $result->result();
	}

	public function space_count($wh)
	{
		$result = $this->db->query("SELECT 1 FROM space_details sd LEFT JOIN space_event se ON sd.space_id = se.space_id LEFT JOIN space_avaiable_on sa ON sd.space_id = sa.space_id LEFT JOIN space_images si ON sd.space_id = si.space_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN space_booking sb ON sd.space_id = sb.space_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$wh." GROUP BY sd.space_id ")->result();
		return count($result);
	} 

	public function get_searchpage($start, $end, $wh)
	{
		$result = $this->db->query("SELECT sd.*,se.*,sa.*,si.*,us.*,sd.unique_id AS uni,sd.address AS my_add,AVG(sr.stars) as stars,(SELECT COUNT(*) FROM space_review WHERE space_id = sd.space_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT venue_name FROM venue_type WHERE venue_id = sd.venue_id) AS venue_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name FROM space_details sd LEFT JOIN space_event se ON sd.space_id = se.space_id LEFT JOIN space_avaiable_on sa ON sd.space_id = sa.space_id LEFT JOIN space_images si ON sd.space_id = si.space_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN space_review sr ON sr.space_id = sd.space_id LEFT JOIN space_booking sb ON sd.space_id = sb.space_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$wh." GROUP BY sd.space_id LIMIT ".$start.",".$end.""); 
		return $result->result();
	}

/*********************************Venue And Its Searching End*******************************/
	public function scenario_space($start, $end, $wh)
	{
		$result = $this->db->query("SELECT sd.*,se.*,sa.*,si.*,us.*,sd.unique_id AS uni,sd.address AS my_add,(SELECT AVG(stars) FROM space_review WHERE space_id = sd.space_id) as stars,(SELECT COUNT(*) FROM space_review WHERE space_id = sd.space_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT venue_name FROM venue_type WHERE venue_id = sd.venue_id) AS venue_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name FROM space_details sd LEFT JOIN space_event se ON sd.space_id = se.space_id LEFT JOIN space_avaiable_on sa ON sd.space_id = sa.space_id LEFT JOIN space_images si ON sd.space_id = si.space_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN space_booking sb ON sd.space_id = sb.space_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$wh." GROUP BY sd.space_id LIMIT 0,4"); 
		return $result->result();
	}

	public function scenario_service($services)
	{
		$result = $this->db->query("SELECT sd.*,sa.*,si.*,us.*,sd.unique_id AS uni,sd.address AS my_add,sd.company_name AS company,AVG(sr.stars) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name FROM service_details sd LEFT JOIN service_avaiable_on sa ON sd.service_details_id = sa.service_details_id LEFT JOIN service_images si ON sd.service_details_id = si.service_details_id LEFT JOIN service_review sr ON sr.service_id = sd.service_details_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN service_booking sb ON sb.service_id = sd.service_details_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$services." GROUP BY sd.service_details_id LIMIT 0,4"); 
		return $result->result();
	} 
/******************************Service And Its Searching Start******************************/

	public function servicelist_count($wh)
	{
		$result = $this->db->query("SELECT 1 FROM service_details sd LEFT JOIN service_avaiable_on sa ON sd.service_details_id = sa.service_details_id LEFT JOIN service_images si ON sd.service_details_id = si.service_details_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN service_booking sb ON sd.service_details_id = sb.service_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$wh." GROUP BY sd.service_details_id ")->result();
		return count($result);
	}

	public function get_searchservice($start, $end, $wh)
	{
		$result = $this->db->query("SELECT sd.*,sa.*,si.*,us.*,sd.unique_id AS uni,sd.address AS my_add,sd.company_name AS company,AVG(sr.stars) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT location_name FROM locations WHERE location_id = sd.state) AS state_name FROM service_details sd LEFT JOIN service_avaiable_on sa ON sd.service_details_id = sa.service_details_id LEFT JOIN service_images si ON sd.service_details_id = si.service_details_id LEFT JOIN service_review sr ON sr.service_id = sd.service_details_id LEFT JOIN users us ON us.user_id = sd.user_id LEFT JOIN service_booking sb ON sb.service_id = sd.service_details_id WHERE sd.is_deleted = 0 AND sd.status = 1 ".$wh." GROUP BY sd.service_details_id LIMIT ".$start.",".$end.""); 
		return $result->result();
	} 

/********************************Service And Its Searching End******************************/
/********************************Service And Its Searching End******************************/
	public function get_testimonialdata()
	{
		$result = $this->db->query("SELECT * FROM testimonial WHERE is_publised=1")->result();
		return $result;
	}

	public function locationlist()
	{
		$result = $this->db->query("SELECT *  FROM locations WHERE parent_id=0 ORDER BY location_name ");
		return $result->result();
	}


	public function add_favspace()
	{

		$fav_id= 0;
		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$data = array(
			'unique_id' => $unique_id,
			'space_id' => ucfirst($_POST['space_id']),
			'user_id' => ucfirst($_POST['user_id']), 
			'created_on' => $date );

		$fav_id = $this->db->Insert("fav_spaces",$data); 

		if ($fav_id) {
			return $fav_id;
		}else{
			return 0;
		}
		
	}

	public function delete_favspace()
	{

		$space_id = ucfirst($_POST['space_id']);
		$user_id = ucfirst($_POST['user_id']);
		$result = $this->db->query("DELETE FROM fav_spaces where space_id = '$space_id' AND user_id='$user_id'");

		if ($result) {
			return $result;
		}else{
			return 0;
		}
		
	}


	public function add_favservice()
	{

		$fav_id= 0;
		$date = date('Y-m-d');
		$unique_id = $this->NewGuid();
		$data = array(
			'unique_id' => $unique_id,
			'service_id' => ucfirst($_POST['service_id']),
			'user_id' => ucfirst($_POST['user_id']), 
			'created_on' => $date );

		$fav_id = $this->db->Insert("fav_services",$data); 

		if ($fav_id) {
			return $fav_id;
		}else{
			return 0;
		}
		
	}

	public function delete_favservice()
	{

		$service_id = ucfirst($_POST['service_id']);
		$user_id = ucfirst($_POST['user_id']);
		$result = $this->db->query("DELETE FROM fav_services where service_id = '$service_id' AND user_id='$user_id'");

		if ($result) {
			return $result;
		}else{
			return 0;
		}
		
	}

	public function get_favservicelist($start,$end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT fs.*,sd.*,si.name AS image_name,fs.service_id AS serv_id,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN service_images si ON sd.service_details_id = si.service_details_id INNER JOIN fav_services fs ON sd.service_details_id = fs.service_id WHERE sd.is_deleted = 0 AND fs.user_id = '".$user_id."' GROUP BY fs.service_id DESC LIMIT ".$start.",".$end."");

		return $result->result();
	}
	public function count_favservicelist()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT fs.*,sd.*,si.name AS image_name,fs.service_id AS serv_id,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN service_images si ON sd.service_details_id = si.service_details_id INNER JOIN fav_services fs ON sd.service_details_id = fs.service_id WHERE sd.is_deleted = 0 AND fs.user_id = '".$user_id."' GROUP BY fs.service_id DESC");

		return $result->num_rows();
	}
 	

	public function get_allservices_details()
	{	
		$result = $this->db->query("SELECT * FROM space_details WHERE is_deleted = 0 AND status = 1");
		return $result->result();
	}

 	
 	public function get_favspacelist($start , $end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT fs.*,sd.*,si.name AS image_name,fs.space_id AS spc_id,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT venue_name FROM venue_type WHERE venue_id = sd.venue_id) AS venue_name FROM space_details sd INNER JOIN space_images si ON sd.space_id = si.space_id INNER JOIN fav_spaces fs ON sd.space_id = fs.space_id WHERE sd.is_deleted = 0 AND fs.user_id = '".$user_id."' GROUP BY fs.space_id DESC LIMIT ".$start.",".$end."");

		return $result->result();
	}
	public function count_favspacelist()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT fs.*,sd.*,si.name AS image_name,fs.space_id AS spc_id,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd INNER JOIN space_images si ON sd.space_id = si.space_id INNER JOIN fav_spaces fs ON sd.space_id = fs.space_id WHERE sd.is_deleted = 0 AND fs.user_id = '".$user_id."' GROUP BY fs.space_id DESC");

		return $result->num_rows();
	}

	public function current_fav_service()
	{

		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT service_id FROM fav_services WHERE user_id='$user_id'")->result();

		return $result;
	}

	public function current_fav_space()
	{

		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT space_id FROM fav_spaces WHERE user_id='$user_id'")->result();

		return $result;
	}


	public function subscription_details()
	{

		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT * FROM `subscription_details`")->result();

		return $result;
	}

	public function get_timings()
	{

		$result = $this->db->query("SELECT * FROM `timings`")->result();

		return $result;
	}

	public function insert_booked_space()
	{
		$unique_id = $this->NewGuid();
		$user_id = $this->isloggeduserIn();
		$data = array(
			'unique_id' => $unique_id,
			'space_id' => $_POST['space_id'],
			'user_id' => $user_id,
			'event_id' => $_POST['event_id'],
			'guest_id' => $_POST['guest_id'],
			'startdate' => $_POST['startdate'],
			'enddate' => $_POST['enddate'],
			'start_time' => $_POST['start_time'],
			'end_time' => $_POST['end_time'],
			'is_paid' => 1, 
			'amount' => $_POST['amount'],
			'status' => 0,
			'is_reviewed' => 0
		);
		$this->db->Insert('space_booking',$data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	public function insert_booked_service()
	{
		$unique_id = $this->NewGuid();
		$user_id = $this->isloggeduserIn();
		$data = array(
			'unique_id' => $unique_id,
			'service_id' => $_POST['service_id'],
			'user_id' => $user_id,
			'package_id' => $_POST['package_id'],
			'guest_id' => $_POST['guest_id'],
			'startdate' => $_POST['startdate'],
			'enddate' => $_POST['enddate'],
			'start_time' => $_POST['start_time'],
			'end_time' => $_POST['end_time'],
			'is_paid' => 1, 
			'amount' => $_POST['amount'],
			'status' => 0,
			'is_reviewed' => 0
		);
		$this->db->Insert('service_booking',$data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	public function get_booked_space($id)
	{
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,em.event_name AS event_name,sb.status AS chk_status,sd.address AS address FROM space_booking sb INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN space_details sd ON sd.space_id = sb.space_id INNER JOIN event_master em ON sb.event_id = em.event_id WHERE sb.space_booking_id = '$id'");

		return $result->row_array();

	}

	public function get_booked_service($id)
	{
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,pd.*,sd.company_name as company,sb.status AS chk_status,sd.address AS address,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS service_name FROM service_booking sb INNER JOIN users us ON sb.user_id = us.user_id  INNER JOIN service_details sd ON sd.service_details_id = sb.service_id INNER JOIN service_package_details pd ON sb.package_id = pd.package_id WHERE sb.service_booking_id = '$id'");

		return $result->row_array();

	}
	// public function get_booked_service($id)
	// {
	// 	$result = $this->db->query("SELECT * FROM service_booking  WHERE service_booking_id = '$id'");

	// 	return $result->row_array();

	// }

	public function current_date_space($unique_id)
	{
		$date = date('m/d/Y');
		$result = $this->db->query("SELECT * FROM space_booking WHERE status = 1 AND startdate <= '".$date."' AND enddate >= '".$date."' AND space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$unique_id."')");

		return $result->result();

	}
	public function booked_date_space($unique_id)
	{
		$result = $this->db->query("SELECT * FROM space_booking WHERE status = 1 AND space_id IN (SELECT space_id FROM space_details WHERE unique_id = '".$unique_id."')");

		return $result->result();

	}

	public function current_date_service($unique_id)
	{
		$date = date('m/d/Y');
		$result = $this->db->query("SELECT * FROM service_booking WHERE status = 1 AND startdate <= '".$date."' AND enddate >= '".$date."' AND service_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$unique_id."')");

		return $result->result();

	}

	public function booked_date_service($unique_id)
	{
		$result = $this->db->query("SELECT * FROM service_booking WHERE status = 1 AND service_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '".$unique_id."')");

		return $result->result();

	}

	public function get_service_request($wh,$start,$end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company ,sd.unique_id as uni_id ,sb.status as chk_status ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_booking sb INNER JOIN service_details sd ON sb.service_id = sd.service_details_id INNER JOIN users us ON sb.user_id = us.user_id  WHERE sd.user_id = '$user_id' ".$wh." ORDER BY sb.service_booking_id DESC LIMIT ".$start.",".$end."");
		return $result->result();
	}
	public function count_service_request($wh)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company ,sd.unique_id as uni_id ,sb.status as chk_status ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_booking sb INNER JOIN service_details sd ON sb.service_id = sd.service_details_id INNER JOIN users us ON sb.user_id = us.user_id  WHERE sd.user_id = '$user_id' ".$wh." ORDER BY sb.service_booking_id DESC");
		return $result->num_rows();
	}

	public function get_space_request($wh,$start,$end)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.unique_id as uni_id ,sb.status as chk_status ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT event_name FROM event_master WHERE event_id = sb.event_id) AS event FROM space_booking sb INNER JOIN space_details sd ON sb.space_id = sd.space_id INNER JOIN users us ON sb.user_id = us.user_id  WHERE sd.user_id = '$user_id' ".$wh." ORDER BY sb.space_booking_id DESC LIMIT ".$start.",".$end."");
		return $result->result();
	}
	public function count_space_request($wh)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.unique_id as uni_id ,sb.status as chk_status ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT event_name FROM event_master WHERE event_id = sb.event_id) AS event FROM space_booking sb INNER JOIN space_details sd ON sb.space_id = sd.space_id INNER JOIN users us ON sb.user_id = us.user_id  WHERE sd.user_id = '$user_id' ".$wh." ORDER BY sb.space_booking_id DESC");
		return $result->num_rows();
	}

	public function get_booked_service_request()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,sr.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company ,sd.unique_id as uni_id ,sb.status as chk_status ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_booking sb INNER JOIN service_details sd ON sb.service_id = sd.service_details_id LEFT JOIN service_review sr ON sr.booking_id = sb.service_booking_id INNER JOIN users us ON sd.user_id = us.user_id  WHERE sb.user_id = '$user_id' ORDER BY sb.service_booking_id DESC");
		return $result->result();
	}

	public function get_booked_space_request()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,sr.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.unique_id as uni_id ,sb.status as chk_status ,sd.space_id as space_id ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT event_name FROM event_master WHERE event_id = sb.event_id) AS event FROM space_booking sb INNER JOIN space_details sd ON sb.space_id = sd.space_id LEFT JOIN space_review sr ON sr.booking_id = sb.space_booking_id INNER JOIN users us ON sd.user_id = us.user_id  WHERE sb.user_id = '$user_id' ORDER BY sb.space_booking_id DESC");
		return $result->result();
	}

	public function insert_service_review()
	{
		$user_id = $this->isloggeduserIn();
		$data = array(
			'user_id' => $user_id,
			'booking_id' => $_POST['id'],
			'service_id' => $_POST['service_id'],
			'stars' => $_POST['stars'],
			'review' => $_POST['review'] );
		$insert_id = $this->db->Insert("service_review",$data); 
	}

	public function insert_space_review()
	{
		$user_id = $this->isloggeduserIn();
		$data = array(
			'user_id' => $user_id,
			'booking_id' => $_POST['id'],
			'space_id' => $_POST['space_id'],
			'stars' => $_POST['stars'],
			'review' => $_POST['review'] );
		$insert_id = $this->db->Insert("space_review",$data); 
	}

	public function get_space_review($id)
	{
		$result = $this->db->query("SELECT sr.*,sb.*,us.*  FROM space_review sr INNER JOIN space_booking sb ON sr.booking_id = sb.space_booking_id INNER JOIN users us ON sr.user_id = us.user_id  WHERE sr.space_id IN (SELECT space_id FROM space_details WHERE unique_id = '$id') ORDER BY sr.review_id DESC");
		return $result->result();
	}
	public function get_service_review($id)
	{
		$result = $this->db->query("SELECT sr.*,sb.*,us.*  FROM service_review sr INNER JOIN service_booking sb ON sr.booking_id = sb.service_booking_id INNER JOIN users us ON sr.user_id = us.user_id  WHERE sr.service_id IN (SELECT service_details_id FROM service_details WHERE unique_id = '$id') ORDER BY sr.review_id DESC");
		return $result->result();
	}

	public function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = 'rzp_test_pT6MG4AYpzaPeI';
        $key_secret = 'OT5uH7r6IP8Kjuew1gOD7crr';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   

    public function update_space_document()
	{
		if (!empty($_FILES['id_proof']['name'])) {
			$id_proof = time().$_FILES['id_proof']['name'];
        	move_uploaded_file($_FILES['id_proof']['tmp_name'], "./uploads/space_documents/$id_proof");
        	$data = array(
					'id_proof' => $id_proof );			
			$this->db->where('space_id', $_POST['space_id'] );
			$insert_id = $this->db->Update("space_details",$data);
		}
		if (!empty($_FILES['space_proof']['name'])) {
			 $space_proof = time().$_FILES['space_proof']['name'];
       		 move_uploaded_file($_FILES['space_proof']['tmp_name'], "./uploads/space_documents/$space_proof");
        	$data = array( 
					'space_proof' => $space_proof );			
			$this->db->where('space_id', $_POST['space_id'] );
			$insert_id = $this->db->Update("space_details",$data);	
		}
		if (empty($_FILES['space_proof']['name']) && empty($_FILES['id_proof']['name'])) {
			$insert_id = $_POST['space_id'];
		}

		return $insert_id;
	}

	public function update_service_document()
	{
		if (!empty($_FILES['id_proof']['name'])) {
			$id_proof = time().$_FILES['id_proof']['name'];
        	move_uploaded_file($_FILES['id_proof']['tmp_name'], "./uploads/service_documents/$id_proof");
        	$data = array(
					'id_proof' => $id_proof );			
			$this->db->where('service_details_id', $_POST['service_id'] );
			$insert_id = $this->db->Update("service_details",$data);
		}
		if (!empty($_FILES['service_proof']['name'])) {
			  $service_proof = time().$_FILES['service_proof']['name'];
       	       move_uploaded_file($_FILES['service_proof']['tmp_name'], "./uploads/service_documents/$service_proof");
        	$data = array( 
					'service_proof' => $service_proof );			
			$this->db->where('service_details_id', $_POST['service_id'] );
			$insert_id = $this->db->Update("service_details",$data);	
		}
		if (empty($_FILES['service_proof']['name']) && empty($_FILES['id_proof']['name'])) {
			$insert_id = $_POST['service_id'];
		}

		return $insert_id;
	}

	public function get_space_document($id)
	{
		$result = $this->db->query("SELECT id_proof, space_proof FROM space_details WHERE space_id='$id' ");
		return $result->row_array();
	}

	public function get_service_document($id)
	{
		$result = $this->db->query("SELECT id_proof, service_proof FROM service_details WHERE service_details_id='$id' ");
		return $result->row_array();
	}



	public function add_cartspace()
	{

		$unique_id = $this->NewGuid();
		$user_id = $this->isloggeduserIn();
		$data = array(
			'unique_id' => $unique_id,
			'space_id' => $_POST['space_id'],
			'user_id' => $user_id,
			'event_id' => $_POST['event_id'],
			'guest_id' => $_POST['guest_id'],
			'startdate' => $_POST['startdate'],
			'enddate' => $_POST['enddate'],
			'start_time' => $_POST['start_time'],
			'end_time' => $_POST['end_time'],
			'amount' => $_POST['amount'],
			'status' => 1
		);
		$this->db->Insert('cart_spaces',$data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {
			return $insert_id;
		}else{
			return 0;
		}
		
	}

	public function delete_cartspace()
	{

		$space_id = ucfirst($_POST['space_id']);
		$user_id = ucfirst($_POST['user_id']);
		$result = $this->db->query("DELETE FROM fav_spaces where space_id = '$space_id' AND user_id='$user_id'");

		if ($result) {
			return $result;
		}else{
			return 0;
		}
		
	}


	public function add_cartservice()
	{

		$unique_id = $this->NewGuid();
		$user_id = $this->isloggeduserIn();
		$data = array(
			'unique_id' => $unique_id,
			'service_id' => $_POST['service_id'],
			'user_id' => $user_id,
			'package_id' => $_POST['package_id'],
			'guest_id' => $_POST['guest_id'],
			'startdate' => $_POST['startdate'],
			'enddate' => $_POST['enddate'],
			'start_time' => $_POST['start_time'],
			'end_time' => $_POST['end_time'],
			'amount' => $_POST['amount'],
			'status' => 1
		);
		$this->db->Insert('cart_services',$data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {
			return $insert_id;
		}else{
			return 0;
		}
		
	}

	public function delete_cartservice()
	{

		$service_id = ucfirst($_POST['service_id']);
		$user_id = ucfirst($_POST['user_id']);
		$result = $this->db->query("DELETE FROM fav_services where service_id = '$service_id' AND user_id='$user_id'");

		if ($result) {
			return $result;
		}else{
			return 0;
		}
		
	}

	public function current_cart_service()
	{

		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT service_id FROM cart_services WHERE user_id='$user_id' AND status = 1")->result();

		return $result;
	}

	public function current_cart_space()
	{

		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT DISTINCT space_id FROM cart_spaces WHERE user_id='$user_id' AND status = 1")->result();

		return $result;
	}

	public function get_cart_service()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT cs.*,sd.*,us.*,pd.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company,sd.address as address,sd.unique_id as uni_id ,(SELECT AVG(stars) FROM service_review WHERE service_id = sd.service_details_id) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN  cart_services cs ON cs.service_id = sd.service_details_id INNER JOIN users us ON us.user_id = sd.user_id INNER JOIN service_package_details pd ON cs.package_id = pd.package_id WHERE cs.status = 1 AND cs.user_id = '".$user_id."' ");

		return $result->result();
	}
 	
 	public function get_cart_space()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT cs.*,sd.*,us.*,em.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company,sd.address as address,sd.unique_id as uni_id ,(SELECT AVG(stars) FROM space_review WHERE space_id = sd.space_id) as stars,(SELECT COUNT(*) FROM space_review WHERE space_id = sd.space_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd INNER JOIN cart_spaces cs ON cs.space_id = sd.space_id INNER JOIN event_master em ON em.event_id = cs.event_id INNER JOIN users us ON us.user_id = sd.user_id WHERE cs.status = 1 AND cs.user_id = '".$user_id."' ");

		return $result->result();
	}

	public function insert_service_subscription()
	{	
		$start = date('d-m-Y');
		if($_POST['plan_id'] == 1){
			$end = date('d-m-Y', strtotime('+1 years'));
		}else{
			$end = date('d-m-Y', strtotime('+6 month'));
		}
		$user_id = $this->isloggeduserIn();
		$data = array(
			'service_id' => $_POST['service_id'],
			'user_id' => $user_id,
			'plan_id' => $_POST['plan_id'],
			'plan_type' => $_POST['plan_type'],
			'amount' => $_POST['amount'],
			'is_paid' => 1,
			'is_completed' => 0,
			'starts_on' => $start,
			'ends_on' => $end
		);
		$this->db->Insert('service_subscription',$data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {
			return $insert_id;
		}else{
			return 0;
		}
		
	}

	public function insert_space_subscription()
	{	
		$start = date('d-m-Y');
		if($_POST['plan_id'] == 1){
			$end = date('d-m-Y', strtotime('+1 years'));
		}else{
			$end = date('d-m-Y', strtotime('+6 month'));
		}
		$user_id = $this->isloggeduserIn();
		$data = array(
			'venue_id' => $_POST['venue_id'],
			'user_id' => $user_id,
			'plan_id' => $_POST['plan_id'],
			'plan_type' => $_POST['plan_type'],
			'amount' => $_POST['amount'],
			'is_paid' => 1,
			'is_completed' => 0,
			'starts_on' => $start,
			'ends_on' => $end
		);
		$this->db->Insert('space_subscription',$data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {
			return $insert_id;
		}else{
			return 0;
		}
		
	}

	public function get_subscribed_service()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,(SELECT name FROM service_images WHERE service_details_id = sd.service_details_id LIMIT 1) AS image_name,sd.company_name as company ,sd.unique_id as uni_id ,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_subscription ss INNER JOIN service_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON ss.user_id = us.user_id WHERE ss.user_id = '$user_id' ORDER BY ss.subscription_id DESC ");
		return $result->result();
	}

	public function get_subscribed_space()
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,(SELECT name FROM space_images WHERE space_id = sd.space_id LIMIT 1) AS image_name,sd.title as company ,sd.unique_id as uni_id ,sd.space_id as space_id ,(SELECT venue_name FROM venue_type WHERE venue_id = ss.venue_id) AS title,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_subscription ss INNER JOIN space_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON ss.user_id = us.user_id  WHERE ss.user_id = '$user_id' ORDER BY ss.subscription_id DESC");
		return $result->result();
	}

	public function get_indexspacelist()
	{
		$result = $this->db->query("SELECT sd.*,si.name AS image_name,(SELECT AVG(stars) FROM space_review WHERE space_id = sd.space_id) as stars,(SELECT COUNT(*) FROM space_review WHERE space_id = sd.space_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name FROM space_details sd INNER JOIN space_images si ON sd.space_id = si.space_id WHERE sd.is_deleted = 0 AND sd.status = 1 GROUP BY sd.space_id DESC LIMIT 0,3");
		return $result->result();
	}

	public function get_indexservicelist()
	{
		$result = $this->db->query("SELECT sd.*,si.name AS image_name,(SELECT AVG(stars) FROM service_review WHERE service_id = sd.service_details_id) as stars,(SELECT COUNT(*) FROM service_review WHERE service_id = sd.service_details_id) AS no_review,(SELECT location_name FROM locations WHERE location_id = sd.city) AS city_name,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS title FROM service_details sd INNER JOIN service_images si ON sd.service_details_id = si.service_details_id WHERE sd.is_deleted = 0 AND sd.status = 1 GROUP BY sd.service_details_id DESC LIMIT 0,3");
		return $result->result();
	}

	public function get_booked_space_host($id)
	{
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,em.event_name AS event_name,sb.status AS chk_status FROM space_booking sb INNER JOIN users us ON sb.user_id = us.user_id INNER JOIN space_details sd ON sd.space_id = sb.space_id INNER JOIN event_master em ON sb.event_id = em.event_id WHERE sb.space_booking_id = '$id'");

		return $result->row_array();

	}

	public function get_booked_service_host($id)
	{
		$result = $this->db->query("SELECT sb.*,sd.*,us.*,pd.*,sd.company_name as company,sb.status AS chk_status,(SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS service_name FROM service_booking sb INNER JOIN users us ON sb.user_id = us.user_id  INNER JOIN service_details sd ON sd.service_details_id = sb.service_id INNER JOIN service_package_details pd ON sb.package_id = pd.package_id WHERE sb.service_booking_id = '$id'");

		return $result->row_array();

	}

	public function space_subscription_email()
	{
		$user_id = $this->isloggeduserIn();
		if($_POST['plan_id'] == 1)
			$plan = 'Yearly Plan';
		else
			$plan = "Half Yearly Plan";

		$result =  $this->db->query("SELECT * FROM users WHERE user_id = '$user_id'")->row_array();
		$sub = "Space Subscription";	
		$msg = "Dear <b>".$result['fname']."</b>,<br>
				Thank you for subscribing our ".$plan." for your venue ".$_POST['venue_name']."<br>
				On dated ".date('d/m/Y')." with subscription amount ₹ ".$_POST['amount'].".<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";

		$text = "Thank you for subscribing our ".$plan." for your venue ".$_POST['venue_name']." on ".date('d/m/Y')." with subscription amount ₹ ".$_POST['amount'];
			
		$this->sendmessage($text,$result['mobileno']);
		// $msg = "Hi ".$result['fname'].",<br>Thank you for subscribing our ".$plan." for Venue type ".$_POST['venue_name']." on dated ".date('d/m/Y')." with subscription amount ₹ ".$_POST['amount'].".<br>I'm so happy that you've stuck around with us for this long period.<br>Thanks again for being such a fantastic customer!<br><br>Cheers,<br> Team Settle";
		$mail =$this->home_model->sendemail($result['email_id'],$sub,$msg);
		return $mail;
	}

	public function service_subscription_email()
	{
		$user_id = $this->isloggeduserIn();
		if($_POST['plan_id'] == 1)
			$plan = 'Yearly Plan';
		else
			$plan = "Half Yearly Plan";

		$result =  $this->db->query("SELECT * FROM users WHERE user_id = '$user_id'")->row_array();
		$sub = "Service Subscription";	
		$msg = "Dear <b>".$result['fname']."</b>,<br>
				Thank you for subscribing our ".$plan." for your service ".$_POST['service_name']."<br>
				On dated ".date('d/m/Y')." with subscription amount ₹ ".$_POST['amount'].".<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";

		$text = "Thank you for subscribing our ".$plan." for your service ".$_POST['service_name']." on ".date('d/m/Y')." with subscription amount ₹ ".$_POST['amount'];
		
			
		$this->sendmessage($text,$result['mobileno']);
		$mail =$this->home_model->sendemail($result['email_id'],$sub,$msg);
		return $mail;
	}

	public function booked_space_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$booked_space = $this->home_model->get_booked_space($id);
		if ($booked_space['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_space['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_space['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_space['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_space['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_space['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Space Booking Request";
		$msg = "Dear <b>".$name."</b>,<br>
				Thank you for your request, We are in process & will get back to you<br>
				<b>Your booking request details are as follows</b><br>
				Space Title: ".$booked_space['title']."<br>
				Hosted By: ".$space_detail['fname']." ".$space_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_space['startdate']))."<br>
				Event: ".$booked_space['event_name']."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_space['startdate']."<br>
				Event Start Time: ".$booked_space['start_time']."<br>
				Event End Date: ".$booked_space['enddate']."<br>
				Event End Time: ".$booked_space['end_time']."<br>
				Price: ₹".$booked_space['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$mail =$this->home_model->sendemail($email,$sub,$msg);

		$sub1 = "New Space Booking Request";
		$msg1 = "Dear <b>".$space_detail['fname']."</b>,<br>
				We are very happy to tell you that you have received new booking request for your space ".$booked_space['title']."<br>
				<b>Your booking request details are as follows</b><br>
				Space Title: ".$booked_space['title']."<br>
				Booked By: ".$booked_space['fname']." ".$booked_space['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_space['startdate']))."<br>
				Event: ".$booked_space['event_name']."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_space['startdate']."<br>
				Event Start Time: ".$booked_space['start_time']."<br>
				Event End Date: ".$booked_space['enddate']."<br>
				Event End Time: ".$booked_space['end_time']."<br>
				Price: ₹".$booked_space['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$mail1 =$this->home_model->sendemail($space_detail['email_id'],$sub1,$msg1);

		$text = "Thanks for your space booking request, booking details sent on your registered email id";
		$text2 = "You have received new booking request for your space ".$booked_space['title'].", booking request details sent on your registered email id";
		$this->sendmessage($text,$booked_space['mobileno']);
		$this->sendmessage($text2,$space_detail['mobileno']);

		return $mail;

	}

	public function booked_service_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$booked_service = $this->home_model->get_booked_service($id);
		if ($booked_service['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_service['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_service['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_service['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_service['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_service['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Service Booking Request";
		$msg = "Dear <b>".$name."</b>,<br>
				Thank you for your request, We are in process & will get back to you<br>
				<b>Your booking request details are as follows</b><br>
				Service Provider Name: ".$booked_service['company']."<br>
				Service Provider Type: ".$booked_service['service_name']."<br>
				Hosted By: ".$service_detail['fname']." ".$service_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_service['startdate']))."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_service['startdate']."<br>
				Event Start Time: ".$booked_service['start_time']."<br>
				Event End Date: ".$booked_service['enddate']."<br>
				Event End Time: ".$booked_service['end_time']."<br>
				Price: ₹".$booked_service['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$mail =$this->home_model->sendemail($email,$sub,$msg);

		$sub1 = "New Service Booking Request";
		$msg1 = "Dear <b>".$service_detail['fname']."</b>,<br>
				We are very happy to tell you that you have received new booking request for your service ".$booked_service['service_name']."<br>
				<b>Your booking request details are as follows</b><br>
				Service Provider Name: ".$booked_service['company']."<br>
				Service Provider Type: ".$booked_service['service_name']."<br>
				Booked By: ".$booked_service['fname']." ".$booked_service['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_service['startdate']))."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_service['startdate']."<br>
				Event Start Time: ".$booked_service['start_time']."<br>
				Event End Date: ".$booked_service['enddate']."<br>
				Event End Time: ".$booked_service['end_time']."<br>
				Price: ₹".$booked_service['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$mail1 =$this->home_model->sendemail($service_detail['email_id'],$sub1,$msg1);

		$text = "Thanks for your service booking request, booking details sent on your registered email id";
		$text2 = "You have received new booking request for your service ".$booked_service['service_name'].", booking request details sent on your registered email id";
		$this->sendmessage($text,$booked_space['mobileno']);
		$this->sendmessage($text2,$service_detail['mobileno']);

		return $mail;
	}

	public function confirm_space_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$booked_space = $this->home_model->get_booked_space($id);
		if ($booked_space['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_space['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_space['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_space['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_space['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_space['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Space Request Confirmed";
		$msg = "Dear <b>".$booked_space['fname']."</b>,<br>
				Your booking request for space ".$booked_space['title']." has been confirmed.<br>
				We look forward to seeing you soon.<br>
				<b>Your booking request details are as follows</b><br>
				Space Title: ".$booked_space['title']."<br>
				Hosted By: ".$space_detail['fname']." ".$space_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_space['startdate']))."<br>
				Event: ".$booked_space['event_name']."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_space['startdate']."<br>
				Event Start Time: ".$booked_space['start_time']."<br>
				Event End Date: ".$booked_space['enddate']."<br>
				Event End Time: ".$booked_space['end_time']."<br>
				Price: ₹".$booked_space['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for space ".$booked_space['title']." has been confirmed, booked details sent on your registered email id";
		$mail =$this->home_model->sendemail($booked_space['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_space['mobileno']);

		return $mail;
	}

	public function confirm_service_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$booked_service = $this->home_model->get_booked_service($id);
		if ($booked_service['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_service['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_service['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_service['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_service['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_service['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Service Request Confirmed";
		$msg = "Dear <b>".$booked_service['fname']."</b>,<br>
				Your booking request for service ".$booked_service['service_name']." has been confirmed. <br>
				We look forward to seeing you soon.<br>
				Your booking details:<br>
				<b>Your booking request details are as follows</b><br>
				Service Provider Name: ".$booked_service['company']."<br>
				Service Provider Type: ".$booked_service['service_name']."<br>
				Hosted By: ".$service_detail['fname']." ".$service_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_service['startdate']))."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_service['startdate']."<br>
				Event Start Time: ".$booked_service['start_time']."<br>
				Event End Date: ".$booked_service['enddate']."<br>
				Event End Time: ".$booked_service['end_time']."<br>
				Price: ₹".$booked_service['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for service ".$booked_service['service_name']." has been confirmed, booked details sent on your registered email id";		

		$mail =$this->home_model->sendemail($booked_service['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_service['mobileno']);
		return $mail;
	}

	public function cancel_space_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$booked_space = $this->home_model->get_booked_space($id);
		if ($booked_space['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_space['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_space['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_space['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_space['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_space['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Space Request Cancelled";
		$msg = "Sorry <b>".$booked_space['fname']."</b>,<br>
				We could not accommodate your booking request for space ".$booked_space['title'].".<br>
				We’re full or not open at the time you requested.<br>
				<b>Your booking request details are as follows</b><br>
				Space Title: ".$booked_space['title']."<br>
				Hosted By: ".$space_detail['fname']." ".$space_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_space['startdate']))."<br>
				Event: ".$booked_space['event_name']."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_space['startdate']."<br>
				Event Start Time: ".$booked_space['start_time']."<br>
				Event End Date: ".$booked_space['enddate']."<br>
				Event End Time: ".$booked_space['end_time']."<br>
				Price: ₹".$booked_space['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for space ".$booked_space['title']." has been cancelled, for more details please check your registered email id";
		$mail =$this->home_model->sendemail($booked_space['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_space['mobileno']);
		return $mail;
	}

	public function cancel_service_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$booked_service = $this->home_model->get_booked_service($id);
		if ($booked_service['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_service['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_service['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_service['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_service['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_service['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Your Service Request Cancelled";
		$msg = "Sorry <b>".$booked_service['fname']."</b>,<br>
				We could not accommodate your booking request for Service ".$booked_service['service_name'].". <br>
				We’re full or not open at the time you requested.<br>
				<b>Your booking request details are as follows</b><br>
				Service Provider Name: ".$booked_service['company']."<br>
				Service Provider Type: ".$booked_service['service_name']."<br>
				Hosted By: ".$service_detail['fname']." ".$service_detail['lname']."<br>
				Booked on: ".date("d F Y", strtotime($booked_service['startdate']))."<br>
				Number of Guest: ".$guest."<br>
				Event Start Date: ".$booked_service['startdate']."<br>
				Event Start Time: ".$booked_service['start_time']."<br>
				Event End Date: ".$booked_service['enddate']."<br>
				Event End Time: ".$booked_service['end_time']."<br>
				Price: ₹".$booked_service['amount']."<br><br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for service ".$booked_service['service_name']." has been cancelled, for more details please check your registered email id";	

		$mail =$this->home_model->sendemail($booked_service['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_service['mobileno']);
		return $mail;
	}

	public function complete_space_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$space_detail = $this->home_model->get_thatspace($unique_id);
		$booked_space = $this->home_model->get_booked_space($id);
		if ($booked_space['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_space['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_space['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_space['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_space['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_space['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Feedback";
		$msg = "Dear <b>".$booked_space['fname']."</b>,<br>
				Thanks, for choosing us recently, we pride ourselves in providing best possible<br>
				service for our customer, and so we’d like to hear your feedback.<br>
				Please, click on the below link for your valuable review<br>
				<a href='".base_url()."home/my_booking'>".base_url()."home/my_booking<a><br><br>
				We appreciate your time and we value your feedback<br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for space ".$booked_space['title']." has been completed, please check your email id and lets us know your feedback";
		$mail =$this->home_model->sendemail($booked_space['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_space['mobileno']);

		return $mail;
	}

	public function complete_service_email($unique_id,$id)
	{
		$name = $this->session->userdata('fname');
		$email = $this->session->userdata('email_id');
		$phone = $this->session->userdata('mobileno');
		$service_detail = $this->home_model->get_thatservice($unique_id);
		$booked_service = $this->home_model->get_booked_service($id);
		if ($booked_service['guest_id'] == 1) {
            $guest = "0-100 Guests";
        }elseif ($booked_service['guest_id'] == 2) {
            $guest = "100-200 Guests";
        }elseif ($booked_service['guest_id'] == 3) {
            $guest = "200-300 Guests";
        }elseif ($booked_service['guest_id'] == 4) {
            $guest = "300-400 Guests";
        }elseif ($booked_service['guest_id'] == 5) {
            $guest = "400-500 Guests";
        }elseif ($booked_service['guest_id'] == 6) {
            $guest = "500&Up Guests";
        }
		$sub = "Feedback";
		$msg = "Dear <b>".$booked_service['fname']."</b>,<br>
				Thanks, for choosing us recently, we pride ourselves in providing best possible<br>
				service for our customer, and so we’d like to hear your feedback.<br>
				Please, click on the below link for your valuable review<br>
				<a href='".base_url()."home/my_booking'>".base_url()."home/my_booking<a><br><br>
				We appreciate your time and we value your feedback<br>
				<b>Thank You!!<br>
				Team Settle!</b>";
		$text = "Your booking request for service ".$booked_service['service_name']." has been completed, please check your email id and 	  lets us know your feedback";		

		$mail =$this->home_model->sendemail($booked_service['email_id'],$sub,$msg);
		$this->sendmessage($text,$booked_service['mobileno']);
		return $mail;
	}

	public function get_thatsubscribed_space($unique_id)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,vt.venue_name AS venue_name,ss.is_paid AS chk_status FROM space_subscription ss INNER JOIN users us ON ss.user_id = us.user_id INNER JOIN space_details sd ON sd.subscription_id = ss.subscription_id INNER JOIN venue_type vt ON vt.venue_id = ss.venue_id WHERE sd.unique_id = '$unique_id' AND ss.user_id = '$user_id' ");

		return $result->row_array();

	}

	public function get_thatsubscribed_service($unique_id)
	{
		$user_id = $this->isloggeduserIn();
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,sd.company_name as company,ss.is_paid AS chk_status, (SELECT service_name FROM service_master WHERE service_id = sd.service_id) AS service_name FROM service_subscription ss INNER JOIN service_details sd ON sd.subscription_id = ss.subscription_id INNER JOIN users us ON sd.user_id = us.user_id WHERE sd.unique_id = '$unique_id' AND ss.user_id = '$user_id'");

		return $result->row_array();

	}

	public function space_renewal_record()
	{
		$date = date('d-m-Y', strtotime('+14 day'));
		$result = $this->db->query("SELECT ss.*,sd.*,us.* FROM space_subscription ss INNER JOIN space_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON ss.user_id = us.user_id  WHERE ss.ends_on = '$date' AND ss.is_completed = 1 ORDER BY ss.subscription_id DESC")->result();
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Your Space Subscription Expire Soon";
						$msg = "Dear <b>".$result[$i]->fname."</b>,<br>
								Hope everything is going well with you!!<br><br>
								We noticed that your subscription for space ".$result[$i]->title." is expiring in two weeks, 
								please renew before expiry.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = "Reminder: We noticed that your subscription for space ".$result[$i]->title." is expiring in two weeks, please renew before expiry";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobileno);
                    }
            }
	}

	public function service_renewal_record()
	{
		$date = date('d-m-Y', strtotime('+14 day'));
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,sd.company_name AS company FROM service_subscription ss INNER JOIN service_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON us.user_id = ss.user_id WHERE ss.ends_on = '$date' AND ss.is_completed = 1 ORDER BY ss.subscription_id DESC")->result();
		return $result;
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Your Service Subscription Expire Soon";
						$msg = "Dear <b>".$result[$i]->fname."</b>,<br>
								Hope everything is going well with you!!<br><br>
								We noticed that your subscription for service ".$result[$i]->company." is expiring in two weeks, 
								please renew before expiry.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = "Reminder: We noticed that your subscription for service ".$result[$i]->company." is expiring in two weeks, please renew before expiry";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobileno);
                    }
            }
	}

	public function space_expired_record()
	{
		$date = date('d-m-Y');
		$result = $this->db->query("SELECT ss.*,sd.*,us.* FROM space_subscription ss INNER JOIN space_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON ss.user_id = us.user_id  WHERE ss.ends_on = '$date' AND ss.is_completed = 1 AND ss.expired = 1 ORDER BY ss.subscription_id DESC")->result();
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Your Space Subscription Expired";
						$msg = "Dear <b>".$result[$i]->fname."</b>,<br>
								Your subscription for space ".$result[$i]->title." has been expired, please subscribe again.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = "Your subscription for space ".$result[$i]->title." has been expired, please subscribe again";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobileno);
                    }
            }
	}

	public function service_expired_record()
	{
		$date = date('d-m-Y');
		$result = $this->db->query("SELECT ss.*,sd.*,us.*,sd.company_name AS company FROM service_subscription ss INNER JOIN space_details sd ON ss.subscription_id = sd.subscription_id INNER JOIN users us ON ss.user_id = us.user_id  WHERE ss.ends_on = '$date' AND ss.is_completed = 1 AND ss.expired = 1 ORDER BY ss.subscription_id DESC")->result();
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Your Service Subscription Expired";
						$msg = "Dear <b>".$result[$i]->fname."</b>,<br>
								Your subscription for service ".$result[$i]->company." has been expired, please subscribe again.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = "Your subscription for service ".$result[$i]->company." has been expired, please subscribe again";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobileno);
                    }
            }
	}

	public function edit_space_email()
	{
		$result = $this->db->query("SELECT * FROM admin_user")->result();
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Vendor's Space Updation";
						$msg = "Dear <b>".$result[$i]->username."</b>,<br>
								".$_POST['space_title']." has been updated, please check out spacelist for space for activation.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = $_POST['space_title']." has been updated, please check out spacelist for space for activation";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobile);
                    }
            }
	}

	public function edit_service_email()
	{
		$result = $this->db->query("SELECT * FROM admin_user")->result();
		if($result)
            {
                for ($i=0; $i < count($result); $i++) 
                    {
                    	$sub = "Vendor's Service Updation";
						$msg = "Dear <b>".$result[$i]->username."</b>,<br>
								".$_POST['company']." has been updated, please check out servicelist for service for activation.<br><br>
								If you have any queries, please contact us on:<br>
				                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
				                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
				                Thank You!!<br>
				                Team Settle!";
						$text = $_POST['company']." has been updated, please check out servicelist for service for activation";		

						$mail =$this->home_model->sendemail($result[$i]->email_id,$sub,$msg);
						$this->sendmessage($text,$result[$i]->mobile);
                    }
            }
	}



}


