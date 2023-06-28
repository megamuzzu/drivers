<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/stripe-php-7.79.0/init.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Customerportal extends CI_Controller
{
    public $stripe;
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        
        // Cookie helper
        $this->load->helper('cookie');


         $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key'),
          "plan_key" => $this->config->item('plan_key')
        );
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index($customerId = NULL)
    {
      if(empty($customerId)){
        echo "Something went wrong!";
        exit;
      }
      // Onload Comon Page Data ============================= 
      $data = array();
      
      $stripe = $this->stripe;

      \Stripe\Stripe::setApiKey($stripe['secret_key']);
      // Authenticate your user.
      $session = \Stripe\BillingPortal\Session::create([
        'customer' => $customerId,//'cus_JY98yqM9S5ALJv',    //'{{ CUSTOMER_ID }}',
        'return_url' => base_url('customer-portal'),
      ]);

      // Redirect to the customer portal.
      header("Location: " . $session->url);
      exit();
    }


    



   

}

?>