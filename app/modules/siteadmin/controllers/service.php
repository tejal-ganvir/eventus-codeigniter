<?php
class service extends CI_Controller
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
        $this->load->model('service_model');
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

    public function service_list()
    {
        $this->Checklogin();$data["selected_menu"] = "service";

        // $config = array();
        // $config["base_url"] = base_url() . "siteadmin/service/service_list";
        // $config["total_rows"] = $this->service_model->service_count();
        // $config["per_page"] = 20;
        // $config["uri_segment"] = 4;
        // $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        // $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        // $config['cur_tag_close'] = "</b></a></li>";

        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $result = $this->service_model->get_allservices($page, $config["per_page"]);
        $result = $this->service_model->get_allservices();
        
        // $data["links"] = $this->pagination->create_links();
        // $data["page_sr"] = $page + 1;
        $data['service_list'] = $result;
        $data['menu'] = 'servicelist';
        $data['include'] = 'siteadmin/service/service_list';
        $this->load->view('backend/container',$data);
    }

    public function booked_service_list()
    {
        $this->Checklogin();$data["selected_menu"] = "bookedservice";

        // $config = array();
        // $config["base_url"] = base_url() . "siteadmin/service/bookedservice";
        // $config["total_rows"] = $this->service_model->booked_service_count();
        // $config["per_page"] = 20;
        // $config["uri_segment"] = 4;
        // $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        // $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = "<li class=\"active\"><a><b>";
        // $config['cur_tag_close'] = "</b></a></li>";

        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $result = $this->service_model->get_all_booked_services($page, $config["per_page"]);
        
        // $data["links"] = $this->pagination->create_links();
        // $data["page_sr"] = $page + 1;
        $result = $this->service_model->get_all_booked_services();
        $data['service_list'] = $result;
        $data['menu'] = 'bookedservice';
        $data['include'] = 'siteadmin/service/booked_service_list';
        $this->load->view('backend/container',$data);
    }

    public function service_details($unique_id = '')
    {
        $service_details = $this->service_model->get_service($unique_id);
        $service_package = $this->service_model->get_service_package($unique_id);
        $data['service_details'] = $service_details;
        $data['service_package'] = $service_package;
        $data['menu'] = 'servicelist';
        $data['include'] = 'siteadmin/service/service_details';
        $this->load->view('backend/container',$data);
    }

    public function delete_service($media_id) 
    {
        if ($this->service_model->delete_thatservice($media_id)) 
        {
            $this->session->set_flashdata('success', 'Service has been deleted successfully.');
            redirect('siteadmin/service/service_list');
        }
    }

    public function service_activate($media_id) 
    {
        $this->service_model->activateservice($media_id);
        $result =  $this->db->query("SELECT sd.*,us.*,sd.company_name as company FROM service_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '$media_id'")->row_array();
        $sub = "Service Activation";   
        $msg = "Dear <b>".$result['fname']."</b>,<br>
                Your Service ".$result['company']." has been <b>activated</b>
                successfully.<br>
                Now, it’s available for booking.<br>
                If you have any queries, please contact us on:<br>
                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
                Thank You!!<br>
                <b>Team Settle!</b>";
        $text = "Your Service ".$result['company']." has been activated successfully, if you have any query please call us on our toll-free no. 1234567890";
        $mail =$this->siteadmin_model->sendemail($result['email_id'],$sub,$msg);
        $this->siteadmin_model->sendmessage($text,$result['mobileno']);
        $this->session->set_flashdata('success', 'Service has been activated successfully');
        redirect('siteadmin/service/service_list');
    }
    
    public function service_deactiviate($media_id) 
    {
        $this->service_model->deactivateservice($media_id);
        $result =  $this->db->query("SELECT sd.*,us.*,sd.company_name as company FROM service_details sd LEFT JOIN users us ON us.user_id = sd.user_id WHERE sd.unique_id = '$media_id'")->row_array();
        $sub = "Service Deactivation";   
        $msg = "Dear <b>".$result['fname']."</b>,<br>
                Your Service ".$result['company']." has been <b>deactivated</b>.<br>
                If you have any queries, please contact us on:<br>
                Toll free no. <a href='tel:+9112345625'>+91 1234567890<br>
                Email: <a href='mailto:hello@settle.ind.in'>hello@stettle.ind.in</a> <br><br>
                Thank You!!<br>
                <b>Team Settle!</b>";
        $text = "Your service ".$result['company']." has been deactivated, if you have any query please call us on our toll-free no. 1234567890";

        $mail =$this->siteadmin_model->sendemail($result['email_id'],$sub,$msg);
        $this->siteadmin_model->sendmessage($text,$result['mobileno']);
        $this->session->set_flashdata('success', 'Service has been deactivated successfully');
        redirect('siteadmin/service/service_list');
    }

    public function view_booked_service($unique_id,$id = 0)
    {
        $service_detail = $this->service_model->get_service($unique_id);
        $service_image = $this->service_model->get_serviceimage($unique_id);
        $data['booked_service'] = $this->service_model->get_booked_service($id); //Get events
        $data['service_image'] = $service_image;
        $data['service_details'] = $service_detail;
        $data['menu'] = 'bookedservice';
        $data['include'] = 'siteadmin/service/view_booked_service';
        $this->load->view('backend/container',$data);
    }
}