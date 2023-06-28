
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


 // customer mail template
 function customer_order_mail($orderData,$productKeyData,$userData, $productData,$userType){
    $cardData = json_decode($orderData->cyogateresponse,true);
    $cardBrand = isset($cardData['payment_method_details']['card']['brand'])?$cardData['payment_method_details']['card']['brand']:'';
    $last4     = isset($cardData['payment_method_details']['card']['last4'])?$cardData['payment_method_details']['card']['last4']:'';
    // product
    $productarray = json_decode($orderData->products,true);


    $productType = isset($productarray[1]['product'])?'<small>(Monthly Subscription)</small>':'<small>(Annual Subscription)</small>';
     
    $autorenewal = ($productarray[1]['renewal'] == "on")?" <br/><small>(Automatic Renewal at $29.00 after the first year.)</small> ":'';
    // product key 
    $licenceKey = ($productKeyData[0]->productKey == "N")?"Contact Our Customer : (+1) 945-217-7400.":$productKeyData[0]->productKey;
    $adminSection = '';
    if($userType == "Admin")
    {
      //
      $phone = isset($userData->phone)?$userData->phone:'-';
      $adminSection = '<table border="0" align="center" width="85%" cellpadding="10" cellspacing="0" style="background: #fff2f2; " >
   <tr align="left">
      <th align="" >
         <h5 style=" font-weight: 700; margin: 0 11px -12px 0px; 
            font-size: 17px; color: #333; font-family: arial,sans-serif;">Hi, Admin</h5>
      </th>
   </tr>
   <tr align="left">
      <td align="" >
         <p style=" font-weight: 600; margin: 0 11px -12px 0px; 
            font-size: 14px; color: #4d4d4d; font-family: arial,sans-serif;"> Driver Repair 24x7 New Customer Order.</p>
      </td>
   </tr>
   <tr align="left">
      <td align="" >
         <div style="margin-bottom:30px" >
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 16px; color: #4d4d4d; font-family: arial,sans-serif;">'.$userData->fname.' '.$userData->lname.'
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 16px; color: #4d4d4d; font-family: arial,sans-serif;">'.$orderData->street.', '.$orderData->city.', '.$orderData->state.' 
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 16px; color: #4d4d4d; font-family: arial,sans-serif;"> '.$orderData->zipcode.', '.$orderData->country.'
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 16px; color: #4d4d4d; font-family: arial,sans-serif;"> '.$phone.'
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 16px; color: #4d4d4d; font-family: arial,sans-serif;"><a href="'.$userData->email.'" target="_blank">'.$userData->email.'</a>
            <p>
         </div>
      </td>
   </tr>
</table>';
                }// end admin section condition
    $htmlContent = '<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f9fafc" style="background-color:#e1e1e1; padding: 9px; width:590px;">
<tbody>
   <tr>
      <td align="center" valign="top">
         <table border="0" cellpadding="0" cellspacing="0" width="590" style="max-width: 590px!important;width: 590px;background: #ffffff;border-radius: 6px;">
            <tbody>
               <tr>
                  <td align="center" valign="top">
                  </td>
               </tr>
               <tr>
                  <td align="center" valign="top">
                     <!-- ======================Table section start Now=============================  -->
                     <table border="0" align="center" width="40%" cellpadding="0" cellspacing="0" style="margin-bottom:40px" >
                        <!-- top base color  -->
                        <tbody>
                           <tr>
                              <td valign="top" align="center" style="padding: 28px 0px;" >
                                 <div><img  vspace="0" hspace="0" border="0" alt="driverrepair24x7.com" style="width:220px" src="https://spreadertechno.com/assets/images/logo-1.webp">
                                 </div>
                              </td>
                           </tr>
                           <!-- end -->
                           <!-- ==================main-body-heading======================== -->
                           <!-- ======================================END================================ -->
                           <!-- ================================Admin Section =============================== -->
                           '.$adminSection.'
                           <!-- ======================================END Admin Section ============== -->
                           <!-- ===================================================payment======================== -->
                           <table border="0" align="center" width="85%" cellpadding="10" cellspacing="0">
                              <tr align="left">
                                 <th style="font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif; font-weight: 700;">Receipt Date <br/>
                                    <span style="font-weight: 400; color: #4d4d4d; font-family: arial,sans-serif; font-size: 12px;" >'.date("M d, Y ", strtotime($orderData->date_at)).'</span>
                                 </th>
                                 <th style="font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif; font-weight: 700;float:right;text-align:right;    padding-right: 14px;">Order Id<br/>
                                    <span style="font-weight: 400; color: #4d4d4d; font-family: arial,sans-serif; font-size: 12px;text-align:right" >#SPRD'.$orderData->id.'</span>
                                 </th>
                              </tr>
                           </table>
                           <!-- =========================================end=========================== -->
                           <table border="0" align="center" width="85%" cellpadding="10" cellspacing="0">
                              <tr align="left" align="center">
                                 <th>
                                    <h5 style="font-weight: 700; margin: 23px 2px 16px 0px;  font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;">Summary</h5>
                                 </th>
                              </tr>
                           </table>
                           <table border="0" align="center" width="93%" cellpadding="10" cellspacing="0">
                              <tr width="85%" align="left"  style="background-color: #f9fbf9">
                                 <th width="30%" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-left: 7%; ">
                                    <p>Product</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-right: 7%;">
                                    <p>Driver Repair 24x7 Updater '.$productType.' '.$autorenewal.'</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #f9fbf9">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-left: 7%;">
                                    <p>Quantity</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-right: 7%;">
                                    <p>01</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #f9fbf9">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-left: 7%;">
                                    <p>Licence Key</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-right: 7%;">
                                    <p>'.$licenceKey.'</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #f9fbf9">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-left: 7%;">
                                    <p>Price</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;padding-right: 7%;">$'.$orderData->amount.'</th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #f9fbf9">
                                 <th style="font-family: arial,sans-serif; font-weight: 900; font-size: 12px;padding-left: 7%;">
                                    <p>Total</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 900; font-size: 12px;padding-right: 7%;">
                                    <p>$'.$orderData->amount.'</p>
                                 </th>
                              </tr>
                           </table>
                           <table border="0" align="center" width="82%"  cellspacing="0">
                              <tr>
                                 <td>
                                    <h5 style="font-family: arial,sans-serif; font-weight: 400; font-size: 11px;     margin-top: 0px;padding: 30px 0 0px;text-align:center">For any questions, contact us at 
                                       <span style="color:#007eff;">support@driverrepair24x7.com </span> or call at
                                       <span style="color:#007eff;"><a style="color:#007eff;text-decoration:none" href="tel:(+1) 945-217-7400"> (+1) 945-217-7400</a>.</span>
                                    </h5>
                                 </td>
                              </tr>
                           </table>
                           <!--      ===============================footer section start here ===================== -->
                           <table border="0" align="center" width="82%" cellpadding="4" cellspacing="0">
                              <tr>
                                 <td>
                                    <h5 style="margin: 7px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 11px;"> 14112 98TH STREET,LIVE OAK, FL.32060, USA</h5>
                                    <h5 style="margin: 21px 0px 17px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 11px;">
                                       <a target="_blank" href="https://driverrepair24x7.com/support">Contact Us</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="https://driverrepair24x7.com/driver-installation-instruction">Installation Instruction</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="https://driverrepair24x7.com/privacy-policy">Privacy Policy</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="https://driverrepair24x7.com/download">Download Driver Repair 24x7</a>&nbsp;&nbsp;
                                    </h5>
                                 </td>
                              </tr>
                           </table>
                        </tbody>
                        <!-- ===============================================end================================ -->
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
         <!-- table close -->';



            return $htmlContent;
 }


?>