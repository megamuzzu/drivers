<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Eula extends CI_Controller
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
       $data["title"]="EULA";
       $data["file"]="front/eula";
       $this->load->view('front/template',$data);
    } 
    
    
     public function download_printer_driver()
    {
      $data = array();
      



       // Define =========================== 
       $data["title"]="Download Printer Driver";
       $data["file"]="front/download-printer-driver";
       $this->load->view('front/template',$data);
    } 

    public function download_sound_driver()
    {
      $data = array();
      



       // Define =========================== 
       $data["title"]="Download Printer Driver";
       $data["file"]="front/download-sound-driver";
       $this->load->view('front/template',$data);
    } 
    public function download_system_driver()
    {
      $data = array();
      



       // Define =========================== 
       $data["title"]="Download Printer Driver";
       $data["file"]="front/download-system-driver";
       $this->load->view('front/template',$data);
    }  

     public function download_usb_driver()
    {
      $data = array();
      



       // Define =========================== 
       $data["title"]="Download Printer Driver";
       $data["file"]="front/download-usb-driver";
       $this->load->view('front/template',$data);
    }
    public function download_hardware_driver()
    {
      $data = array();
      



       // Define =========================== 
       $data["title"]="Download Printer Driver";
       $data["file"]="front/download-hardware-driver";
       $this->load->view('front/template',$data);
    } 

}

?>