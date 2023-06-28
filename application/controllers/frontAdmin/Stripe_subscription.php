<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/stripe-php-6.4.1/init.php';
/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Stripe_subscription extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public $stripe;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/stripe_plan_model');
        $this->load->model('admin/stripe_subcription_model');
        $this->load->model('admin/stripe_all_subscription_model');
        $this->load->model('admin/stripe_charge_model');
        // Stripe
         $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key')
        );
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Zeno Strategics : Member Subscription Users';
        $this->loadViews("admin/stripe_subscription/list", $this->global, NULL , NULL);
        
    }


    // Ajax list ==============================================
    public function ajax_list()
    {
        $list = $this->stripe_subcription_model->get_datatables();
        
        $data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->current_period_start;
            $start_date = date("m-d-Y", strtotime($temp_date));
            $temp_date = $currentObj->current_period_end;
            $end_date = date("m-d-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->first_name;
            $row[] = $currentObj->cutomer_email;
            $row[] = $currentObj->subscription_id;
            $row[] = $currentObj->customer_stripe_id;
            $row[] = $currentObj->plan_name;
            $row[] = $start_date;
            $row[] = $end_date;
            $row[] = $currentObj->status;
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/stripe_subscription/details/'.$currentObj->id.'" title="Details"><i class="fa fa-info"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'" title="Cancel" ><i class="fa fa-trash"></i></a>';
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->stripe_subcription_model->count_all(),
                        "recordsFiltered" => $this->stripe_subcription_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // Details ======================================================================
     public function details($id = NULL)
    {
        
        //exit;
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/stripe_subscription');
        }
        
        $data['detail'] = $this->stripe_subcription_model->find($id);
        
        // Subscription all list 
        $where = array();
        $where['customer_id'] = $data['detail']->customer_stripe_id;
        $data['detail_all'] = $this->stripe_all_subscription_model->findDynamic($where);
        
        // Charge all list
        $where = array();
        $where['customer_id'] = $data['detail']->customer_stripe_id;
        $data['detail_charge'] = $this->stripe_charge_model->findDynamic($where);

        
        $this->global['pageTitle'] = 'Zeno Strategics : Subscription Detail';
        $this->loadViews("admin/stripe_subscription/details", $this->global, $data , NULL);
    } 

     //Cancel  *****************************************************************
      function subscription_cancel()
    {
        $this->isLoggedIn();
        $cancel_id = $this->input->post('id');  


        // subscription details
        $where  = array();
        $where['id']  = $cancel_id;
        $temp_data = $this->stripe_subcription_model->findDynamic($where)  ;
        if(!empty($temp_data))
        {
            $subscription_data = $temp_data[0];
            if($subscription_data->status == 'canceled')
            {
                echo "Subscription Already Canceled";
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
                /*echo "<pre>";
                print_r($cancel_json);
                echo "</pre>";*/
                $update_data['id'] = $subscription_data->id;
                $update_data['canceled_at'] = date("Y-m-d H:i:s",$cancel_json['canceled_at']);
                $update_data['status'] = $cancel_json['status'];
                $result = $this->stripe_subcription_model->save($update_data);
                //echo "<h2><i>Subscription Successfully Canceled .</i></h2>";
                echo(json_encode(array('status'=>FALSE)));
            } 
        }
        else
        {
            echo $msg = "Please Select Subscription id ";
        }

       
    }

    // Add New 
    /*public function addnew()
    {
        $this->isLoggedIn();
        $data= array();
        // Get Member List
        $where  = array();
        $where['table']  = 'zs_members';
        $where['member_status']  = '1';
        $where['orderby']  = '-id';
        $member_data = $this->stripe_subcription_model->findDynamic($where)  ;
        foreach($member_data as $k =>$v)
        {
            $data['member_list'][$v->id] = $v->first_name." ".$v->last_name;  
        }
       
        // Get Plan List
        $where  = array();
        $where['table']  = 'zs_stripe_plan';
        $plan_data = $this->stripe_subcription_model->findDynamic($where)  ;
        foreach($plan_data as $k=>$v)
        {
            $data['plan_list'][$v->id] = $v->nickname." $".$v->amount;
        }
        
        $this->global['pageTitle'] = 'Zeno Strategics : Add New Member Subscription User';
        $this->loadViews("admin/stripe_subscription/addnew", $this->global, $data , NULL);
        
    } 

    // Ajax Get Member Details  ===============================================================
    public function get_member_detail()
    {
        // Get plan
        $where  = array();
        $where['id'] = $_GET['member'];
        $where['table'] = 'zs_members';
        $member_data = $this->stripe_plan_model->findDynamic($where) ;
        $member = $member_data[0];

        
        if(!empty($member))
        {
            $member_status = ($member->member_status=='1')?'Active':'Inactive';
            $temp_date = $member->member_at;
            $member_date = date("m-d-Y", strtotime($temp_date));
            echo $detail = '<div class="col-md-12">
                <h3>Member Details</h3>
            </div>    
            <div class="col-md-6">
                <p><b>First Name :</b> '.$member->first_name.'</p>
                <p><b>Last Name :</b> '.$member->last_name.'</p>
                <p><b>Email :</b> '.$member->email.'</p>
            </div>
            <div class="col-md-6">
                <p><b>Phone :</b> '.$member->phone.'</p>
                <p><b>Date :</b> '.$member_date.'</p>
                <p><b>Status :</b> '.$member_status.'</p>
                
            </div> ';
        }
       else{
        echo "<h3><i>Something Went Wrong</i></h3>";
       }
    }
    // Signup Form  ===============================================================
    public function strip_signup_form()
    {
        // Get plan
        $where  = array();
        $where['id'] = $_GET['member'];
        $where['table'] = 'zs_members';
        $member_data = $this->stripe_plan_model->findDynamic($where) ;
        $member = $member_data[0];

        // Get plan
        $where  = array();
        $where['id'] = $_GET['plan'];
        $plan_data = $this->stripe_plan_model->findDynamic($where) ;
        $plan = $plan_data[0];
        $plan_amount = $plan->amount*100;
        if(!empty($plan))
        {
            echo $form = '<form action="'.base_url().'admin/stripe_subscription/charge_subcription" method="post">
                <input type="hidden" name="plan_id" value="'.$where['id'].'"/>
                <input type="hidden" name="member_id" value="'.$_GET['member'].'"/>
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

    // Insert  *************************************************************
    // Subscription user signup
    public function charge_subcription()
    {
        $stripe = $this->stripe;
        \Stripe\Stripe::setApiKey($stripe['secret_key']); 
        

        try
        {
          // Plan details
            //$member_id  = $_POST['member_id'];
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
          echo "<pre>";
          print_r($subs_json);
          echo "</pre>";
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
*/

    

    
    
}

?>