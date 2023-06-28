<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Faqs extends CI_Controller
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
    // Index =============================================================
    public function index()
    {
   
      $data["file"]="front/faqs";
      $this->load->view('front/template',$data);
    }

    // Question send ======================================================
    public function mail_question()
    {
        $this->load->library('email_service');
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('email','Email ','trim|required');
        $this->form_validation->set_rules('message','Question','trim|required');
        // Form data
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
           
            $insertData['name'] = $form_data['name'];
            $insertData['email'] = strtolower($form_data['email']);
            $insertData['question'] = $form_data['message'];
            //$result = $this->model_name->save($insertData);

            
            // Send Mail 
            $insertData['admin_email'] = $this->config->item('admin_email_id');
             $response_mail = $this->email_service->send_faq_admin_email($insertData);
             if($response_mail)
             {
                $this->session->set_flashdata('success', 'Question Successfully Sent .');
             }
             else
             {
                $this->session->set_flashdata('error', 'Something Went Wrong...');
             }


         }   
        
       redirect('front/faqs/');
    }

   


}

?>