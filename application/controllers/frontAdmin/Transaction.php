<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/FrontBaseController.php';
require APPPATH . '../assets/stripe-php-6.4.1/init.php'; 
        
        
/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Transaction extends FrontBaseController
{
    /**
     * This is default constructor of the class
     */
    public $stripe;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/stripe_subcription_model');
        $this->load->model('admin/stripe_all_subscription_model');
        $this->load->model('admin/stripe_charge_model');
        $this->isLoggedIn();  
        // Stripe
         $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key')
        ); 
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
       
        $data = array();
        $id = $this->member_id;
        $where = array();
        $where['member_id'] =$this->member_id;
        $data['detail'] = $this->stripe_subcription_model->findDynamic($where);

       
         if(!empty($data['detail']))
         {
            $subscripton = $data['detail'][0];
            $data['detail'] = $data['detail'][0];
            
            // Subscription all list 
            $where = array();
            $where['customer_id'] = $subscripton->customer_stripe_id;
            $data['detail_all'] = $this->stripe_all_subscription_model->findDynamic($where);
            
            // Charge all list
            $where = array();
            $where['customer_id'] = $subscripton->customer_stripe_id;
            $data['detail_charge'] = $this->stripe_charge_model->findDynamic($where);
        }
    
   
    
        //print_r($data['videos_list']);
        $this->global['pageTitle'] = 'zenostrategics : Resources';
        $this->loadViews("frontadmin/transaction", $this->global, $data , NULL);
    }

    //Cancel Subscription ************************************
      function subscription_cancel()
    {


        $where = array();
        //$where['table'] = 'zs_stripe_charge';
        $where['member_id'] = $this->member_id;
        $db_data = $this->stripe_subcription_model->findDynamic($where);
        
        if(!empty($db_data))
        {
            
            $temp_data = $db_data;
        }

      
        if(!empty($temp_data))
        {
            $subscription_data = $temp_data[0];
            if($subscription_data->status == 'canceled')
            {
                $this->session->set_flashdata('error', 'Subscription Already Canceled');
                redirect('frontadmin/transaction'); 
                exit;
            }
               

            $stripe = $this->stripe;
            \Stripe\Stripe::setApiKey($stripe['secret_key']); 
            $subscription_id = $subscription_data->subscription_id;
            try {
                $subscription = \Stripe\Subscription::retrieve($subscription_id);
                $subscription->cancel();
                $cancel_json = $subscription->jsonSerialize();
            }
             catch(Exception $e) {
                echo 'Alert Message: ' .$e->getMessage();
             }

             if(isset($cancel_json) && $cancel_json['status'] == 'canceled')
             {
                $update_data['id'] = $subscription_data->id;
                $update_data['canceled_at'] = date("Y-m-d H:i:s",$cancel_json['canceled_at']);
                $update_data['status'] = $cancel_json['status'];
                $result = $this->stripe_subcription_model->save($update_data);
                $this->session->set_flashdata('success', 'Subscription Successfully Canceled .');
                redirect('frontadmin/transaction'); 
            } 
        }
        else
        {
            $this->session->set_flashdata('error', 'Subscription Id Not Found.');
            redirect('frontadmin/transaction'); 
        }

       
    }

}

?>