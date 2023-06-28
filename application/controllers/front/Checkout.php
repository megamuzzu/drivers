<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/stripe-php-6.4.1/init.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Checkout extends BaseController
{
    public $stripe;
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('admin/stripe_plan_model');
        $this->load->model('admin/stripe_subcription_model');
        $this->load->model('admin/stripe_charge_model');
        $this->load->model('admin/stripe_all_subscription_model');

        $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key')
        );
    }



    /**
     * Index Page for this controller.
     */
    // Pay now =============================================================
    public function index()
    {
   
     $data['pay_amount'] = 10;
     $data['stripe'] = $this->stripe;
     $this->load->view('front/stripe_checkout',$data);
    }


    // Date view
     public function strDate()
    {
        echo date("d-m-Y","1521175852");
    }

    // Charge now
    public function chargenow()
    {

       /*$stripe = array(
          "secret_key"      => "sk_test_StW2yApk8i7uAQxzHCiwgt01",
          "publishable_key" => "pk_test_2yNHtbH7jydHUw0kByHsisAG"
        );*/
         $stripe = $this->stripe;

        \Stripe\Stripe::setApiKey($stripe['secret_key']); 

       try {
              $token  = $_POST['stripeToken'];
              $email  = $_POST['stripeEmail'];
              $pay_amount  = $_POST['pay_amount'];
            
              $customer = \Stripe\Customer::create(array(
                  'email' => $email,
                  'source'  => $token
              ));

              $charge = \Stripe\Charge::create(array(
                  'customer' => $customer->id,
                  'amount'   => $pay_amount*100,
                  'currency' => 'usd'
              ));

              $chargejson = $charge->jsonSerialize();
              
         }
         catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
         } 

         if(isset($chargejson) && $chargejson['id'] !='' )
         {
          /*
            echo "<pre>";
            print_r($chargejson);
            echo "</pre><br/>";
            echo '<h1>Successfully charged $'.$pay_amount.'.00!</h1>';
            // Insert Data in database
          */  
         }
    }     

   

    // Subcription  Signup User =======================================================
    public function strip_signup()
    {
        
        $where  = array();
        $plan_data = $this->stripe_plan_model->findDynamic($where)  ;
        foreach($plan_data as $k=>$v)
        {
            $data['plan'][$v->id] = $v->nickname." $".$v->amount;
        }
        $data['stripe'] = $this->stripe;
        $this->load->view('front/subscription-signup',$data);
    }
    // Signup Form 
    public function strip_signup_form()
    {
        // Get plan
        $where  = array();
        $where['id'] = $_GET['plan'];
        $plan_data = $this->stripe_plan_model->findDynamic($where) ;
        $plan = $plan_data[0];
        $plan_amount = $plan->amount*100;
        if(!empty($plan))
        {
            echo $form = '<form action="'.base_url().'front/checkout/charge_subcription" method="post">
                <input type="hidden" name="plan_id" value="'.$where['id'].'"/>
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_2yNHtbH7jydHUw0kByHsisAG"
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

    // Subscription user signup
    public function charge_subcription()
    {
        $stripe = $this->stripe;
        \Stripe\Stripe::setApiKey($stripe['secret_key']); 
        

        try
        {
          // Plan details
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
            $insertData['cutomer_email'] = $_POST['stripeEmail'];
            $insertData['customer_stripe_id'] = $subs_json['customer'];
            $insertData['plan_id'] = $plan->plan_id;
            $insertData['plan_name'] = $plan->nickname;
            $insertData['quantity'] = $subs_json['quantity'];
            $insertData['currency'] = $plan->currency;
            $insertData['amount'] = $plan->amount;
            $insertData['created'] = date('Y-m-d H:i:s', $subs_json['created']) ;
            $insertData['current_period_start'] = (!empty($subs_json['current_period_start']))?date('Y-m-d H:i:s', $subs_json['current_period_start']):'' ;
            $insertData['current_period_end'] = date('Y-m-d H:i:s', $subs_json['current_period_end']) ;
            $insertData['canceled_at'] = (!empty($subs_json['canceled_at']))?date('Y-m-d H:i:s', $subs_json['canceled_at']):'' ;
            $insertData['cancel_at_period_end'] = (!empty($subs_json['cancel_at_period_end']))?date('Y-m-d H:i:s', $subs_json['cancel_at_period_end']):'' ;
            $insertData['status'] = $subs_json['status'];
            $result = $this->stripe_subcription_model->save($insertData);

            if($result > 0)
            {
                echo "Subscription Payment Successfully Done";
            }
            else
            { 
                echo "Subscription Payment Filed.";
                $this->session->set_flashdata('error', 'Subscription failed : '.$alert_msg );
            }
        }
    }

     function testing()
    {

      $insert["subscription_table_id"] = "0";
      $insert["subscription_id"] = "sub_CXoMFwrI1UszzQ";
      $insert["customer_id"] = "cus_CXoMXkmNd2utdE";
      $insert["plan_id"] = "plan_CX52dCCwcOoHsr";
      $insert["event_id"] = "evt_1C8ijjEnaXT9YFcUqF07ctTH";
      $insert["member_id"] = "0";
      $insert["event_type"] = "customer.subscription.created";
      $insert["status"] = "Painding";
      $insert["subscription_current_period_start"] = "2018-03-23 05:46:46";
      $insert["subscription_current_period_end"] = "2018-04-23 05:46:46";
      $insert["event_at"] = "2018-03-23 05:46:47";
      $result = $this->stripe_charge_model->save($insert);

      exit;
      $where = array();
              echo $where['subscription_id'] = 'sub_CXoMFwrI1UszzQ';
              $find_data = $this->stripe_subcription_model->findDynamic($where);
              print_r($find_data);
      exit;
      $insert_data['subscription_table_id'] = 0;
              $insert_data['subscription_id'] = 'sub_CXoMFwrI1UszzQ';
              $insert_data['customer_id'] ='cus_CXoMXkmNd2utdE';
              $insert_data['plan_id'] = 'plan_CX52dCCwcOoHsr';
              $insert_data['event_id'] = 'evt_1C8ijjEnaXT9YFcUqF07ctTH';
              $insert_data['member_id'] = 0;
              $insert_data['event_type'] = 'customer.subscription.created';
              $insert_data['status'] = "Painding";
              $insert_data['subscription_current_period_start'] = '2018-03-23 05:46:46';
              $insert_data['subscription_current_period_end'] = '2018-04-23 05:46:46'; 
              $insert_data['event_at'] = '2018-03-23 05:46:47';

      
      echo $result = $this->stripe_charge_model->save($insert_data);
      echo "<pre>";
      //print_r($insert_data);
      echo "</pre>";
    }

  
    // Stripe webhooks ======================================================
    public function stripe_webhooks()
    {
        //$this->load->model('admin/stripe_subcription_model');
        //$this->load->model('admin/stripe_charge_model');
        $this->load->library('email_service');
         $stripe = $this->stripe;
        \Stripe\Stripe::setApiKey($stripe['secret_key']); 
        
        $body = @file_get_contents('php://input');
        //$event_json = json_decode($body);
        $event_json = json_decode($body);

        
         // coustomer created
        if($event_json->type == "customer.subscription.created")
         {
              // Get Subscription details

              $where = array();
              $where['subscription_id'] = $event_json->data->object->id;
              $find_data = $this->stripe_subcription_model->findDynamic($where);
             
              if(!empty($find_data))
                {
                  $table_data = (isset($find_data[0]))?$find_data[0]:'';
                  
                }

                //Update Subscription Table Status Active
                if(isset($table_data) && !empty($table_data))
                {
                  $update_data = array();
                  $update_data['id'] = $table_data->id;
                  $update_data['status'] = 'active';
                  $result = $this->stripe_subcription_model->save($update_data);
                }

              // Insert DAta in Subscription Charge 
              $insert_data = array();
              $insert_data['subscription_table_id'] = (isset($table_data->id))?$table_data->id:0;
              $insert_data['subscription_id'] = $event_json->data->object->id;
              $insert_data['customer_id'] =$event_json->data->object->customer;
              $insert_data['plan_id'] = $event_json->data->object->plan->id;
              $insert_data['event_id'] = $event_json->id;
              $insert_data['member_id'] = (isset($table_data->member_id))?$table_data->member_id:0;
              $insert_data['event_type'] = $event_json->type;
              $insert_data['status'] = $event_json->data->object->status;
              $insert_data['subscription_current_period_start'] = (empty($event_json->data->object->current_period_start))?:date('Y-m-d H:i:s', $event_json->data->object->current_period_start);
              $insert_data['subscription_current_period_end'] = (empty($event_json->data->object->current_period_end))?:date('Y-m-d H:i:s', $event_json->data->object->current_period_end); 
              $insert_data['event_at'] = date('Y-m-d H:i:s', $event_json->created);

              //print_r($insert_data);
              $result = $this->stripe_all_subscription_model->save($insert_data);
          }


         // Charge success
        if($event_json->type == "charge.succeeded")
         {

              $where = array();
              $where['customer_stripe_id'] = $event_json->data->object->customer;
              $find_data = $this->stripe_subcription_model->findDynamic($where);
              //print_r($find_data);
              if(!empty($find_data))
                {
                  $table_data = (isset($find_data[0]))?$find_data[0]:'';
                  
                }

              // Insert DAta in Subscription Charge 
              $insert_data = array();
              $insert_data['subscription_table_id'] = (isset($table_data->id))?$table_data->id:0;
              
              $insert_data['customer_id'] =$event_json->data->object->customer;
              //$insert_data['plan_id'] = $event_json->data->object->plan->id;
              $insert_data['transaction_id'] = $event_json->data->object->balance_transaction;
              $insert_data['event_id'] = $event_json->id;
              $insert_data['member_id'] = (isset($table_data->member_id))?$table_data->member_id:0;
              $insert_data['event_type'] = $event_json->type;
              $insert_data['status'] =  $event_json->data->object->status;
              $insert_data['charge_id'] = $event_json->data->object->id;
              $insert_data['amount'] = $event_json->data->object->amount;
              $insert_data['currency'] = $event_json->data->object->currency;
              $insert_data['amount_refunded'] = $event_json->data->object->amount_refunded;
              $insert_data['charge_at'] = (empty($event_json->data->object->created))?'':date('Y-m-d H:i:s', $event_json->data->object->created);
              $insert_data['event_at'] = date('Y-m-d H:i:s', $event_json->created);

            

              $result = $this->stripe_charge_model->save($insert_data);  
              
          
          }

        // Customer Subscription update
        if($event_json->type == "customer.subscription.updated")
         {
              
              $where = array();
              $where['subscription_id'] = $event_json->data->object->id;
              $find_data = $this->stripe_subcription_model->findDynamic($where);
             
              if(!empty($find_data))
                {
                  $table_data = (isset($find_data[0]))?$find_data[0]:'';
                  
                }

                //Update Subscription Table Status Active
                if(isset($table_data) && !empty($table_data))
                {
                  $update_data = array();
                  $update_data['id'] = $table_data->id;
                  $update_data['status'] = 'active';
                  $result = $this->stripe_subcription_model->save($update_data);
                }

              // Insert DAta in Subscription Charge 
              $insert_data = array();
              $insert_data['subscription_table_id'] = (isset($table_data->id))?$table_data->id:0;
              $insert_data['subscription_id'] = $event_json->data->object->id;
              $insert_data['customer_id'] =$event_json->data->object->customer;
              $insert_data['plan_id'] = $event_json->data->object->plan->id;
              $insert_data['event_id'] = $event_json->id;
              $insert_data['member_id'] = (isset($table_data->member_id))?$table_data->member_id:0;
              $insert_data['event_type'] = $event_json->type;
              $insert_data['status'] = $event_json->data->object->status;
              //$insert_data['status'] = "Painding";
              $insert_data['subscription_current_period_start'] = (empty($event_json->data->object->current_period_start))?:date('Y-m-d H:i:s', $event_json->data->object->current_period_start);
              $insert_data['subscription_current_period_end'] = (empty($event_json->data->object->current_period_end))?:date('Y-m-d H:i:s', $event_json->data->object->current_period_end); 
              $insert_data['event_at'] = date('Y-m-d H:i:s', $event_json->created);

              //print_r($insert_data);
              $result = $this->stripe_all_subscription_model->save($insert_data);


         http_response_code(200);
    } 

  


}

?>