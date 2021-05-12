<?php
class siteadmin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
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

    public function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    public function checkLogin($user, $pass)
    {
        $query = $this->db->get_where('admin_user', array('username' => $user, 'password' => $pass, 'is_active' => 1));
        $query = $query->result();
        if(count($query) == 1)
        {
            $row = $query[0];
            $data = array('admin_id' => $row->user_id, 'admin_name' => $row->firstname, 'admin_email' => $row->email,'admin_parent' => $row->parent_id);
            $this->session->set_flashdata('message','You have successfully logged in'); 
            $this->session->set_userdata($data);
            
            return TRUE;           
        }
        else
        {
            return FALSE;
        }
    }

    public function isloggedIn()
    {
        $admin_id = 0;
        $admin_id = intval($this->session->userdata('admin_id'));
        return $admin_id;
    }

    public function isloggedRedirect()
    {
        $admin_id = 0;
        $admin_id = intval($this->session->userdata('admin_id'));
        if($admin_id <= 0)
        {
            redirect('siteadmin');
        }
        return $admin_id;
    }

    public function user_changepwd($admin_id, $password, $new_login_pwd)
    {
        $admin_id = $this->isloggedIn();
        $query = $this->db->get_where('admin_user', array('user_id' => $admin_id,'password' => $password))->result();
        $result = 0;
        if($this->db->affected_rows() == 1)
        {
            $this->db->where('user_id', $admin_id);
            $this->db->update('admin_user', array('password' => $new_login_pwd));
            $result = $this->db->affected_rows();
            $result = 1;
        }
        return $result;
    } 

    public function space_count()
    {
        $result =  $this->db->query("SELECT * FROM space_details ");
        return $result->num_rows();
    }
    public function service_count()
    {
        $result =  $this->db->query("SELECT * FROM service_details ");
        return $result->num_rows();
    }
    public function users()
    {
        $result =  $this->db->query("SELECT * FROM users where is_deleted = 0");
        return $result->result();
    }
     
    public function admin_details()
    {
        $admin_id = $this->isloggedIn();
        $result =  $this->db->query("SELECT * FROM admin_user WHERE user_id='$admin_id' ");
        return $result->row_array();
    }
    public function admin()
    {
        $admin_id = $this->isloggedIn();
        $result =  $this->db->query("SELECT * FROM admin_user ");
        return $result->result();
    }
    public function create_admin()
    {
        $data = array(
                    'firstname' => $_POST['firstname'], 
                    'username' => $_POST['username'], 
                    'role' => $_POST['role'],
                    'password' => $_POST['password'] );
        $insert_id = $this->db->Insert('admin_user',$data);
        return $insert_id;
    }

    public function sendemail($emails,$sub,$msg)
    {
        $message = '';
        $message = '<html><head><title>Settle</title></head><body><div style="overflow: hidden;" class="a3s" id=":16z"><div class="adM"></div><div><div class="adM"></div><div style="border-left: 1px solid #ddd;min-height: 52px;border-right: 1px solid #ddd;border-top: 1px solid #ddd;color: #666;margin: 0 auto;padding: 11px 0 10px 12px; background-color:#00aeaf;"><div class="adM"> </div><a target="_blank" href="'.base_url().'"><img style="border:0 none;color:#666;height:50px;width:140px; vertical-align:middle;" src="'.base_url().'themes/frontend/images/logo-1.png" alt="Settle" class="CToWUd"></a>  </div><div style="border:1px solid #ddd;color:#666;margin:0 auto;padding:0 20px 20px"><div style="color:#666"><h4 style="font-family:arial!important"> </h4><div style="font-size:12px;line-height:20px;font-family:arial!important">'.$msg.' </div></div></div><div><div style="color:#606060;font-family:Helvetica,Arial,sans-serif;font-size:11px;line-height:150%; padding-right:20px;padding-bottom:5px;padding-left:20px;text-align:center">This email is sent to you, as you are a part of <span class="il">Settle</span>.</div><div style="background-color:rgb(51,51,51)!important;margin:0px auto;padding:10px 20px;min-height:50px;clear:both"><div style="width:70%;float:left;color:#666;padding-top:10px;font-size:12px">Mail Us @ <a target="_blank" href="mailto:hello@settle.ind.in" style="color:#666!important">hello@<span class="il">settle</span>.ind.in</a><span style="margin:0 10px">OR</span> <b>SMS</b>  to 00000</div><div style="float:right"><div style="overflow:hidden;padding-top:5px"><a target="_blank" href="https://www.facebook.com/arteventus/?fref=ts" style="color:#666;display:block;float:left;margin-left:15px"><img alt="facebook" src="'.base_url().'themes/frontend/images/social/fb.png" class="CToWUd"></a><a target="_blank" href="https://twitter.com/" style="color:#666;display:block;float:left;margin-left:8px"><img alt="tweet" src="'.base_url().'themes/frontend/images/social/tw.png" class="CToWUd"></a><a style="color:#666;display:block;float:left;margin-left:12px" href="https://www.pinterest.com"><img alt="pinterest" src="'.base_url().'themes/frontend/images/social/pinterest.png" class="CToWUd"></a></div></div></div></div><img height="1px" width="1px" src="" alt="" class="CToWUd"></div><div class="yj6qo"></div><div class="adL"></div></div></body></html>';
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
        $message_new    = rawurlencode($msg);  
        $message_new    = urlencode($message_new);   
        $message_new = html_entity_decode( $msg, ENT_QUOTES, "utf-8" );
        $message = str_replace(" ","%20",$message_new);
        $url = "http://bhashsms.com/api/sendmsg.php?user=prafullanathile&pass=Qaz!1234&sender=GLOBLF&phone=".$phone."&text=".$message."&priority=ndnd&stype=normal";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_exec($ch);
        // $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // curl_close($ch); 
        $sms_sent=file_get_contents($url);

        return 1;
    }

}
