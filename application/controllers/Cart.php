<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*require APPPATH . '/libraries/BaseController.php';*/
//require APPPATH . '../assets/stripe-php-6.4.1/init.php';
require APPPATH . '../assets/stripe-php-master/init.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Cart extends CI_Controller
{
    public $stripe;
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/product_model');
        $this->load->model('front/shipping_address_model');
        $this->load->model('user_model');
        
        $this->load->model('order_model');
        $this->load->model('productkey_model');
        $this->load->model('cyogate_model');
        $this->load->library('base_library');
        $this->load->library('Syogate_library');
                $this->load->library('paypal_lib');

        /*Cookie helper*/
        $this->load->helper('cookie');


         $this->stripe = array(
          "secret_key"      => $this->config->item('secret_key'),
          "publishable_key" => $this->config->item('publishable_key'),
          "price_key1"      => $this->config->item('price_key1'),
          "price_key2"      => $this->config->item('price_key2'),
          "price_key_yearly"=> $this->config->item('price_key_yearly'),
        );
     }



    /**
     * Index Page for this controller.
     */
     public function index()
    {


    /*  $aaarary = [];
      $aaarary['transaction_id'] ='5VV75129MY231325T';
      $aaarary['user_id'] = '3';


  $this->order_model->get_order_with_template($aaarary);*/
     
 

      $this->load->model('country_model');
      $this->load->model('states_model');

      $country = $this->country_model->all();

      $states = $this->states_model->all();
      


      /*Onload Comon Page Data ============================= */
      $data = array();

      /*products data*/
      $data = array();
      $data['stripe'] =  $this->stripe;
      
      $data['ProductList'] = $this->product_model->all();
      /*print_r($data['ProductList']);*/

      /*Define =========================== */
      foreach ($country as $key => $value) {
        $data["country"][$value->id]=$value;
      }
      foreach ($states as $key => $value) {
        $data["states"][$value->countryId][$value->id]=$value->name;
      }
      /*pre($data["states"]);exit;*/
       $data["statesList"] = isset($data["states"])?json_encode($data["states"]):'';
       $data["title"]="Cart";
       $data["file"]="front/cart";
       $this->load->view('front/template',$data);
    }


    /*get StateList*/
    public function getstates(){

      if(isset($_POST['id']) && !empty($_POST['id'])){
        $this->load->model('states_model');
        $where = array();
        $where['countryId'] = $_POST['id'];
        $rData = $this->states_model->findDynamic($where);

        echo  json_encode($rData,true);
      }
    }



   
  public function paypalPayment(){

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');


    
    $fData   = $this->input->post();
   
      $this->form_validation->set_rules('planCheckBox[]', 'Select An Product', 'required');
      $this->form_validation->set_rules('firstname', 'firstname', 'required');
      $this->form_validation->set_rules('lastname', 'lastname', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('email2', 'Confirmation Email', 'required|matches[email]');

      $this->form_validation->set_rules('countryCode', 'countryCode', 'required');
      $this->form_validation->set_rules('phone', 'phone', 'required');
      $this->form_validation->set_rules('street', 'street', 'required');
      $this->form_validation->set_rules('country', 'country', 'required');
      $this->form_validation->set_rules('state', 'state', 'required');
      $this->form_validation->set_rules('city', 'city', 'required');
      $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
      $this->form_validation->set_rules('terms', 'terms', 'required');
      $this->form_validation->set_rules('card_number', 'card_number', 'required');
      $this->form_validation->set_rules('card_exp_month', 'card_exp_month', 'required');
      $this->form_validation->set_rules('card_exp_year', 'card_exp_year', 'required');
      $this->form_validation->set_rules('card_cvc', 'card_cvc', 'required');


      $vis_ip = getVisIPAddr(); 

      if ($this->form_validation->run() == FALSE)
      {
        return $this->index();
      }
      else
      {

        $emailid = strtolower($fData['email']);

        /* chaeck for user*/
        $where = array();
        $where['email']     = $emailid;
        $check_user        = $this->user_model->findDynamic($where);
        /* chaeck for user*/


        /* if exist get user */
        if(!empty($check_user))
        {
            $userID = $check_user[0]->id;
        }else
        {

          /*Store the IP address */


            /* else insert one  start */
              $inserData['device_ip']       =  $vis_ip;
              $inserData['firstname']       =  $fData['firstname'];
              $inserData['lastname']        =  $fData['lastname'];
              $inserData['email']           =  $fData['email'];
              $inserData['mobile']          =  $fData['phone'];
              $inserData['password']        =  $fData['email'];
              $inserData['status']          = '0';
              $inserData['date_at']              = date("Y-m-d H:i:s");
               

              $userID = $this->user_model->save($inserData);
              /* else insert one end */
              
        }




        /*  create order number one (random) */
            $order_number = md5(uniqid(rand(), true));



        $product_id   = $fData['planCheckBox'];
        $no_item      = $fData['no_item'];
        $no_items     = $fData['no_item'];
        
 
         $products = [];
         $amount = 0;
         $inc = 0;
         foreach ($product_id as $key => $value)
         {
              $product = $this->product_model->find( $value );
               
              $products['qty'][] =  $no_items[$value];
              $products['id'][] =  $product->id;
              $products['price'][] =  $product->price;

              $amount = $amount +($no_items[$value]*$product->price);


        } 

 
 


 

 /*start insert to order table  for new  Order*/
      $inserData  = array();
      $inserData['user_id']       =   $userID ;
      $inserData['order_number'] =  $userID.''.$order_number;
      $inserData['firstname']       =  $fData['firstname'];
      $inserData['lastname']       =  $fData['lastname'];
      $inserData['email']        =  $fData['email'];
      $inserData['country_code'] = $fData['countryCode'];
      $inserData['phone']        =  $fData['phone'];
      $inserData['country']      =  $fData['country'];

      $inserData['state']        =  $fData['state'];
      $inserData['city']         =  $fData['city'];
      $inserData['zipcode']     =  $fData['zipcode'];
      $inserData['ipn_track_id']      =  $vis_ip;
      $inserData['pay_status']     =  'incomplete';
      $inserData['payment_method']     =  'Paypal';
      $inserData['currency']     =  'USD';
      $inserData['products']     =  json_encode($products);
      $inserData['transaction_id']     =  '';
       
      $inserData['card_number']   =  $fData['card_number'];
      $inserData['card_exp_month']=  $fData['card_exp_month'];
      $inserData['card_exp_year']=  $fData['card_exp_year'];
      $inserData['card_cvc']=  $fData['card_cvc'];

      $inserData['status']       = '1';
      $inserData['date_at']      = date("Y-m-d H:i:s");
      $orderid = $this->order_model->save($inserData);


      $custom   =  $userID ."#_".$orderid;
/*end insert to order table  for new  Order*/






   
    
      $returnURL  = base_url().'paypal/success'; /*//payment success url*/
      $failURL    = base_url().'paypal/fail'; /*//payment fail url*/
      $notifyURL  = base_url().'paypal/ipn'; /*//ipn url*/
      $logo       = base_url().'assets/images/logo-1.png';


         


 


        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('fail_return', $failURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', "Driver Repair 24x7 Driver");
        $this->paypal_lib->add_field('custom', $custom);
        $this->paypal_lib->add_field('item_number', 0);
        $this->paypal_lib->add_field('amount',   $amount);        
               
        $this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
      }



 




     
  }

 public function stripe(){
        date_default_timezone_set('Asia/Kolkata');
        $formData = $_POST;
     
        if(!isset($_POST['stripeToken']))
        {
          $this->session->set_flashdata('error', 'Error :Token Generation Failed, Retry ');
          redirect('cart');
          exit;
        }
        // PHONE NUMBER CONCATINATE
        if(isset($formData['countryCode']))
        $formData['phone'] = $formData['countryCode'].$formData['phone'];

        // Retrieve stripe token, card and user info from the submitted form data 
        $token  = $_POST['stripeToken']; 
        $name =  $_POST['firstname']." ".$_POST['lastname']; 
        $email = $_POST['email']; 
        $card_number = preg_replace('/\s+/', '', $_POST['card_number']); 
        $card_exp_month = $_POST['card_exp_month']; 
        $card_exp_year = $_POST['card_exp_year']; 
        $card_cvc = $_POST['card_cvc']; 
         
        // Plan info 
        $planID = 1; 
        $planName = "Driver Repair 24x7 Updator Plan"; 
        $planPrice = $formData['totalammount']; //USD
        $planInterval = 'month'; 

         $stripe = $this->stripe;
         


        \Stripe\Stripe::setApiKey($stripe['secret_key']); 

         // Add customer to stripe 
        $customer = \Stripe\Customer::create(array( 
            'email' => $email, 
            'source'  => $token 
        ));

        // update Customer details 
        $customer2 = \Stripe\Customer::update(
        $customer->id,
         ['address' =>['city' => $formData['city'],'country' => $formData['country'],'line1' => $formData['street'],'postal_code' => $formData['zipcode'],'state' => $formData['state']],['phone' =>$formData['phone'],'name' =>$formData['firstname'].$formData['lastname']]]
         
        );

        // Convert price to cents 
        $priceCents = round($planPrice*100);
         
         // Create a plan 
       
        

        //if(empty($api_error) && $plan){ 
        // diffrent diffrent plan
        // if($formData['planCheckBox'] == 2){
        //   // Creates a new subscription (For only $14.99 Yearly Subscription )
        //   try { 
        //       $subscription = \Stripe\Subscription::create([
        //         'customer' => $customer->id,
        //         'items' => [
        //             [
        //                 'price' => $stripe['price_key_yearly'],
        //             ],
        //         ],
                  
        //       ]);
        //   }catch(Exception $e) { 
        //       $api_error = $e->getMessage(); 
        //   }
        // }else{  // Creates a new subscription ( for 17.99 monthly subscription)
          try { 
              $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => $stripe['price_key1'],
                    ],
                ],
                  // 'add_invoice_items' => [[
                  //   'price' => $stripe['price_key1'],
                  // ]],
              ]);
          }catch(Exception $e) { 
              $api_error = $e->getMessage(); 
          }
        //} 

        if(empty($api_error) && $subscription){ 
            // Retrieve subscription data 
            $chargejson = $subscription->jsonSerialize();
            
            if($chargejson['status'] == 'incomplete'){  // if subscription Status incomplete
              $this->session->set_flashdata('error', 'Subscription Incomplete, Please Try again.');
            }else{

                $insertData = array();
                // insert User
                $insertData['fname'] = $formData['firstname'];
                $insertData['lname'] = $formData['lastname'];
                $insertData['email'] = $formData['email'];
                
                if(isset($formData['phone']))
                $insertData['phone'] = $formData['phone'];

                $insertData['street'] = $formData['street'];
                $insertData['state'] = $formData['state'];
                $insertData['city'] = $formData['city'];
                $insertData['country'] = $formData['country'];
                $insertData['zipcode'] = $formData['zipcode'];
                $insertData['password'] = 'Driver**^%56';
                $insertData['dateat'] =  date("Y-m-d H:i:s");
                $userId = $this->user_model->save($insertData);
                if($userId > 0)
                {
                    $this->session->set_flashdata('success', 'User Successfully Added');
                }else{ 
                          $this->session->set_flashdata('error', 'User Addition failed');
                      }
                
                // Order Table Updation
                $productList  = array();
                /*$productList['product'] = array($formData['planCheckBox'] => $formData['product'][$formData['planCheckBox']]);
                //echo $productList['product']  = $formData['product']; // planCheckBox
                $productList['renewal']  = 'Subscription';//$formData['renewal'];
                //$productList['no_item']  = $formData['no_item'];
                $productList['no_item'] = array($formData['planCheckBox'] => $formData['no_item'][$formData['planCheckBox']]);
                $productList['auto_renewal'] = array($formData['auto_renewal'] => $formData['auto_renewal'][$formData['planCheckBox']]);*/
                $product = json_encode($productList); 


                  $total_product = $formData['planCheckBox'];

                   
                   $producrtArr = array();
                  $incre = 1; 
                  foreach ($total_product as $key => $value)
                  {
                    $producrtArr[$incre]['product_id']  = $formData['product'][$key];
                    $producrtArr[$incre]['no_item']     = $formData['no_item'][$key];
                    $producrtArr[$incre]['price']       = $formData['item_prices'][$key];
                    $producrtArr[$incre]['renewal']     = 'Subscription';
                    $producrtArr[$incre]['auto_renewal']     = (isset($formData['auto_renewal'][$key]))?$formData['auto_renewal'][$key]:'0'; 
                    $producrtArr[$incre]['product']     = $formData['product'][$key];

                    $incre++;
                  }



                $insertOrder = array();
                $insertOrder['user_id'] = $userId;
                $insertOrder['fname'] = $formData['firstname'];
                $insertOrder['lname'] = $formData['lastname'];
                $insertOrder['phone'] = $formData['phone'];
                 $insertOrder['products'] = json_encode($producrtArr);;
                $insertOrder['amount'] = (isset($formData['totalammount']))?$formData['totalammount']:'';
                $insertOrder['item'] = json_encode($formData['no_item']);
                $insertOrder['payment_method'] = 'Stipe Subscription';
                $insertOrder['currency'] = 'USD';
                $insertOrder['pay_status'] = $chargejson['status'];
                $insertOrder['cyogateresponse'] = json_encode($chargejson,true);
                $insertOrder['cyoTid'] = $chargejson['id'];
                $insertOrder['date_at'] = date('Y-m-d H:i:s');
                $insertOrder['update_at'] = date('Y-m-d H:i:s');
                $insertOrder['email'] =  $formData['email'] ;
                $insertOrder['street'] =  $formData['street'];
                $insertOrder['state'] =  $formData['state'];
                $insertOrder['city'] =  $formData['city'];
                $insertOrder['country'] =  $formData['country'];
                $insertOrder['zipcode'] =  $formData['zipcode'];
                
                $orderId = $this->order_model->save($insertOrder);

                // Insert productkey table
                  // product key
                  //$tempProKey = getActivationKay(16);

                  //Get  Product Key 
                $where = array();
                $where['orderId']  = " ";
                $where['limit']  = "1";
                $productKeyDbData = $this->productkey_model->findDynamic($where);
                if(empty($productKeyDbData))
                {
                   $productKey = "N";
                }else{
                  $productKey = $productKeyDbData[0]->productKey;
                  $productId  = $productKeyDbData[0]->id;
                }


                  // Update and insert product key
                  $totalItem = 0;
                  foreach($formData['no_item'] as $v)
                  {
                    $totalItem = $totalItem+$v;
                  }
                  $i =1;
                  while($totalItem >= $i)
                  {
                    $insertKey = array();
                    if(isset($productId))
                    {
                      $insertKey['id'] = $productId;  
                    }
                    $insertKey['orderId'] = $orderId;
                    $insertKey['productKey'] = $productKey;
                    $insertKey['status'] = 1;
                    $insertKey['dateat'] = date("Y-m-d H:i:s");
                    $insertKey['expdate'] = date('Y-m-d', strtotime('+1 years'));
                    $this->productkey_model->save($insertKey);
                    $i++;  
             }
              $url = base_url()."paymentsuccess?token=".base64_encode($orderId);
              header("Location:".$url);
              exit;


              $this->session->set_flashdata('success', 'Successfull Order');
            }// End Condition payment status incomplete status 
          }// End Conditios (empty($api_error) && $subscription){ 
         /*}*/else{
            $this->session->set_flashdata('error', 'Error on form submission, please try again.'.$api_error);
         }
        redirect('cart');

     
      
    }





     // cygate payament============================================================================
    public function cygatePayment(){

     // check activation key
    /*function checkUniqKey($tempProKey){
        $CI = &get_instance();
        $where  = array();
        $where['productKey']  = $tempProKey;
        $getData  = $CI->productkey_model->findDynamic($where); 
        if(!empty($getData))
        {
          checkUniqKey($tempProKey);
        }else{
          return $tempProKey;  
        }
      }     
    */
      
      // Assign Order Id
      $where = array();
      $where['field']  = "id";
      $where['orderby']  = "-id";
      $where['limit']  = "1";
      $orderDbData = $this->order_model->findDynamic($where);
      $lastOrderId = (empty($orderDbData))?1:($orderDbData[0]->id)+1;

      $formData  = $this->input->post();
      
     
      


      // cyogate XML Generate =============================================
      $gw = new Syogate_library;
      //$gw->setLogin("demo", "password");// Test Mode
      
      $gw->setLogin("6457Thfj624V5r7WUwc5v6a68Zsd6YEm"); // TEST Mode
      //$gw->setLogin("WV2F4d52dv8rmzat4p2RMR3VCM7V9Y95"); // Live (Not in use But Working Key) Mode

      //$gw->setLogin("gV764cD2wUzhJx27SaQm52b7m3E5cCA3"); // Live Mode
      $gw->setBilling($formData['firstname'],$formData['lastname'],"companyname",$formData['street']," ", $formData['city'],
              $formData['state'],$formData['zipcode'],$formData['country'],"","",$formData['email'],
              "www.example.com");
      $gw->setShipping($formData['firstname'],$formData['lastname'],"na",$formData['street'],"", $formData['city'],
              $formData['state'],$formData['zipcode'],$formData['country'],$formData['email']);
      $gw->setOrder($lastOrderId,"driverfixer updator",1, 2, "PO1234","65.192.14.10");

      $r = $gw->doSale($formData['totalammount'],$formData['card_number'],$formData['billing-cc-exp'],$formData['cvv']);//"4111111111111111   1010"
      // echo "<pre>";
      // echo "totalAmmount : ".$formData['totalammount']."<br/>";
      // print_r($gw->responses) ;exit;
     $response = $gw->responses['responsetext'];
     $transactionid = $gw->responses['transactionid'];
     $syogateresponse = json_encode($gw->responses,true);

     // if success
     if($response == 'Approved' OR $response == 'SUCCESS')
     {

        $insertData = array();
        // insert User
        $insertData['fname'] = $formData['firstname'];
        $insertData['lname'] = $formData['lastname'];
        $insertData['email'] = $formData['email'];
        $insertData['street'] = $formData['street'];
        $insertData['state'] = $formData['state'];
        $insertData['city'] = $formData['city'];
        $insertData['country'] = $formData['country'];
        $insertData['zipcode'] = $formData['zipcode'];
        $insertData['password'] = 'sapp**^%896';
        $insertData['dateat'] =  date("Y-m-d H:i:s");
        $userId = $this->user_model->save($insertData);
        if($userId > 0)
        {
            $this->session->set_flashdata('success', 'User Successfully Added');
        }else{ 
                  $this->session->set_flashdata('error', 'User Addition failed');
              }
        
        // Order Table Updation
        $productList  = array();
        $productList['product']  = $formData['product'];
        $productList['renewal']  = $formData['renewal'];
        $productList['no_item']  = $formData['no_item'];
        $product = json_encode($productList);     

        $insertOrder = array();
        $insertOrder['user_id'] = $userId;
        $insertOrder['products'] = $product;
        $insertOrder['amount'] = (isset($formData['totalammount']))?$formData['totalammount']:'';
        $insertOrder['item'] = json_encode($formData['no_item']);
        $insertOrder['payment_method'] = 'Cyogate';
        $insertOrder['currency'] = 'currency';
        $insertOrder['pay_status'] = $response;
        $insertOrder['cyogateresponse'] = $syogateresponse;
        $insertOrder['cyoTid'] = $transactionid;
        $insertOrder['date_at'] = date('Y-m-d H:i:s');
        $insertOrder['update_at'] = date('Y-m-d H:i:s');
        $insertOrder['email'] =  $formData['email'] ;
        $insertOrder['street'] =  $formData['street'];
        $insertOrder['state'] =  $formData['state'];
        $insertOrder['city'] =  $formData['city'];
        $insertOrder['country'] =  $formData['country'];
        $insertOrder['zipcode'] =  $formData['zipcode'];
        
        $orderId = $this->order_model->save($insertOrder);

        // Insert productkey table
          // product key
          //$tempProKey = getActivationKay(16);

          //Get  Product Key 
        $where = array();
        $where['orderId']  = " ";
        $where['limit']  = "1";
        $productKeyDbData = $this->productkey_model->findDynamic($where);
        if(empty($productKeyDbData))
        {
           $productKey = "N";
        }else{
          $productKey = $productKeyDbData[0]->productKey;
          $productId  = $productKeyDbData[0]->id;
        }


          // Update and insert product key
          $totalItem = 0;
          foreach($formData['no_item'] as $v)
          {
            $totalItem = $totalItem+$v;
          }
          $i =1;
          while($totalItem >= $i)
          {
            $insertKey = array();
            if(isset($productId))
            {
              $insertKey['id'] = $productId;  
            }
            $insertKey['orderId'] = $orderId;
            $insertKey['productKey'] = $productKey;
            $insertKey['status'] = 1;
            $insertKey['dateat'] = date("Y-m-d H:i:s");
            $insertKey['expdate'] = date('Y-m-d', strtotime('+1 years'));
            $this->productkey_model->save($insertKey);
            $i++;  
          }

        // header location 
        ob_start();  
        $url = base_url()."paymentsuccess?token=".base64_encode($orderId);
        header("Location:".$url);
       exit;


        $this->session->set_flashdata('success', 'Successfull Order');
     }else{
        $this->session->set_flashdata('error', 'Error : '.$response);
     }
     redirect('cart');

     
      
    }
 



   

}

?>