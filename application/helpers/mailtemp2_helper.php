

<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


 // customer mail template
 function customer_order_mail($orderData,$productKeyData,$userData, $productData,$userType){
    $cardData = json_decode($orderData->cyogateresponse,true);
    $cardBrand = isset($cardData['payment_method_details']['card']['brand'])?$cardData['payment_method_details']['card']['brand']:'';
    $last4     = isset($cardData['payment_method_details']['card']['last4'])?$cardData['payment_method_details']['card']['last4']:'';
    // product
    $productarray = json_decode($orderData->products,true);
    $autorenewal = ($productarray['renewal'] == "on")?" <br/><small>(Automatic Renewal at $29.00 after the first year.)</small> ":'';
    // product key 
    $licenceKey = ($productKeyData[0]->productKey == "N")?"Contact Our Customer Care on toll free number (+1) 945-217-7400.":$productKeyData[0]->productKey;
    $adminSection = '';
    if($userType == "Admin")
    {
      //
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
               font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;">'.$userData->fname.' '.$userData->lname.'
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;">'.$orderData->street.', '.$orderData->city.', '.$orderData->state.' 
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;"> '.$orderData->zipcode.', '.$orderData->country.'
            <p>
            <p style=" font-weight: 200; margin: 0 11px -12px 0px; 
               font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;"><a href="'.$userData->email.'" target="_blank">'.$userData->email.'</a>
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
         <table border="0" cellpadding="0" cellspacing="0" width="590" style="max-width: 590px!important;width: 590px;background: #ffffff;box-shadow: 0 0 4px 0px #616161 !important;border-radius: 6px;">
            <tbody>
               <tr>
                  <td align="center" valign="top">
                  </td>
               </tr>
               <tr>
                  <td align="center" valign="top">
                     <!-- ======================Table section start Now=============================  -->
                     <table border="0" align="center" width="40%" cellpadding="0" cellspacing="0">
                        <!-- top base color  -->
                        <tbody>
                           <tr>
                              <td valign="top" align="center">
                                 <div><img width="600" vspace="0" hspace="0" border="0" alt="driverrepair24x7.com" style="float:left;max-width:700px;display:block" src="https://spreadertechno.com/assets/images/mail/base.jpg">
                                 </div>
                              </td>
                           </tr>
                           <!-- end -->
                           <!-- ================================main-body-heading=============================== -->
                           <tr align="center">
                              <td valign="top" align="center"  cellspacing="0" style="text-align: center; padding:0;">
                                 <h3 style="font-size: 30px; margin: 0; font-family: arial,sans-serif;">Driver Repair 24x7</h3>
                                 <p style=" color: #706f6f;  margin: 6px; font-family: arial,sans-serif;  font-size:12px;    margin: 6px 18px 34px;">Receipt #CMOD0001'.$orderData->id.'</p>
                              </td>
                           </tr>
                           <!-- ======================================END================================ -->
                           <!-- ================================Admin Section =============================== -->
                           '.$adminSection.'
                           <!-- ======================================END Admin Section ============== -->
                           <!-- ===================================================payment======================== -->
                           <table border="0" align="center" width="85%" cellpadding="10" cellspacing="0">
                              <tr align="left">
                                 <th style="font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif; text-transform:uppercase; font-weight: 700;">Receipt Date <br/><br/>
                                    <span style="font-weight: 400; color: #4d4d4d; font-family: arial,sans-serif; font-size: 12px;" >'.date("M d, Y ", strtotime($orderData->date_at)).'</span>
                                 </th>
                                 <th style="font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif; text-transform:uppercase; font-weight: 700;float: right;"><a href="http://driverrepair24x7.com/download" target="_blank"><img src="https://spreadertechno.com/assets/images/mail/downloadBtn.png" width="50" title="Download Driver Repair 24x7 Updater"  /> </a></th>
                              </tr>
                           </table>
                           <!-- =========================================end=========================== -->
                           <table border="0" align="center" width="85%" cellpadding="10" cellspacing="0">
                              <tr align="left" align="center">
                                 <th>
                                    <h5 style="font-weight: 700; margin: 23px 2px 16px 0px; text-transform: uppercase; font-size: 12px; color: #4d4d4d; font-family: arial,sans-serif;">summary</h5>
                                 </th>
                              </tr>
                           </table>
                           <table border="0" align="center" width="82%" cellpadding="10" cellspacing="0">
                              <tr width="85%" align="left"  style="background-color: #e6f8ff">
                                 <th width="30%" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>Product</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>Driver Repair 24x7 Driver Updater'.$autorenewal.'</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #e6f8ff">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>Quantity</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>01</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #e6f8ff">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>Licence Key</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>'.$licenceKey.'</p>
                                 </th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #e6f8ff">
                                 <th style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">
                                    <p>Amount</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; font-size: 12px;">$'.$orderData->amount.'</th>
                              </tr>
                              <tr width="85%" align="left"  style="background-color: #e6f8ff">
                                 <th style="font-family: arial,sans-serif; font-weight: 900; font-size: 12px;">
                                    <p>Amount paid</p>
                                 </th>
                                 <th align="right" style="font-family: arial,sans-serif; font-weight: 900; font-size: 12px;">
                                    <p>$'.$orderData->amount.'</p>
                                 </th>
                              </tr>
                           </table>
                           <table border="0" align="center" width="82%" cellpadding="10" cellspacing="0">
                              <tr>
                                 <td>
                                    <h5 style="font-family: arial,sans-serif; font-weight: 400; font-size: 12px;     margin-top: 30px;border-top: 2px solid #b0b0b0; border-bottom: 2px solid #b0b0b0;    padding: 30px 0 18px; ">If you have any questions, contact us at 
                                       <span style="color:#007eff;">support@driverrepair24x7.com</span> or call at
                                       <span style="color:#007eff;"> (+1) 945-217-7400.</span>
                                    </h5>
                                 </td>
                              </tr>
                           </table>
                           <!--      ===============================footer section start here ===================== -->
                           <table border="0" align="center" width="82%" cellpadding="10" cellspacing="0">
                              <tr>
                                 <td>
                                    <h5 style="margin: 5px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 12px;">Something wrong with email?<a href="http://driverrepair24x7.com/" style="text-decoration: none;"><span style="color:#007eff;"> View it in your browser.</span></a></h5>
                                    <h5 style="margin: 5px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 12px;">You are receiving this email because you have subscribed to <span style="color:#007eff;">MicroHuv LLC.</span></h5>
                                    <h5 style="margin: 5px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 12px;"> 3180 Scotch Creek Rd unit 106 Coppell TX - 75019 USA.</h5>
                                    <h5 style="margin: 5px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 13px;"> (+1) 945-217-7400</h5>
                                    <h5 style="margin: 5px 0px 10px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 12px;">
                                       <a target="_blank" href="http://driverrepair24x7.com/support">Support</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="http://driverrepair24x7.com/driver-installation-instruction">Installation Instruction</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="http://driverrepair24x7.com/eula">EULA</a>&nbsp;&nbsp;|
                                       <a target="_blank" href="http://driverrepair24x7.com/privacy-policy">Privacy Policy</a>&nbsp;&nbsp;
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