<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Products extends CI_Controller
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
      $data = array();

       $data["title"]="Drivers Utilities";
       $data["file"]="front/products";
       $this->load->view('front/template',$data);
    } 

     public function driver_updater()
    {
      
        $data = array();
        $data['page'] = 'driver_fixer';
        $data["title"]="Driver Repair 24x7";
        $data["file"]="front/driver-fixer";
        $this->load->view('front/template',$data);
    } 
    public function driver_pc_cleaner()
    {
        $data = array();
        $data['page'] = 'driver_scanner';
        $data["title"]="Driver Repair 24x7 Cleaner ";
        $data["file"]="front/driver-scanner";
        $this->load->view('front/template',$data);
    }  

}

?>