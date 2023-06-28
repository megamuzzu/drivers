<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Receiptview  extends CI_Controller
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
      //$orderid = 80;
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
      // print_r($orderData)."<br/><br/>";
      // print_r($userData)."<br/><br/>";exit;

      //Mail Sendig Conditons *******************************
      //*******************************************************
      if($orderData->mailSentStatus != '330'){  //if($orderData->mailSentStatus == '0'){

        $userHeaderHtml = '<html>
        <head>
            <title>Email Receipt Preview - Drivers Fixer </title>
        </head>
        <body>';
        

        // set mail
        //echo $htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Customer");exit;

        $htmlContent = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Customer");
          echo $userHeaderHtml;
         echo $htmlContent; exit;
        

       // Define =========================== 
       $data['pdfTemplate'] = customer_order_mail($orderData,$productKeyData,$userData, $productData,"Customer");
       $data["title"]="Receiptview";
       $data["token"]= base64_encode($orderid);
       $data["productKeyData"]= $productKeyData;
       $data["menuHide"] = 1;
       $data["file"]="front/paymentsuccess";
       $this->load->view('front/template',$data);
    }

}
}

?>