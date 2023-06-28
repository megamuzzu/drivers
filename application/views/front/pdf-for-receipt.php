<?php
// product
    $productarray = (isset($orderData->products))?json_decode($orderData->products,true):'';
    $productType = isset($productarray['product'][1])?'<small>(Monthly Subscription)</small>':'<small>(Annual Subscription)</small>';
    $autorenewal = ($productarray['renewal'] == "on")?" <br/><small>(Automatic Renewal at $29.00 after the first year.)</small> ":'';
    // product key 
    $licenceKey = (isset($productKeyData) && $productKeyData[0]->productKey != "N")?$productKeyData[0]->productKey:"Contact Our Customer Care on toll free number +1-800-990-6787.";
?>
<div id="divContent" style="background-color: #ffff; padding:20px 25px;width:100%;">   
           <div class="container" style="    padding: 10px;background: #ececec;margin: auto;width: 100%;">
           <div class="receipt_container" style="width: 100%; max-width:100%;background: #ffffff;
        box-shadow: 0 0 4px 0px #616161 !important;   "> 
            <div class="row">
             <div class="col-md-12">
              <img src="<?php echo base_url();?>assets/images/mail/base.jpg" style="max-width: 100%; width:100%;float: left;">
             </div>
            </div>

            <div class="row mb-5">
            <div class="col-md-12 text-center">
            <div class="mail_article text-center">
            <h3 style="font-size: 30px; margin: 0; font-family: arial,sans-serif; font-weight: 700;">Driver Repair 24x7</h3>
            <!-- <p style=" color: #706f6f;  margin: 6px; font-family: arial,sans-serif;  font-size: 16px;   margin: 6px 18px 34px;">Receipt #CMOD0001<?= isset($orderData->id)?$orderData->id:''?></p> -->

             </div>
            </div>
           </div>

           <div class="row" style="padding: 50px; margin-top: -50px;">

            <div class="col-sm-4">
              <div style=""> 
                 <span style="font-size: 14px; color: #4d4d4d; font-family: arial,sans-serif; font-weight: 700; ">Receipt  Date</span><br/>
                 <span style="font-weight: 400; color: #4d4d4d; font-family: arial,sans-serif; font-size: 16px;  margin-top:14px;"> <?= isset($orderData->date_at)?date("M d,Y", strtotime($orderData->date_at)):''?></span>
              </div>
            </div>

            <div class="col-sm-4 offset-sm-4">
              <div style="float:right"> 
                 <span style="font-size: 14px; color: #4d4d4d; font-family: arial,sans-serif; font-weight: 700; ">Order Id</span><br/>
                 <span style="font-weight: 400; color: #4d4d4d; font-family: arial,sans-serif; font-size: 16px;  margin-top:14px;"> #CMOD0001<?= $orderData->id?></span>
              </div>
            </div> 

           </div>


          <div class="row" style="padding: 50px; margin-top: -93px;">
            <div class="col-md-12 mt-3">
            <h4 style="font-size: 14px; color: #4d4d4d; font-family: arial,sans-serif; text-transform:uppercase; font-weight: 700;">SUMMARY</h4> 
            </div>
            </div>

            <div class="row" style="padding: 63px;margin-top: -106px;">
             <div class="col-md-12" style="background-color: #e6f8ff;">
              <div class="receipt_bg">
               <div class="row">
                <div class="col-sm-4" style=" padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0;">
                  <span style="">Product</span>
                </div>

                <div class="col-sm-8" style="float: right;  padding-bottom:10px; padding-top:10px; font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; text-align: right;">
                 <span style=" ">  Driver Repair 24x7 Updater<?= $productType ?><?= isset($autorenewal)?$autorenewal:''?></span>

                </div>
               </div>  


                <div class="row">
                <div class="col-sm-4" style=" padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0;">
                  <span style="padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400;">Quantity</span>
                </div>

                <div class="col-sm-8" style="float: right;  padding-bottom:10px; padding-top:10px; font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; text-align: right;">
                 <span style="float: right">01</span>

                </div>
               </div> 
                <div class="row">
                <div class="col-sm-4" style=" padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0;">
                  <span style="width: 100px ">Licence Key</span>
                </div>

                <div class="col-sm-8" style="float: right;  padding-bottom:10px; padding-top:10px; font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; text-align: right;">
                 <span class="text-right" style="float: right"><?= isset($licenceKey)?$licenceKey:''?></span>

                </div>
               </div> 

               <div class="row">
                <div class="col-sm-4" style=" padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0;">
                  <span style="width: 100px ">Payment to Stripe, LLC.</span>
                </div>

                <div class="col-sm-8" style="float: right;  padding-bottom:10px; padding-top:10px; font-family: arial,sans-serif; font-weight: 400; border-bottom: 1px solid #c0c0c0; text-align: right;">
                 <span style="float: right">$<?= isset($orderData->amount)?$orderData->amount:''?></span>

                </div>
               </div>

                  <div class="row">
                <div class="col-sm-4" style=" padding-bottom:10px; padding-top:10px;font-family: arial,sans-serif; font-weight: 400; ">
                  <span style="font-weight: 700; ">Amount paid</span>
                </div>

                <div class="col-sm-8" style="float: right;  padding-bottom:10px; padding-top:10px; font-family: arial,sans-serif; font-weight: 400;  text-align: right;">
                 <span style="float: right; font-weight: 700;">$<?= isset($orderData->amount)?$orderData->amount:''?></span>

                </div>
               </div> 



              </div>
             </div>
            </div>

           <div class="row" style="padding: 36px; margin-top: -130px;">
            <div class="col-md-12">
             <div class="top_lines" style="padding: 20px;">
             <h5 style="font-family: arial,sans-serif; font-weight: 400; font-size: 16px;     margin-top: 30px;border-top: 2px solid #b0b0b0; border-bottom: 2px solid #b0b0b0;padding: 19px 0 19px;text-align: center; ">If you have any questions, contact us at <span style="color: #007eff">support@driverrepair24x7.com</span> or call at<span style="color: #007eff"> +1-800-990-6787.</span></h5>

                
                <h5 style="margin: 8px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 14px;">You are receiving this email because you have subscribed to Driver Repair 24x7 Software Updater from <span style="color:#007eff;">driverrepair24x7.com</span>, a subsidiary of Driver Repair 24x7. You will see a charge from driverrepair24x7.com on your credit card statement every month on the same date as the original purchase date for 12 months.</h5>
                <h5 style="margin: 8px 0px;text-align:center;font-family: arial,sans-serif; font-weight: 400; font-size: 14px;"> 3180 Scotch Creek Rd unit 106 Coppell TX - 75019 USA.</h5>

             </div>
            </div>
           </div>
         </div> 
        </div>
       </div>