<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Timeslot extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('timeslot_model');
         $this->load->model('siteadmin/siteadmin_model');
    }

    public function Checklogin() 
    {
        if ($this->session->userdata('admin_id') == '') 
        {
            redirect('siteadmin/');
        }
    }

    public function isloggedIn()
    {
        $user_id = 0;
        $user_id = intval($this->session->userdata('admin_id'));
        return $user_id;
    }

    public function delete_location()
    {
       $id = $_POST['id'];
       $result = $this->db->query("DELETE FROM locations where location_id = '".$id."'");
       if ($result) {
           echo $id;
       }else{
        echo 0;
       }
       
    }

    public function add_country($id = '')
    {
        $this->Checklogin();
        $data['location'] = $this->timeslot_model->getcountry();
        if($id > 0 ){
            $data['mylocation'] = $this->timeslot_model->location_id($id);
        }
        $data['menu'] = 'country'; 
        $data['include'] = 'siteadmin/timeslot/add_country';
        $this->load->view('backend/container',$data);
    }

    public function addd_country($id = '')
    {

        if(isset($_POST['commit']))
            {
                if($id > 0){
                    $insert_id = $this->timeslot_model->update_location($id);
                }else{
                    $insert_id = $this->timeslot_model->insert_country();
              }
              redirect('siteadmin/timeslot/add_country');
            }else{
                redirect('siteadmin/timeslot/add_country');
            }

        
    }

    public function add_state($id = '')
    {
        $this->Checklogin();
        $data['location'] = $this->timeslot_model->getstate();
        if($id > 0 ){
            $data['mylocation'] = $this->timeslot_model->location_id($id);
        }
        $data['menu'] = 'state'; 
        $data['include'] = 'siteadmin/timeslot/add_state';
        $this->load->view('backend/container',$data);
    }

    public function addd_state($id = '')
    {

        if(isset($_POST['commit']))
            {
                if($id > 0){
                    $insert_id = $this->timeslot_model->update_location($id);
                }else{
                    $insert_id = $this->timeslot_model->insert_state();
              }
              redirect('siteadmin/timeslot/add_state');
            }else{
                redirect('siteadmin/timeslot/add_state');
            }

        
    }

    public function add_city($id = '')
    {
        $this->Checklogin();
        $data['location'] = $this->timeslot_model->getcity();
        $data['state'] = $this->timeslot_model->getstate();
        if($id > 0 ){
            $data['mylocation'] = $this->timeslot_model->location_id($id);
        }
        $data['menu'] = 'city'; 
        $data['include'] = 'siteadmin/timeslot/add_city';
        $this->load->view('backend/container',$data);
    }

    public function addd_city($id = '')
    {

        if(isset($_POST['commit']))
            {
                if($id > 0){
                    $insert_id = $this->timeslot_model->update_location($id);
                }else{
                    $insert_id = $this->timeslot_model->insert_city();
              }
              redirect('siteadmin/timeslot/add_city');
            }else{
                redirect('siteadmin/timeslot/add_city');
            }

        
    }
   
}
