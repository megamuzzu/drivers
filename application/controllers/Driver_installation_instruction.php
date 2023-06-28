<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Driver_installation_instruction extends CI_Controller
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
      $data['pagetype'] = "instructions" ;
      // Define =========================== 
       $data["title"]="Driver Installation Instruction";
       $data["file"]="front/driver-installation-instruction";
       $this->load->view('front/template',$data);

    } 

    public function downloadlink()
    {

      // Onload Comon Page Data ============================= 
      $data = array();
      $data['pagetype'] = "DownloadInstructions" ;
      $data['page'] = "DownloadInstructions" ;
      // Define =========================== 
       $data["title"]="Drivers Fixer";
       $data["file"]="front/driver-installation-instruction";
       $this->load->view('front/template',$data);
    } 
    public function trynow()
    {

      // Onload Comon Page Data ============================= 
    	$data = array();
      $data['pagetype'] = "trynow" ;
      // Define =========================== 
       $data["title"]="Drivers Fixer";
       $data["file"]="front/driver-installation-instruction";
       $this->load->view('front/template',$data);
    } 


    public function sendDownloadLink(){
      $this->load->model('trynowemail_model');
      $formData  = $this->input->post();

      // Insert 
      $insertData['email'] = $formData['email'];
      $insertData['status'] = 1;
      $insertData['dateat'] = date("Y-m-d H:i:s");
      $this->trynowemail_model->save($insertData);


      // sent link on email
      $userHeaderHtml = '<html>
        <head>
            <title>Drivers Fixer Trial Software Download Link </title>
        </head>
        <body>';


        // set mail
        $htmlContent = trialdownloadlink();
        $from = "support@driverrepair24x7.com";
        // customer email sent 
        //===================================================================   
        $mail_to = $formData['email'];
        $subject = "Driver Repair 24x7 Trial Software Download Link"; 
        // Set content-type header for sending HTML email
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers .= 'From: driverfixer Trial Download'.'<'.$from.'>' . "\r\n"; 

        $headers = 'From: DriverRepair24x7TrialDownload support@driverrepair24x7.com' . "\r\n" ;
        $headers .='Reply-To: '. $mail_to . "\r\n" ;
        $headers .='X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";  
        // Send email
        $mailcontent = $userHeaderHtml.$htmlContent;
        if(mail($mail_to, $subject, $mailcontent, $headers)){
            //echo 'Email has sent successfully.';
        }else{
           //echo 'Email sending failed.';
        }


      echo "1";
      exit;
    }

}

?>