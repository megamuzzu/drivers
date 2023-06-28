<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/stripe-php-6.4.1/init.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Select_service extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public $stripe;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/services_model');
        $this->load->model('admin/stripe_plan_model');
        $this->load->model('admin/stripe_subcription_model');
        // Stripe
         $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key')
        );
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index($user_id = NULL)
    {
        $data = array();
        if(empty($user_id))
        {
            $data['msg'] = "First Login Then Select Service...";
        }
        else
        {
           
            $data['user_id'] = $user_id;

            // Subscription all list 
            $where = array();
            $where['member_id'] = $data['user_id'];
            $where['field'] = "id";
            $temp_subscription = $this->stripe_subcription_model->findDynamic($where);
            $num_subscription = count($temp_subscription);
            if($num_subscription > 0)
            {
                $data['msg'] = "You Are Already Subscribe Service ..!";
                //$this->session->set_flashdata('error', 'Already Subscribe. ');
                //redirect('front/index_page');
            }
            else
            {
                // Service List 
                $where = array();
                $where['service_status'] = '1';
                
                $data['service_list'] = $this->services_model->findDynamic($where);
            }    
           
        }
        $data["file"]="front/select_service";
        $this->load->view('front/template',$data);  
    }

    // Signup Form  ===============================================================
    public function strip_signup_form()
    {
        $stripe = $this->stripe;
       
        // Get plan
        $where  = array();
        $where['id'] = $_GET['member'];
        $where['table'] = 'zs_members';
        $member_data = $this->stripe_plan_model->findDynamic($where) ;
        $member = $member_data[0];
        

        // Get plan
        $where  = array();
        $where['service_id'] = $_GET['plan'];
       
        $plan_data = $this->stripe_plan_model->findDynamic($where) ;

        $plan = $plan_data[0];
        $plan_amount = $plan->amount*100;
        if(!empty($plan))
        {
            echo $form = '<form action="'.base_url().'front/select_service/charge_subcription" method="post">
                <input type="hidden" name="plan_id" value="'.$plan->id.'"/>
                <input type="hidden" name="member_id" value="'.$_GET['member'].'"/>
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="'.$stripe['publishable_key'].'"
                data-image="'.base_url().'assets/front/images/cdla.png"
                data-name="Zeno strategics"
                data-description="'.$plan->nickname.'"
                data-amount="'.$plan_amount.'"
                data-label="Sign Me Up!">
              </script>
            </form>';
        }
       else{
        echo "<h3><i>Something Went Wrong</i></h3>";
       }
    }

    // Insert  *************************************************************
    // Subscription user signup
    public function charge_subcription()
    {
        //check already subscribe or not
        $stripe = $this->stripe;
        \Stripe\Stripe::setApiKey($stripe['secret_key']); 
        

        try
        {
          // Plan details
            $member_id  = $_POST['member_id'];
            
            $plan_id  = $_POST['plan_id'];
            $where  = array();
            $where['id'] = $plan_id;
            $plan_data = $this->stripe_plan_model->findDynamic($where) ;
            $plan = $plan_data[0];  


          $customer = \Stripe\Customer::create(array(
            'email' => $_POST['stripeEmail'],
            'source'  => $_POST['stripeToken'],
          ));
            

          $subscription = \Stripe\Subscription::create(array(
            'customer' => $customer->id,
            'items' => array(array('plan' => $plan->plan_id)),
          ));
         
          $subs_json = $subscription->jsonSerialize();
          /*echo "<pre>";
          print_r($subs_json);
          echo "</pre>";*/
          
        }
        catch(Exception $e)
        {
          //header('Location:oops.html');
          error_log("unable to sign up customer:" . $_POST['stripeEmail'].
            ", error:" . $e->getMessage());
         echo $alert_msg = $e->getMessage();
        }

        if(isset($subs_json))
        {
            $insertData['subscription_id'] = $subs_json['id'];
            $insertData['member_id'] = $member_id;
            $insertData['cutomer_email'] = $_POST['stripeEmail'];
            $insertData['customer_stripe_id'] = $subs_json['customer'];
            $insertData['plan_id'] = $subs_json['plan']['id'] ;
            $insertData['plan_name'] = $subs_json['plan']['nickname'];
            $insertData['quantity'] = $subs_json['quantity'];
            $insertData['currency'] = $subs_json['plan']['currency'];
            
            $insertData['created'] = date('Y-m-d H:i:s', $subs_json['created']) ;
            $insertData['current_period_start'] = (!empty($subs_json['current_period_start']))?date('Y-m-d H:i:s', $subs_json['current_period_start']):'' ;
            $insertData['current_period_end'] = date('Y-m-d H:i:s', $subs_json['current_period_end']) ;
            $insertData['canceled_at'] = (!empty($subs_json['canceled_at']))?date('Y-m-d H:i:s', $subs_json['canceled_at']):'' ;
            $insertData['cancel_at_period_end'] = (!empty($subs_json['cancel_at_period_end']))?date('Y-m-d H:i:s', $subs_json['cancel_at_period_end']):'' ;
            $insertData['status'] = "Pending"; //$subs_json['status'];
            $result = $this->stripe_subcription_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Subscription Payment Successfully Done');
                
                //echo "<h2><i>Subscription Payment Successfully Done</i></h2>";
            }
            else
            { 
                echo "Subscription Payment Filed.";
                $this->session->set_flashdata('error', 'Subscription failed : '.$alert_msg );
            }

        }
        redirect('front/select_service');
    }

    

}

?>