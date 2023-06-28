<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Feedback extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/product_model');
        $this->load->library('base_library');
        // Cookie helper
        $this->load->helper('cookie');
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
      // Onload Comon Page Data ============================= 
    	$data = array();
      



       // Define =========================== 
       $data["title"]="Feedback";
       $data["file"]="front/feedback";
       $this->load->view('front/template',$data);
    } 



    // send mail functions =================================================================================================
   public function sendfeedback(){
      $form_data  = $this->input->post();
     
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name',' Name','trim|required');
        $this->form_validation->set_rules('phone','Phone Number','trim|required');
        $this->form_validation->set_rules('email','Email Address','trim|required');
        $this->form_validation->set_rules('message','Message','trim');
        
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
      // check already added or not 
            $insertData['name'] = $form_data['name'];
            $insertData['email'] = $form_data['email'];
            $insertData['phone'] = $form_data['phone'];
            $insertData['address'] = $form_data['message'];
            

            $userHeaderHtml = '<html>
            <head>
                <title>Customer Feedback </title>
            </head>
            <body>';


            // set mail
             $msg = "Customer Name : ".$_POST['name']."<br/>";
            $msg .= "Customer Email  : ".$_POST['email']."<br/>";
            $msg .= "Customer Phone : ".$_POST['phone']."<br/>";
            $msg .= "Message: ".$_POST['message']."<br/>";
            $msg .= "Message Date : ".date("d/m/Y H:i:s")."<br/>";

            $htmlContent = $msg;
            $from = $_POST['email'];
            // customer email sent 
            //===================================================================   
            $mail_to = "support@driverrepair24x7.com";
            $subject = "Driver Repair 24x7 Customer Feedback Message."; 
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Customer Feedback'.'<'.$from.'>' . "\r\n"; 
            // Send email
            $mailcontent = $userHeaderHtml.$htmlContent;
            if(mail($mail_to, $subject, $mailcontent, $headers)){
                $this->session->set_flashdata('success', 'Your Feedback Sent.');  
            }else{
               $this->session->set_flashdata('error', 'Sumthing Went Wrong Try Again.');
            }
            //exit;
            redirect('uninstall/feedback');
          }  
   } 

}

?>