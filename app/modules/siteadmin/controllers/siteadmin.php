<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siteadmin extends CI_Controller {

	public function __construct() 
    {
        parent::__construct();
        $this->load->model('siteadmin/siteadmin_model');
        $this->load->model('home/home_model');
    }

    public function Checklogin() 
    {
        if ($this->session->userdata('admin_id') == '') 
        {
            redirect('siteadmin/');
        }
    }

	public function index()
    {
        if(isset($_POST['submit']))
        {
            if($this->siteadmin_model->checkLogin($this->input->post('username'), $this->input->post('password')))
            {
                //redirect('siteadmin/changepassword');
                redirect('siteadmin/dasboard');
            }
            else
            {
                $this->session->set_flashdata('message',"Invalid Credential. Please try again.");
                redirect('siteadmin');
            }
        }
        $data['include'] = 'siteadmin/login';
        $this->load->view('siteadmin/login',$data);
    }

    public function forgot_password()
    {
        $result = $this->db->query("SELECT * FROM admin_user WHERE username = '".$_POST['email']."' and is_deleted = 1");
        $result = $result->result();
        if(count($result) == 1)
        {           
            
            $sub = 'Your Earlyjoiner Password';
            $msg =  'Dear '.$result[0]->firstname.',<br> Thanks for contacting us.<br> Your one time password is: '.$result[0]->password.'<br>If you have not created this request please feel free to write to us or call us at +91-00<br>Thanks for being !!<br>Team Earlyjoiner!';         
            $message = '';
            $message = '<html><head><title>Settle</title></head><body><div style="overflow: hidden;" class="a3s" id=":16z"><div class="adM"></div><div><div class="adM"></div><div style="border-left: 1px solid #ddd;min-height: 52px;border-right: 1px solid #ddd;border-top: 1px solid #ddd;color: #666;margin: 0 auto;padding: 11px 0 10px 12px; background-color:#00aeaf;"><div class="adM"> </div><a target="_blank" href="'.base_url().'"><img style="border:0 none;color:#666;height:50px;width:140px; vertical-align:middle;" src="'.base_url().'themes/frontend/images/logo-1.png" alt="settle" class="CToWUd"></a>  </div><div style="border:1px solid #ddd;color:#666;margin:0 auto;padding:0 20px 20px"><div style="color:#666"><h4 style="font-family:arial!important"> </h4><div style="font-size:12px;line-height:20px;font-family:arial!important">'.$msg.' </div></div></div><div><div style="color:#606060;font-family:Helvetica,Arial,sans-serif;font-size:11px;line-height:150%; padding-right:20px;padding-bottom:5px;padding-left:20px;text-align:center">This email is sent to you, as you are a part of <span class="il">Settle</span>.</div><div style="background-color:rgb(51,51,51)!important;margin:0px auto;padding:10px 20px;min-height:50px;clear:both"><div style="width:70%;float:left;color:#666;padding-top:10px;font-size:12px">Mail Us @ <a target="_blank" href="mailto:info@settle.com" style="color:#666!important">info@<span class="il">settle</span>.ind.in</a><span style="margin:0 10px">OR</span> <b>SMS</b>  to 00000</div><div style="float:right"><div style="overflow:hidden;padding-top:5px"><a target="_blank" href="https://www.facebook.com/arteventus/?fref=ts" style="color:#666;display:block;float:left;margin-left:15px"><img alt="facebook" src="'.base_url().'themes/frontend/images/social/fb.png" class="CToWUd"></a><a target="_blank" href="https://twitter.com/" style="color:#666;display:block;float:left;margin-left:8px"><img alt="tweet" src="'.base_url().'themes/frontend/images/social/tw.png" class="CToWUd"></a><a style="color:#666;display:block;float:left;margin-left:12px" href="https://www.pinterest.com"><img alt="pinterest" src="'.base_url().'themes/frontend/images/social/pinterest.png" class="CToWUd"></a></div></div></div></div><img height="1px" width="1px" src="" alt="" class="CToWUd"></div><div class="yj6qo"></div><div class="adL"></div></div></body></html>';
            $check_email = $this->home_model->sendemail($email,$sub,$message);
            if($check_email > 0)
            {
                $this->session->set_flashdata('message',"Password has been sent to your email id.");
                redirect('siteadmin');
            }    
        }
        else
        {
             $this->session->set_flashdata('message',"Invalid Email Id. Please try again.");
             redirect('siteadmin');
        }
        return $refer_id;
    }

    public function isloggedIn()
    {
        $admin_id = 0;
        $admin_id = intval($this->session->userdata('admin_id'));
        return $admin_id;
    }


    public function logout()
    {
        $data = array('admin_id'=>'','admin_name'=>'','admin_email'=>'');
        $this->session->unset_userdata($data);
        $this->session->set_flashdata('message','You have successfully logged out'); 
        redirect('siteadmin/');
    }

    public function changepassword()
    {
        $this->Checklogin();
        if(isset($_POST['submit']))
        {

            $admin_id = $this->isloggedIn();
            $password = $_POST["oldpass"];
            $new_login_pwd = $_POST["newpass"];
            $confirm_pass = $_POST["conpass"];
            if($password != $new_login_pwd)
            {
                if($new_login_pwd == $confirm_pass)
                {
                    $result = $this->siteadmin_model->user_changepwd($admin_id, $password, $new_login_pwd);
                    if($result > 0)
                    {
                        $this->session->set_flashdata('success','Your login password change successfully.');              
                        redirect('siteadmin/changepassword');
                    }
                    else
                    {
                        $this->session->set_flashdata('success','Unable to change password, please enter valid password.');                
                        redirect('siteadmin/changepassword');
                    }
                }
                else
                {
                    $this->session->set_flashdata('success','Unable to change password, new password and confirm password did not match.');                
                    redirect('siteadmin/changepassword');
                }
            }
            else
            {
                $this->session->set_flashdata('success','Unable to change password, new password and old password are same.');                
                redirect('siteadmin/changepassword');
            }
        }
        $data['include'] = 'siteadmin/changepassword';
        $this->load->view('backend/container',$data);   
    }

    public function dasboard()
    {
        $this->Checklogin();
        $data['space_count'] = $this->siteadmin_model->space_count();
        $data['service_count'] = $this->siteadmin_model->service_count();
        $data['users'] = $this->siteadmin_model->users();
        $data['menu'] = 'dashboard';
        $data['include'] = 'siteadmin/dashboard';
        $this->load->view('backend/container',$data);
    }

    public function block_user()
    {
        if($_POST['type'] == 'block')
            $update_id = '1';
        else
            $update_id = '0';

        $data = array('is_deleted' => $update_id);
        $this->db->Where('user_id',$_POST['id']);
        $update_id = $this->db->update('users',$data);

        echo $_POST['id'];
    }

    public function edit_profile()
    {
        $this->Checklogin();
        $data['admin'] = $this->siteadmin_model->admin_details();
        $data['menu'] = 'edit';
        $data['include'] = 'siteadmin/edit_profile';
        $this->load->view('backend/container',$data);
    }

    public function update_profile()
    {
        $this->Checklogin();
        if(isset($_POST['update']))
        {
            $data = array(
                    'username' => $_POST['username'], 
                    'mobile' => $_POST['mobile'],
                    'email_id' => $_POST['email_id'],
                    'password' => $_POST['password'] );
            $this->db->where('user_id', $_POST['user_id']);
            $this->db->update('admin_user',$data);
            $result = $this->db->affected_rows();

            if($result){
                $this->session->set_flashdata('success','Profile successfully updated');                
                redirect('siteadmin/edit_profile');
            }else{
                $this->session->set_flashdata('error','Error in updating profile');                
                redirect('siteadmin/edit_profile');
            }
        }
    }

    public function create_profile()
    {
        $this->Checklogin();
        $data['admin'] = $this->siteadmin_model->admin();
        $data['menu'] = 'create';
        $data['include'] = 'siteadmin/create_profile';
        $this->load->view('backend/container',$data);
    }
    public function createmy_profile()
    {
        $this->Checklogin();
        if(isset($_POST['submit'])){
            $result = $this->siteadmin_model->create_admin();
            if($result){
                $this->session->set_flashdata('success','Profile Successfully Created');                
                redirect('siteadmin/create_profile');
            }else{
                $this->session->set_flashdata('error','Error in createing profile');                
                redirect('siteadmin/create_profile');
            }
        }
    }
    public function delete_admin()
    {
        $id=$_POST['id'];
        $this->db->query("DELETE FROM admin_user WHERE user_id = '$id'");
        echo $_POST['id'];
    }

    public function delete_user()
    {
       $id = $_POST['id'];
       $data = array(
                    'is_deleted' => 1 
                     );
        $this->db->where('user_id', $id);
        $result = $this->db->update('users',$data);
       //$result = $this->db->query("DELETE FROM users where user_id = '".$id."'");
       if ($result) {
           echo $id;
       }else{
        echo 0;
       }
       
    }

}