<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Download extends CI_Controller
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
    public function index($downloadFor = NULL)
    {
      // Onload Comon Page Data ============================= 
    	$data = array();
       // Define =========================== 
       $data['downloadFor'] = $downloadFor;
       $data["title"]="Update Drivers";
       $data["file"]="front/download";
       $this->load->view('front/template',$data);
    } 

    // For only printer driver===================================
    public function printerdriver()
    {

     // Onload Comon Page Data ============================= 
      $data = array();
       // Define =========================== 
       $data['downloadFor'] = "Printers Driver";
       $data["title"]="Drivers Fixer";
       $data["file"]="front/download-2";
       $this->load->view('front/template',$data);
    } 

    // For only Audio driver===================================
    public function audiodriver()
    {
      
     // Onload Comon Page Data ============================= 
      $data = array();
       // Define =========================== 
       $data['downloadFor'] = "Audio Driver";
       $data["title"]="Drivers Fixer";
       $data["file"]="front/audiodriver";
       $this->load->view('front/template',$data);
    } 

    // For only Audio driver===================================
    public function systemdriver()
    {
      
     // Onload Comon Page Data ============================= 
      $data = array();
       // Define =========================== 
       $data['downloadFor'] = "System Driver";
       $data["title"]="Drivers Fixer";
       $data["file"]="front/systemdriver";
       $this->load->view('front/template',$data);
    } 


    // download hp printer deriver ===============================
    public function downloadhpdriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["title"]="Download HP printer driver";
       $data["file"]="front/downloadhpdriver";
       $this->load->view('front/template',$data);
    }  

     public function downloadcanondriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["title"]="Download Canon printer driver";
       $data["file"]="front/downloadcanondriver";
       $this->load->view('front/template',$data);
    } 
        public function downloadepsondriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["title"]="Download Epson printer driver";
       $data["file"]="front/downloadepsondriver";
       $this->load->view('front/template',$data);
    } 


    public function downloadbrotherdriver()
    {
      // Onload Comon Page Data ============================= 
        $data = array();
       // Define =========================== 
       $data["title"]="Download Brother printer driver";
       $data["file"]="front/downloadbrotherdriver";
       $this->load->view('front/template',$data);
    } 

}

?>