<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Index_page extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/stripe_plan_model');
     }



    /**
     * Index Page for this controller.
     */
    // Pay now =============================================================
    public function index()
    {
      $data["file"]="front/index_page";
      $this->load->view('front/template',$data);
    } 

    // Get Tuch Send Inquiry ============================================
    public function footer_get_tuch()
    {

        $this->load->library('email_service');
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('get_tuch_user',' Name','trim|required');
        $this->form_validation->set_rules('get_tuch_number','Phone','trim|required');
        $this->form_validation->set_rules('get_tuch_email','Email ','trim|required');
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
           
            $insertData['get_tuch_user'] = $form_data['get_tuch_user'];
            $insertData['get_tuch_number'] = $form_data['get_tuch_number'];
            $insertData['get_tuch_email'] = $form_data['get_tuch_email'];
            $insertData['date'] = date("Y-m-d H:i:s");

            // Send Mail 
            $insertData['admin_email'] = $this->config->item('admin_email_id');// "bk@delimp.com";

           
            
            $response_mail = $this->email_service->send_get_touch_inquiery_admin_email($insertData);

            $this->session->set_flashdata('success', 'Inquiery Details Submitted');
            redirect('front/index_page');
            
          }  
        
    }



}

?>