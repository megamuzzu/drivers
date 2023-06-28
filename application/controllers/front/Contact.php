<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Contact extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/contact_us_model');
     }



    /**
     * Index Page for this controller.
     */
    // Pay now =============================================================
    public function index()
    {
   
      $data["file"]="front/contact_us";
      $this->load->view('front/template',$data);
    }

    // Insert Data *************************************************************
    public function insertnow()
    {
        $this->load->library('email_service');
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('email','Eamil','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required');
        $this->form_validation->set_rules('message','Message','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
           
            $insertData['name'] = $form_data['name'];
            $insertData['email'] = strtolower($form_data['email']);
            $insertData['phone'] = $form_data['phone'];
            $insertData['message'] = $form_data['message'];
            $insertData['message_at'] = date("Y-m-d H:i:s");
            $insertData['view_status'] = '0';
           
            
            $result = $this->contact_us_model->save($insertData);
            if($result > 0)
            {
                $insert_id = $this->db->insert_id();

                $insertData['admin_email'] = "bk@delimp.com";
                $sendStatus = $this->email_service->send_contact_inquiry_admin_email($insertData);
                // Successfull message
                $this->session->set_flashdata('success', 'Contact Us Inquiry Detail Successfull Delivered.');
               
            }
            else
            { 
                $this->session->set_flashdata('error', 'Contact Us Inquiry Detail Failed To Delivered.');
            }
            
            redirect('front/contact');
          }  
        
    }


}

?>