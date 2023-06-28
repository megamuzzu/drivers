<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/stripe-php-6.4.1/init.php';
/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Stripe_plan extends BaseController
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
        $this->global['pageTitle'] = 'Zeno Strategics : Stripe Plan';
        $this->loadViews("admin/stripe_plan/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();

        // =================================
        $where = array();
        $where['service_status'] = '1';
        $where['field'] = 'id,service_name,service_price';
        $data['service_list'] = $this->services_model->findDynamic($where);
        

        $this->global['pageTitle'] = 'Zeno Strategics : Add New Stripe';
        $this->loadViews("admin/stripe_plan/addnew", $this->global, $data , NULL);
        
    } 

    // Insert  *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('service_id','Service Id','trim|required');
        $this->form_validation->set_rules('product_name','Product Name','trim|required');
        $this->form_validation->set_rules('nickname','NickName','trim|required');
        $this->form_validation->set_rules('amount','Amount','trim|required');
        $this->form_validation->set_rules('interval','interval','trim');
        $this->form_validation->set_rules('currency','Currency','trim');
       
        //form data 
        $form_data  = $this->input->post();
        $amount = $form_data['amount']*100;
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            
            // Insert stripe plan
            $stripe = $this->stripe;
            \Stripe\Stripe::setApiKey($stripe['secret_key']);
            try {
                    $plan = \Stripe\Plan::create([
                      'product' => array('name' => $form_data['product_name']),
                      'nickname' => $form_data['nickname'],
                      'interval' => $form_data['interval'],
                      'currency' => $form_data['currency'],
                      'amount' => $amount,
                    ]);
                    
                    $planjson = $plan->jsonSerialize();
                }
                 catch(Exception $e) {
                    $alert_msg = 'Message: ' .$e->getMessage();
                 }     

           

            if(isset($planjson))
            {
                $insertData['plan_id'] = $planjson['id'];
                $insertData['service_id'] = $form_data['service_id'];
                $insertData['product_name'] = $planjson['product'];
                $insertData['nickname'] = $planjson['nickname'];
                $insertData['amount'] = $planjson['amount']/100;
                $insertData['currency'] = $planjson['currency'];
                $insertData['plan_interval'] = $planjson['interval'];
                $insertData['interval_count'] = $planjson['interval_count'];
                $insertData['created'] = date('Y-m-d H:i:s', $planjson['created']) ;
                $result = $this->stripe_plan_model->save($insertData);
            }    

            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Stripe plan successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Stripe Plan Addition failed : '.$alert_msg );
            }
            redirect('admin/stripe_plan/addnew');
          }  
        
    }


    // Ajax list
    public function ajax_list()
    {
        $list = $this->stripe_plan_model->get_datatables();
       
        $data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->created;
            $created = date("m-d-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->plan_id;
            $row[] = $currentObj->product_name;
            $row[] = $currentObj->nickname;
            $row[] = $currentObj->amount;
            $row[] = $currentObj->currency;
            $row[] = $currentObj->plan_interval;
            //$row[] = $member_at;
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->stripe_plan_model->count_all(),
                        "recordsFiltered" => $this->stripe_plan_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    
    
}

?>