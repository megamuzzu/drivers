<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class about extends CI_Controller
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
   
      $data["file"]="front/about";
      $this->load->view('front/template',$data);
    }

}

?>