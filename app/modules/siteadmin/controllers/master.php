<?php
class master extends CI_Controller
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
        $this->load->model('master_model');
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

/*************************************Service master start***********************************/

    public function services($unique_id = '')
    {
        $this->Checklogin();$data["selected_menu"] = "master";
        if(isset($_POST['submit']))
        {
            $is_present = $this->master_model->service_ispresent($_POST['service_name']);
            
                if(strlen($unique_id) > 0)
                {
                    $update_id = $this->master_model->update_services($unique_id);
                    if($update_id)
                    {
                        $this->session->set_flashdata('success','Services has been update successfully.');
                        redirect("siteadmin/master/services");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable update to service , please try again later...');
                        redirect("siteadmin/master/services");
                    }
                }
                else
                {
                    $insert_id = $this->master_model->fill_services();
                    if($insert_id)
                    {
                        $this->session->set_flashdata('success','Services has been save successfully.');
                        redirect("siteadmin/master/services");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable save to service , please try again later...');
                        redirect("siteadmin/master/services");
                    }
                }
            
        }
        $data['service_edit'] = $this->master_model->get_thatservice($unique_id);
        $service_details = $this->master_model->get_servicedetails();
        $data['service_list'] = $service_details;
        $data['menu'] = 'service';
        $data['include'] = 'siteadmin/master/services';
        $this->load->view('backend/container',$data);
    }

    public function active_services($page=0,$id='')
    {
        if($page == 1)
        {
            $this->master_model->service_deactivates($id); 
            $this->session->set_flashdata('success', 'Service has been deactivated successfully');
            redirect('siteadmin/master/services');
        }
        elseif($page == 2)
        {
            $this->master_model->service_activates($id); 
            $this->session->set_flashdata('success', 'Service has been activated successfully');
            redirect('siteadmin/master/services');
        }
    }

    public function delete_service()
    {
        $id = $_POST['id'];
        $is_deleted = $this->master_model->delete_thatservice($id);
        if($is_deleted)
        {
            $this->session->set_flashdata('success','Services has been deleted successfully.');
            redirect("siteadmin/master/services");
        }
        else
        {
            $this->session->set_flashdata('error','unable delete service , please try again later...');
            redirect("siteadmin/master/services");
        }
    }

/*************************************Service master end***********************************/
/*************************************Venue master start***********************************/

    public function venue($unique_id = '')
    {
        $this->Checklogin();$data["selected_menu"] = "master";
        if(isset($_POST['submit']))
        {
            //$is_present = $this->master_model->venue_ispresent($_POST['venue_name']);
            
                if(strlen($unique_id) > 0)
                {
                    $update_id = $this->master_model->update_venue($unique_id);
                    if($update_id)
                    {
                        $this->session->set_flashdata('success','Venue has been update successfully.');
                        redirect("siteadmin/master/venue");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable update to venue , please try again later...');
                        redirect("siteadmin/master/venue");
                    }
                }
                else
                {
                    $insert_id = $this->master_model->fill_venue();
                    if($insert_id)
                    {
                        $this->session->set_flashdata('success','Venue type has been save successfully.');
                        redirect("siteadmin/master/venue");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable save to venue , please try again later...');
                        redirect("siteadmin/master/venue");
                    }
                }
            
        }
        $data['venue_edit'] = $this->master_model->get_thatvenue($unique_id);
        $venue_details = $this->master_model->get_venuedetails();
        $data['venue_list'] = $venue_details;
        $data['menu'] = 'venue';
        $data['include'] = 'siteadmin/master/venue';
        $this->load->view('backend/container',$data);
    }

    public function active_venue($page=0,$id='')
    {
        if($page == 1)
        {
            $this->master_model->venue_deactivates($id); 
            $this->session->set_flashdata('success', 'Venue has been deactivated successfully');
            redirect('siteadmin/master/venue');
        }
        elseif($page == 2)
        {
            $this->master_model->venue_activates($id); 
            $this->session->set_flashdata('success', 'Venue has been activated successfully');
            redirect('siteadmin/master/venue');
        }
    }

    public function delete_venue()
    {
        $id = $_POST['id'];
        $is_deleted = $this->master_model->delete_thatvenue($id);
        if($is_deleted)
        {
            $this->session->set_flashdata('success','Venue has been deleted successfully.');
            redirect("siteadmin/master/venue");
        }
        else
        {
            $this->session->set_flashdata('error','unable delete venue , please try again later...');
            redirect("siteadmin/master/venue");
        }
    }

/*************************************Venue master end***********************************/

/*************************************Event place master start***********************************/
/*************************************Event place master start***********************************/

    public function event_location($unique_id = '')
    {
        $this->Checklogin();$data["selected_menu"] = "master";
        if(isset($_POST['submit']))
        {
            $is_present = $this->master_model->eventplace_ispresent($_POST['location_name']);
            if(!$is_present)
            {
                if(strlen($unique_id) > 0)
                {
                    $update_id = $this->master_model->update_event_location($unique_id);
                    if($update_id)
                    {
                        $this->session->set_flashdata('success','Event location has been update successfully.');
                        redirect("siteadmin/master/event_location");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable update to event location , please try again later...');
                        redirect("siteadmin/master/event_location");
                    }
                }
                else
                {
                    $insert_id = $this->master_model->fill_event_location();
                    if($insert_id)
                    {
                        $this->session->set_flashdata('success','Event location has been save successfully.');
                        redirect("siteadmin/master/event_location");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable save to event location , please try again later...');
                        redirect("siteadmin/master/event_location");
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('error','Event location is already present...');
                redirect("siteadmin/master/event_location");
            } 
        }
        $data['event_location_edit'] = $this->master_model->get_thatevent_location($unique_id);
        $event_location_details = $this->master_model->get_event_locationdetails();
        $data['event_location_list'] = $event_location_details;
        $data['include'] = 'siteadmin/master/event_location';
        $this->load->view('backend/container',$data);
    }

    public function active_eventlocation($page=0,$id='')
    {
        if($page == 1)
        {
            $this->master_model->eventlocation_deactivates($id); 
            $this->session->set_flashdata('success', 'Event location has been deactivated successfully');
            redirect('siteadmin/master/event_location');
        }
        elseif($page == 2)
        {
            $this->master_model->eventlocation_activates($id); 
            $this->session->set_flashdata('success', 'Event location has been activated successfully');
            redirect('siteadmin/master/event_location');
        }
    }

    public function delete_eventlocation()
    {
        $id = $_POST['id'];
        $is_deleted = $this->master_model->delete_thateventlocation($id);
        if($is_deleted)
        {
            $this->session->set_flashdata('success','Event location has been deleted successfully.');
            redirect("siteadmin/master/event_location");
        }
        else
        {
            $this->session->set_flashdata('error','unable delete event location , please try again later...');
            redirect("siteadmin/master/event_location");
        }
    }

/*************************************Event place master end***********************************/

/*************************************Events master start***********************************/

    public function events($unique_id = '')
    {
        $this->Checklogin();$data["selected_menu"] = "master";
        if(isset($_POST['submit']))
        {
            $is_present = $this->master_model->events_ispresent($_POST['event_name']);
            if(!$is_present)
            {
                if(strlen($unique_id) > 0)
                {
                    $update_id = $this->master_model->update_events($unique_id);
                    if($update_id)
                    {
                        $this->session->set_flashdata('success','Event has been update successfully.');
                        redirect("siteadmin/master/events");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable update to event , please try again later...');
                        redirect("siteadmin/master/events");
                    }
                }
                else
                {
                    $insert_id = $this->master_model->fill_events();
                    if($insert_id)
                    {
                        $this->session->set_flashdata('success','Event has been save successfully.');
                        redirect("siteadmin/master/events");
                    }
                    else
                    {
                        $this->session->set_flashdata('error','unable save to event , please try again later...');
                        redirect("siteadmin/master/events");
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('error','Event is already present...');
                redirect("siteadmin/master/events");
            } 
        }
        $data['event_edit'] = $this->master_model->get_thatevent($unique_id);
        $event_details = $this->master_model->get_eventdetails();
        $data['event_list'] = $event_details;
        $data['menu'] = 'event';
        $data['include'] = 'siteadmin/master/events';
        $this->load->view('backend/container',$data);
    }

    public function active_event($page=0,$id='')
    {
        if($page == 1)
        {
            $this->master_model->event_deactivates($id); 
            $this->session->set_flashdata('success', 'Event has been deactivated successfully');
            redirect('siteadmin/master/events');
        }
        elseif($page == 2)
        {
            $this->master_model->event_activates($id); 
            $this->session->set_flashdata('success', 'Event has been activated successfully');
            redirect('siteadmin/master/events');
        }
    }

    public function delete_event()
    {
        $id = $_POST['id'];
        $is_deleted = $this->master_model->delete_thatevent($id);
        if($is_deleted)
        {
            $this->session->set_flashdata('success','Event has been deleted successfully.');
            redirect("siteadmin/master/events");
        }
        else
        {
            $this->session->set_flashdata('error','unable delete event , please try again later...');
            redirect("siteadmin/master/events");
        }
    }
    /*************************************Testimonial master start***********************************/

    public function add_testimonial($unique_id='')
    {
        if(isset($_POST['submit']))
        {
           if(strlen($unique_id) > 0)
            {
            $add_images=$_FILES['testimonial_image']['name'];
            $count_image=0;
                if($add_images!= '')
                {
                $file_name = $_FILES['testimonial_image']['name'];
                $new_file = explode(".", $file_name);
                $extention = end($new_file);     
                    if($extention == 'jpg' || $extention=='jpeg' || $extention=='gif' || $extention=='bmp' || $extention=='png') // Check for extention of file
                   {

                   }   
                    else
                   {
                     $count_image++;
                   }
                if($count_image>0)    
                {
                    $this->session->set_flashdata('error', 'Please Upload Only Images.');
                    redirect('siteadmin/master/add_testimonial');
                } 
                } 
                $update_id = $this->master_model->update_testimonial($unique_id);
                if($update_id > 0)
                {
                    $this->session->set_flashdata('success',' Testimonial has been update successfully.');
                    redirect("siteadmin/master/view_testimonial");
                }
                else
                {
                    $this->session->set_flashdata('error','unable to update, please try again later...');
                    redirect("siteadmin/master/add_testimonial");
                }
            }
            else
            {
                $add_images=$_FILES['testimonial_image']['name'];
                $count_image=0;
                $file_name = $_FILES['testimonial_image']['name'];
                $new_file = explode(".", $file_name);
                $extention = end($new_file);     
                if($extention == 'jpg' || $extention=='jpeg' || $extention=='gif' || $extention=='bmp' || $extention=='png') // Check for extention of file
                {

                }
                else
                {
                    $count_image++;
                }
                if($count_image>0)    
                {
                        $this->session->set_flashdata('error', 'Please Upload Only Images.');
                        redirect('siteadmin/master/add_testimonial');
                }  
                else
                {
                    $result = $this->master_model->insert_test();
                    if($result)
                    {
                    $this->session->set_flashdata('success','Testimonial has been saved successfully.');
                    redirect("siteadmin/master/add_testimonial");
                    }
                    else
                    {
                        $this->seesion->set_flashdata('error','Unable to save,Please try again.');
                        redirect("siteadmin/master/add_testimonial");
                }   
            }
                
        } 
            // else
            // {
            //    $insert_id = $this->master_model->insert_test();
            // if($insert_id)
            // {
          
            //   $this->session->set_flashdata('success','Guest has been added successfully.'); 
            //   redirect("siteadmin/master/add_testimonial");  
            // }
            // else{
            //  $this->session->set_flashdata('error','unable add event , please try again later...'); 
            //  redirect("siteadmin/master/add_testimonial");
            //  } 
            // }
            
        }
        $data['testimonial_get'] = $this->master_model->testimonial_get($unique_id);
        $data['include'] = 'siteadmin/master/add_testimonial';
        $data['menu'] = 'testimonial';
        $this->load->view('backend/container',$data);
    }
     public function view_testimonial()
    {
        $test_details = $this->master_model->get_test_list();
        $data['test_details'] = $test_details;
        $data['menu'] = 'testimonial';
        $data['include'] = 'siteadmin/master/view_testimonial';
        $this->load->view('backend/container',$data);
    }
    public function delete_testimonial($unique_id)
    {
        $isdeleted = $this->master_model->delete_test($unique_id);
        if($isdeleted)
        {
            $this->session->set_flashdata("success","Testimonial deleted successfully.");
            redirect("siteadmin/master/view_testimonial");
        }
        else
        {
            $this->session->set_flashdata("error","Unable to delete Testimonial, please try again....");
            redirect("siteadmin/master/view_testimonial");
        }
    }
    public function testimonial_active($id='')
    {
        $this->master_model->test_active($id);
         $this->session->set_flashdata('success', 'Testimonial has been activated successfully');
         redirect('siteadmin/master/view_testimonial');
    }
    public function testimonial_deactive($id='')
    {
        $this->master_model->test_deactive($id);
         $this->session->set_flashdata('success', 'Testimonial has been Deactivated successfully');
         redirect('siteadmin/master/view_testimonial');
    }
}
