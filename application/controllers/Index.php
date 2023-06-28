<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Index extends CI_Controller
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
       $data['page'] = "index";
       $data["title"]="Driver Repair 24x7";
       $data["file"]="front/index";
       $this->load->view('front/template',$data);
    }  

    // Index2 =============================================================
    public function printerdriver()
    {
      // Onload Comon Page Data ============================= 
      
        $data = array();
       // Define =========================== 
       $data["chatStatus"]="on";
       $data["title"]="Download Printer Driver";
       $data["file"]="front/index-for-printer-driver";
       $this->load->view('front/template',$data);
    }
    // canon printer driver
    public function canonprinterdriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
        $data["chatStatus"]="on";
       $data["title"]="Download Printer Driver";
       $data["file"]="front/index-for-canon-printer-driver";
       $this->load->view('front/template',$data);
    }
    // Epson printer driver
    public function epsonprinterdriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
        $data["chatStatus"]="on";
       $data["title"]="Download Printer Driver";
       $data["file"]="front/index-for-epson-printer-driver";
       $this->load->view('front/template',$data);
    }
    // Brother printer driver
    public function brotherprinterdriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
        $data["chatStatus"]="on";
       $data["title"]="Download Printer Driver";
       $data["file"]="front/index-for-brother-printer-driver";
       $this->load->view('front/template',$data);
    }

    public function thanksforinstall()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["page"]="thanksforinstall";
       $data["title"]="Download Printer Driver -  ";
       $data["file"]="front/thank-for-install";
       $this->load->view('front/template',$data);
    } 

    // Index2 =============================================================
    public function v1()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["title"]="V1";
       $data["file"]="front/index-new";
       $this->load->view('front/template',$data);
    }  

     


    public function cookieupdate()
    {
        $cookiesave = array(
         'name'   => 'driverfixerCookie',
         'value'  => '1',
         'expire' =>  time()+86400);

        set_cookie($cookiesave);
        exit;
    } 



    public function call_api()
    {
      $apidata = array();
      $apidata['url']      =  'http://127.0.0.1/SharedAccess/web44/adminpanel/call_api';
      $apidata['name']     =  "Test";
      $apidata['email']    =  "test@gmail.com1";
      $apidata['phone']    =  "9696969696";
      $apidata['message']  =  "Test Message";
      $apidata['url_from'] =  base_url();
      $apidata['apikey']   =  "097u7hk7KK";

      if(!empty($apidata['apikey']))
      {
          $callcurl = callcurl($apidata);

          $getresult = json_decode($callcurl);
          
          if($getresult->status ==1  ||  $getresult->status== 2 )
          {
            echo $getresult->message;
          } 
           
      }
      
    }
     public function call_api_list()
    {
      $apidata = array();
      $apidata['url']      =  'http://127.0.0.1/SharedAccess/web44/adminpanel/listdata';
      $apidata['url_from'] =  base_url();
      $apidata['apikey']   =  "097u7hk7KK";

      
          $callcurl = callcurl($apidata);
           
          $getresult = json_decode($callcurl);
            
          echo "<pre>";

          print_r($getresult);
          echo "</pre>";
         
           
      
      
    }

}

?>