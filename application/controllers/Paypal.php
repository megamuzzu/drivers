<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @since : 15 November 2016
 */
class Paypal extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->load
            ->model('admin/product_model');
        $this
            ->load
            ->model('admin/payment_model');
        $this
            ->load
            ->model('order_model');
        $this
            ->load
            ->model('user_model');
        $this
            ->load
            ->model('productkey_model');
        $this
            ->load
            ->library('base_library');
        $this
            ->load
            ->library('paypal_lib');
        // Cookie helper
        $this
            ->load
            ->helper('cookie');
        $this
            ->load
            ->helper('mailtemplate_helper');
    }

    public function success()
    {

        $data = array();

        //get the transaction data
        $paypalInfo = $this
            ->input
            ->post();

        if (isset($paypalInfo['payment_status']) && $paypalInfo['payment_status'] == 'Completed')
        {

            $userid_with_orderid = explode("#_", $paypalInfo['custom']);

            $userid = $userid_with_orderid[0];
            $orderid = $userid_with_orderid[1];
            $where = array();
            $where['id'] = $orderid;
            $transaction = $this
                ->order_model
                ->findDynamic($where);

            if (!empty($transaction))
            {

                $data = [];
                $data['id'] = $orderid;
                $data['user_id'] = $userid;

                $data['transaction_id'] = $paypalInfo["txn_id"];
                $data['amount']       = $paypalInfo["mc_gross"];
                $data['currency'] = $paypalInfo["mc_currency"];
                $data['pay_status'] = $paypalInfo["payment_status"];
                $data['date_at'] = date("Y-m-d H:i:s");
                $data['mailSentStatus'] = 0;
                $data['dataset'] = json_encode($paypalInfo);

                $this
                    ->order_model
                    ->save($data);
                $this->ipn();

                $aaarary = [];
                $aaarary['transaction_id'] = $paypalInfo["txn_id"];
                $aaarary['user_id'] = $userid;

                $description = $this
                    ->order_model
                    ->get_order_with_template($aaarary);
                $data["mailed_template"] = $description;
                $this
                    ->load
                    ->library('email');
                $config['mailtype'] = 'html';
                $this
                    ->email
                    ->initialize($config);
                  $toemail = $transaction[0]->email;
                /*$toemail = 'anilkumarm309@gmail.com';*/
                 /*$toemail = 'abbasdigitalmarket@gmail.com';*/
                $this
                    ->email
                    ->from('support@megatasktechnologies.com', 'New Lead');
                $this
                    ->email
                    ->to($toemail);

                $this
                    ->email
                    ->subject('New Order booking on Driver Repair 24x7 ');
                $this
                    ->email
                    ->message($description);

                $resulst = @$this
                    ->email
                    ->send();

                if ($resulst > 0)
                {

                    $this
                        ->session
                        ->set_flashdata('success', 'Email Successfully Send');

                }
                else
                {

                    $this
                        ->session
                        ->set_flashdata('error', 'Email Not Send Successfully Send');
                }

            }

            $where = array();
            $where['transaction_id'] = $paypalInfo["txn_id"];
            $orderData = $this
                ->order_model
                ->findDynamic($where);

            $data["productData"] = $paypalInfo;
            $data["orderData"] = $orderData[0];
            $data["title"] = "Payment Success";
            $data["file"] = "front/paymentsuccess";

            $this
                ->load
                ->view('front/template', $data);
        }
        else
        {
            $data["title"] = "Payment Failed";
            $data["file"] = "front/paymentfailed";
            $this
                ->load
                ->view('front/template', $data);
        }

    }
    public function fail()
    {

        $data["title"] = "Payment Failed";
        $data["file"] = "front/paymentfailed";
        $this
            ->load
            ->view('front/template', $data);
    }
    public function ipn()
    {
        //paypal return transaction details array
        $paypalInfo = $this
            ->input
            ->post();

        $where = array();
        $where['txn_id'] = $paypalInfo["txn_id"];
        $transaction = $this
            ->payment_model
            ->findDynamic($where);

        /* echo "<pre>";
        print_r($paypalInfo);
        echo "</pre>";*/

        if (empty($transaction))
        {
            $data['user_id'] = $paypalInfo['custom'];
            $data['item_id'] = $paypalInfo["item_number"];
            $data['txn_id'] = $paypalInfo["txn_id"];
            $data['payment_gross'] = $paypalInfo["mc_gross"];
            $data['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status'] = $paypalInfo["payment_status"];
            $data['dataset'] = json_encode($paypalInfo);

            $paypalURL = $this
                ->paypal_lib->paypal_url;
            $result = $this
                ->paypal_lib
                ->curlPost($paypalURL, $paypalInfo);

            $this
                ->payment_model
                ->save($data);
            //check whether the payment is verified
            if (preg_match("/VERIFIED/i", $result))
            {
                //insert the transaction data into the database
                
            }
        }

    }

    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
        // Onload Comon Page Data =============================
        $data = array();

        $token = $this
            ->input
            ->get();
        if (!isset($token['token']))
        {
            echo "Something Went Wrong!";
            exit;
        }
        $orderid = base64_decode($token['token']);
        $tempProductData = $this
            ->product_model
            ->all();
        $productData = array();
        if (isset($tempProductData)) foreach ($tempProductData as $k => $v)
        {
            $productData[$v->id]['name'] = base64_decode($v->name);
            $productData[$v->id]['price'] = $v->price;
            $productData[$v->id]['renewal'] = base64_decode($v->renewal);
            $productData[$v->id]['image'] = $v->image1;
        }
        $orderData = $this
            ->order_model
            ->find($orderid);
        $userData = $this
            ->user_model
            ->find($orderData->user_id);
        $where = array();
        $where['orderId'] = $orderid;
        $productKeyData = $this
            ->productkey_model
            ->findDynamic($where);

        $data['productData'] = $productData;
        $data['orderData'] = $orderData;
        $data['userData'] = $userData;
        // print_r($productData)."<br/><br/>";
        //pre($orderData)."<br/><br/>";exit;
        // print_r($userData)."<br/><br/>";exit;
        //Mail Sendig Conditons *******************************
        //*******************************************************
        if ($orderData->mailSentStatus == '0')
        { //if($orderData->mailSentStatus == '0'){
            $userHeaderHtml = '<html>
        <head>
            <title>Driver Repair 24x7 Order information </title>
        </head>
        <body>';

            // set mail
            //echo $htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Customer");exit;
            $htmlContent = customer_order_mail($orderData, $productKeyData, $userData, $productData, "Customer");
            $from = "support@driverrepair24x7.com";
            // customer email sent
            //===================================================================
            $mail_to = $userData->email;
            $subject = "Driver Repair 24x7 subscription confirmation order #CMOD0001" . $orderData->id . ".";
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Order Confirmation' . '<' . $from . '>' . "\r\n";
            $headers .= 'Cc: abbasdigitalmarket@gmail.com' . "\r\n";
            // Send email
            $mailcontent = $userHeaderHtml . $htmlContent;
            if (mail($mail_to, $subject, $mailcontent, $headers))
            {
                //echo 'Email has sent successfully.';
                
            }
            else
            {
                //echo 'Email sending failed.';
                
            }

            // admin Email
            // =================================================================
            $mail_to = "support@driverrepair24x7.com"; //support@driverrepair24x7.com
            $subject = "Driver Repair 24x7 New Order Successfully Placed.";
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Driver Repair 24x7 Order' . '<' . $from . '>' . "\r\n";
            //$headers .= 'Cc: abbasdigitalmarket@gmail.com'."\r\n";
            //$headers .= 'From: abbasdigitalmarket@gmail.com' . "\r\n";
            // Additional headers
            //$headers .= 'From: Driver Repair 24x7'.'<'.$from.'>' . "\r\n";
            // $headers .= 'Cc: welcome@example.com' . "\r\n";
            // $headers .= 'Bcc: welcome2@example.com' . "\r\n";
            

            // user header content
            $adminHeaderHtml = '<html>
          <head>
              <title>Driver Repair 24x7 Order information </title>
          </head>
          <body>';
            $htmlContent = customer_order_mail($orderData, $productKeyData, $userData, $productData, "Admin");
            // echo $htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Admin");exit;
            $mailcontent = $adminHeaderHtml . $htmlContent;
            if (mail($mail_to, $subject, $mailcontent, $headers))
            {
                //echo 'Email has sent successfully.';
                // update orderTable Mail Status
                $OrderUpdate = array();
                $OrderUpdate['id'] = $orderData->id;
                $OrderUpdate['mailSentStatus'] = 1;
                $this
                    ->order_model
                    ->save($OrderUpdate);
            }
            else
            {
                echo 'Email sending failed.';
            }

        } // customer and admin mail sending proccess end
        // Whene Send Again Button click user
        if (isset($token['resendMail']) && $token['resendMail'] == 1)
        {
            $userHeaderHtml = '<html>
          <head>
              <title>Driver Repair 24x7 Order information </title>
          </head>
          <body>';

            // set mail
            //$htmlContent = mailTemplate($orderData, $userData, $productData,$productKeyData,"Customer");
            $htmlContent = customer_order_mail($orderData, $productKeyData, $userData, $productData, "Customer");
            $from = "support@driverrepair24x7.com";
            // customer email sent
            //===================================================================
            $mail_to = $userData->email;
            $subject = "Driver Repair 24x7 order confirmation for order number CMOD0001" . $orderData->id . ".";
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Order Confirmation' . '<' . $from . '>' . "\r\n";
            // Send email
            $mailcontent = $userHeaderHtml . $htmlContent;
            if (mail($mail_to, $subject, $mailcontent, $headers))
            {
                echo "sent";
            }
            else
            {
                echo "notSent";
            }
            exit;
        }

        // Define ===========================
        $data["title"] = "Payment Successfull";
        $data["token"] = $token['token'];
        $data["productKeyData"] = $productKeyData;
        $data["menuHide"] = 1;
        $data["page"] = "SuccessPage";
        $data["file"] = "front/paymentsuccess";
        $this
            ->load
            ->view('front/template', $data);
    }

}

?>
