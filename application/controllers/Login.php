<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Login extends CI_Controller
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

        $this->load->model('user_model');
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
      $this->load->model('order_model');
      // Onload Comon Page Data ============================= 
    	$data = array();
      $form = $this->input->post();
      if(isset($form) && !empty($form['orderId'])){
        // get user email by order id
        $tempId = explode('CMOD0001', strtoupper($form['orderId'])); 
        $where = array();
        $where['id'] = isset($tempId[1])?$tempId[1]:$tempId[0];
        $where['field'] = 'user_id';
        $rData = $this->order_model->findDynamic($where);



        // check email id 
        if(!empty($rData)){
          $where = array();
          $where['id'] = $rData[0]->user_id;
          $where['password'] = $form['password'];
          $where['orderby'] = '-id';
          $rData = $this->user_model->findDynamic($where);
          

        }if(empty($rData)){
          $data['alert'] = "Order ID Or Password mismatch!";
        }else{

          $where = array();
          $where['user_id'] = $rData[0]->id;
          $orderData = $this->order_model->findDynamic($where);
          if(!empty($orderData)){
            $stripeR = ($orderData[0]->cyogateresponse)?json_decode($orderData[0]->cyogateresponse):$orderData[0]->cyogateresponse;
            $customerId = $stripeR->customer;
            header("location:".base_url()."customer-portal/".$customerId);
            exit;
          }

          $data['success'] = "successfully login!";
        }
      }
       // Define =========================== 
       $data["title"]="Login";
       $data["file"]="front/login";
       $this->load->view('front/template',$data);
    } 


    // forget password =============================================================
    public function forgotpassword()
    {
      $this->load->model('order_model');
      // Onload Comon Page Data ============================= 
    
      $data = array();
      $form = $this->input->post();
      if(isset($form) && !empty($form['orderId'])){
        // get user email by order id
        $tempId = explode('CMOD0001', strtoupper($form['orderId'])); 
        $where = array();
        $where['id'] = isset($tempId[1])?$tempId[1]:$tempId[0];
        $where['field'] = 'user_id,email';
        $rData = $this->order_model->findDynamic($where);


        // check email id 
        if(!empty($rData)){
          $where = array();
          $where['id'] = $rData[0]->user_id;
          $where['orderby'] = '-id';
          $rData = $this->user_model->findDynamic($where);
        }  
        if(empty($rData)){
          $data['alert'] = "Order Id not exist.";
        }else{
          //pre($rData);
          $resetPasswordLink = base_url()."login/reset_password?c=98587653hyi686&u=".base64_encode($rData[0]->id)."&e=".base64_encode($rData[0]->email);
          // send email
          //$htmlContent = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Customer");
          $from = "support@rentech.site";
          // customer email sent 
          //===================================================================   
          $mail_to = $rData[0]->email;
          $subject = "Reset Your Password";
          $mailcontent = "Hi ".$rData[0]->fname."<br/>"; 
          $mailcontent .= "   Your Driver Repair 24x7 account reset password link is below.<br/><br/>"; 
          $mailcontent .= $resetPasswordLink; 
          // Set content-type header for sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: Reset Password'.'<'.$from.'>' . "\r\n";
          // Send email
          //$mailcontent = $userHeaderHtml.$htmlContent;
          if(mail($mail_to, $subject, $mailcontent, $headers)){
              $data['success'] =  'Successfully password recovery link sent on your register email address.';
          }else{
             $data['alert'] =  'Email sending failed.';
          }
          
        }
      }
       // Define =========================== 
       $data["title"]="Forgot Password";
       $data["file"]="front/forgot-password";
       $this->load->view('front/template',$data);
    } 


     // Reset Password =============================================================
    public function reset_password()
    {
      // Onload Comon Page Data ============================= 
      $data = array();
      $get = $this->input->get();
      if(isset($get) && !empty($get['u'])){
        // check email id 
        $where = array();
        $where['id'] = base64_decode($get['u']);
        $rData = $this->user_model->findDynamic($where);
        if(empty($rData)){
          $data['error'] = "Something Went Wrong!";
        }
      }


      $form = $this->input->post();
      if(isset($form) && !empty($form['password'])){
        if($form['password'] != $form['password2']  ){
          $data['alert'] = "Password mismatch!";
        }else{
           $insertData = array();
           $insertData['id'] = base64_decode($get['u']);
           $insertData['password'] = $form['password'];
            $insertData['dateat'] =  date("Y-m-d H:i:s");
            $userId = $this->user_model->save($insertData);
          $data['success'] = "Password successfully changed!";
        }
      }
       // Define =========================== 
       $data["title"]="Reset Password";
       $data["file"]="front/reset-password";
       $this->load->view('front/template',$data);
    } 

}

?>