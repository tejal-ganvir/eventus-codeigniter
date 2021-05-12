<?php
class space extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $functionName = $this->router->fetch_method();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        $this->load->helper('date');
        $this->load->model('space_model');
        $this->load->library('pagination');
        $this->load->model('siteadmin/siteadmin_model');
    }

    public function Checklogin() 
    {
        if ($this->session->userdata('admin_id') == '') 
        {
            redirect('siteadmin/');
        }
    }

    /*************************************Space start***********************************/

    public function space_list()
    {
        $this->Checklogin();$data["selected_menu"] = "space";

        // $config = array();
        // $config["base_url"] = base_url() . "siteadmin/space/space_list";
        // $config["total_rows"] = $this->space_model->space_count();
        // $config["per_page"] = 20;
        // $config["uri_segment"] = 4;
        // $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        // $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        // $config['cur_tag_close'] = "</b></a></li>";

        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $result = $this->space_model->get_allspaces($page, $config["per_page"]);
        $result = $this->space_model->get_allspaces();
        //$data["links"] = $this->pagination->create_links();
        //$data["page_sr"] = $page + 1;
        $data['space_list'] = $result;
        $data['menu'] = 'spacelist';
        $data['include'] = 'siteadmin/space/space_list';
        $this->load->view('backend/container',$data);
    }

    public function space_details($unique_id = '')
    {
        $this->Checklogin();
        $space_details = $this->space_model->get_space($unique_id);
        $space_event = $this->space_model->get_spaceevent($unique_id); //Get events of that space
        $data['events'] = $this->space_model->get_allevents(); //Get events
        $data['space_event'] = $space_event;
        $data['space_details'] = $space_details;
        $data['menu'] = 'spacelist';
        $data['include'] = 'siteadmin/space/space_details';
        $this->load->view('backend/container',$data);
    }

    public function delete_space($media_id) 
    {
        if ($this->space_model->delete_thatspace($media_id)) 
        {
            $this->session->set_flashdata('success', 'Space has been deleted successfully.');
            redirect('siteadmin/space/space_list');
        }
    }

    public function space_activate($media_id) 
    {
        $this->space_model->activatespace($media_id);
        $result =  $this->db->query("SELECT sd.*,us.* FROM space_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '$media_id'")->row_array();
        $sub = "Space Activation";   
        $msg = "Dear <b>".$result['fname']."</b>,<br>
                Your Space ".$result['title']." has been <b>activated</b>
                successfully.<br>
                Now, it’s available for booking.<br>
                If you have any queries, please contact us on:<br>
                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
                Thank You!!<br>
                <b>Team Settle!</b>";
        $text = "Your space ".$result['title']." has been activated successfully, if you have any query please call us on our toll-free no. +91 1234567890";
        
        $mail =$this->siteadmin_model->sendemail($result['email_id'],$sub,$msg);
        $this->siteadmin_model->sendmessage($text,$result['mobileno']);

        $this->session->set_flashdata('success', 'Space has been activated successfully');
        redirect('siteadmin/space/space_list');
    }
    
    public function space_deactiviate($media_id) 
    {
        $this->space_model->deactivatespace($media_id);
        $result =  $this->db->query("SELECT sd.*,us.* FROM space_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '$media_id'")->row_array();
        $sub = "Space Deactivation";   
        $msg = "Dear <b>".$result['fname']."</b>,<br>
                Your Space ".$result['title']." has been <b>deactivated</b>.<br>
                If you have any queries, please contact us on:<br>
                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
                Thank You!!<br>
                <b>Team Settle!</b>";
        $text = "Your space ".$result['title']." has been deactivated, if you have any query please call us on our toll-free no. 1234567890";
        
        $mail =$this->siteadmin_model->sendemail($result['email_id'],$sub,$msg);
        $this->siteadmin_model->sendmessage($text,$result['mobileno']);
        $this->session->set_flashdata('success', 'Space has been deactivated successfully');
        redirect('siteadmin/space/space_list');
    }

    public function booked_space_list()
    {
        $this->Checklogin();

        // $config = array();
        // $config["base_url"] = base_url() . "siteadmin/space/booked_space_list";
        // $config["total_rows"] = $this->space_model->booked_space_count();
        // $config["per_page"] = 20;
        // $config["uri_segment"] = 4;
        // $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        // $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        // $config['cur_tag_close'] = "</b></a></li>";

        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $result = $this->space_model->get_all_booked_space($page, $config["per_page"]);
        $result = $this->space_model->get_all_booked_space();
        //$data["links"] = $this->pagination->create_links();
        //$data["page_sr"] = $page + 1;
        $data['space_list'] = $result;
        $data['menu'] = 'bookedspace';
        $data['include'] = 'siteadmin/space/booked_space_list';
        $this->load->view('backend/container',$data);
    }

    public function view_booked_space($unique_id,$id = 0)
    {
        $this->Checklogin();
        $space_details = $this->space_model->get_space($unique_id);
        $space_image = $this->space_model->get_spaceimage($unique_id);
        $data['booked_space'] = $this->space_model->get_booked_space($id); //Get events
        $data['space_details'] = $space_details;
        $data['space_image'] = $space_image;
        $data['menu'] = 'bookedspace';
        $data['include'] = 'siteadmin/space/view_booked_space';
        $this->load->view('backend/container',$data);
    }
}