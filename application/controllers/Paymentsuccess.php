<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Paymentsuccess extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/product_model');
        $this->load->model('order_model');
        $this->load->model('user_model');
        $this->load->model('productkey_model');
        $this->load->library('base_library');
        // Cookie helper
        $this->load->helper('cookie');
        $this->load->helper('mailtemplate_helper');
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
      // Onload Comon Page Data ============================= 
    	$data = array();
      
      $token = $this->input->get();
      if(!isset($token['token']))
      {
         echo "Something Went Wrong!";
         exit;
      }
      $orderid = base64_decode($token['token']);
      $tempProductData = $this->product_model->all();
      $productData = array();
      if(isset($tempProductData))
      foreach ($tempProductData as $k => $v) {
        $productData[$v->id]['name']  = base64_decode($v->name);
        $productData[$v->id]['price']  = $v->price;
        $productData[$v->id]['renewal']  = base64_decode($v->renewal);
        $productData[$v->id]['image']  = $v->image1;
      }
      $orderData = $this->order_model->find($orderid);
      $userData = $this->user_model->find($orderData->user_id);
      $where = array();
      $where['orderId'] = $orderid;
      $productKeyData = $this->productkey_model->findDynamic($where);
      

      $data['productData'] = $productData;
      $data['orderData'] = $orderData;
      $data['userData'] = $userData;
      // print_r($productData)."<br/><br/>";
      //pre($orderData)."<br/><br/>";exit;  
      // print_r($userData)."<br/><br/>";exit;

      //Mail Sendig Conditons *******************************
      //*******************************************************
      if($orderData->mailSentStatus == '0'){  //if($orderData->mailSentStatus == '0'){

        $userHeaderHtml = '<html>
        <head>
            <title>Driver driverrepair24x7 Order information </title>
        </head>
        <body>';
        

        // set mail
        //echo $htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Customer");exit;
        $htmlContent = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Customer");
        
        $from = "support@driverrepair24x7.com";
        // customer email sent 
        //===================================================================   
        $mail_to = $userData->email;
        $subject = "Driver Repair 24x7 Subscription Confirmation Order #SPRD".$orderData->id."."; 
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Order Confirmation'.'<'.$from.'>' . "\r\n";
        $headers .= 'Cc: support@driverrepair24x7.com'."\r\n";
        // Send email
        $mailcontent = $userHeaderHtml.$htmlContent;
        if(@mail($mail_to, $subject, $mailcontent, $headers)){
            //echo 'Email has sent successfully.';
        }else{
           echo 'Email sending failed.';
        }



        // admin Email 
        // =================================================================
        $mail_to ="support@driverrepair24x7.com";//support@driverrepair24x7.com
        $subject = "Driver Repair 24x7 New Order Successfully Placed."; 
        // Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Driver Repair 24x7 Order'.'<'.$from.'>' . "\r\n";
        $headers .= 'Cc: abbasdigitalmarket@gmail.com'."\r\n";

        // user header content
        $adminHeaderHtml = '<html>
          <head>
              <title>Driver Repair 24x7 Order information </title>
          </head>
          <body>';
        $htmlContent = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Admin");

        // echo $htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Admin");exit;
        $mailcontent = $adminHeaderHtml.$htmlContent;
        if(@mail($mail_to, $subject, $mailcontent, $headers)){
            //echo 'Email has sent successfully.';
           // update orderTable Mail Status
          $OrderUpdate = array();
          $OrderUpdate['id'] = $orderData->id;
          $OrderUpdate['mailSentStatus'] = 1;
          $this->order_model->save($OrderUpdate);
        }else{
           echo 'Email sending failed.';
        }




     
      }// customer and admin mail sending proccess end
      // Whene Send Again Button click user
      if(isset($token['resendMail']) && $token['resendMail'] == 1 )
      {
         $userHeaderHtml = '<html>
          <head>
              <title>Driver Repair 24x7 Order information </title>
          </head>
          <body>';


          // set mail
          //$htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Customer");
          $htmlContent = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Customer");
          $from = "support@driverrepair24x7.com";
          // customer email sent 
          //===================================================================   
          $mail_to = $userData->email;
          $subject = "Driver Repair 24x7 order confirmation for order number SPRD".$orderData->id."."; 
          // Set content-type header for sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: Order Confirmation'.'<'.$from.'>' . "\r\n"; 
          // Send email
          $mailcontent = $userHeaderHtml.$htmlContent;
          if(mail($mail_to, $subject, $mailcontent, $headers)){
              echo "sent";
          }else{
             echo "notSent";
          }
          exit;
      }


       // Define =========================== 
      
       $data["title"]="Payment Successfull";
       $data["token"]=$token['token'];
       $data["productKeyData"]= $productKeyData;
       $data["menuHide"] = 1;
       $data["page"] = "SuccessPage";
       $data["file"]="front/paymentsuccess";
       $this->load->view('front/template',$data);
    } 

}

?>