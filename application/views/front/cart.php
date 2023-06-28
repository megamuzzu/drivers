 
<!-- Cart page strt here   -->
<style type="text/css">
  .themeBgBox{
      background: #ffffff;
      border: 1px solid #e0e0e0;
  }
  .themeHeadingText{
    font-size: 18px;
    font-weight: 600;
    margin: 0;
  }
.headdingDiv {
    padding: 9px;
    border-bottom: 1px #e0e0e0;
    background-image: linear-gradient(to right, #184f6ee0 0%, #18c3c2c4 51%, #184f6ee0 100%);
    color: #fff;
    margin-bottom: 20px;
}
  .paymentDetailsCon .form-control::placeholder{
    font-size: 12px!important;
  }
  .paymentDetailsCon .form-control{
    font-size: 12px!important;
  }
  .theme-btn{
        border-radius: 23px;
    padding: 8px 37px;
  }
  .table th {
    background: red;
    background-image: linear-gradient(to right, #184f6ee0 0%, #18c3c2c4 51%, #184f6ee0 100%);
    color: #fff;
}
td.total {
    background: #f1f1f1;
    color: #112434;
    font-size: 22px;
}
th.first {
    font-size: 18px;
}
.table td, .table th {
    vertical-align: middle;
}
</style>
<section>
  <div class="container-fluid">
    <div class="row  br-header"> <img src="<?php echo base_url();?>assets/images/index/eula.jpg" class="img-fluid">
      <div class="col-md-12">
        <div class="wrap-content-main text-center text-white">
          <h1>CART<span style="color:#65c174; font-weight:700;"></span></h1> </div>
      </div>
    </div>
  </div>
</section>
<section class="my-2" >

<form method="post" id="paymentFrm" action="<?php echo base_url('cart/stripe');?>" autocomplete="off" >
<div class="container wrapper-container">
  <div class="row">
    <div class="col-md-12 ">
      <div class="mc-auto my_mobile">

      <div class="box-1"> 
          <!-- =====================1st themeBgBox ==========================-->
          <div class="successMsgArt row">
              <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
          </div><!-- // success row end-->


          <!-- <h2 class="text-center">Customer Care : <b>(+1) 945-217-7400</b></h2>  -->

          <h2 class=" themeHeadingText">Cart Summary</h2>
          <div class="table-content">
            
          
          <table class="table themeBgBox">
            <tr>
              <th class="first">Product</th>
              <th class="middle"></th>
              <th class="second" >Qty.</th>
              <th>Price</th>
            </tr>
            <!-- foreach listing products -->
            <?php
            $i = 1; 
            $payment_gross = 0;
            foreach($ProductList as $k=>$v){
              //$total = (isset($total))?$total+$v->price:$v->price;
              if($i == 1)
              $total = $v->price;
             ?>
            <input type="hidden" name="product[<?php echo $v->id; ?>]" value="<?php echo $v->id;?>" />  
            <tr id="protr<?php echo $v->id; ?>" >
              
              <td>
                <input type="checkbox" name="planCheckBox[<?php echo $v->id; ?>]" id="planCheckBox<?= $i ?>" class="radioBtn" data-productId="<?php echo $v->id; ?>" data-productPrice="<?php echo $v->price; ?>"  <?= ($i == 1)?" checked ":"" ?> value="<?php echo $v->id; ?>"  >
                <img src="<?php echo base_url('uploads/product/').$v->image1;?>" class="img-fluid com-ot" for="planCheckBox<?= $i ?>" >
              </td>

              <td>  

              <div class="productName productNameCon">
                  <?php echo base64_decode($v->name); ?>

                  <br>

                  <input type="checkbox" id="auto_renewal<?php echo $v->id;?>" name="auto_renewal[<?php echo $v->id; ?>]" value="1">  <label for="vehicle1">Enable Auto Renewal</label>


              </div>



                <?php if(!empty($v->renewal)){?>
                <div class="productRenewal productRenewalCon mt-2">
                  <input type="checkbox" name="renewal[<?php echo $v->id; ?>]" /> <?php echo base64_decode($v->renewal); ?>
                </div>
                <?php }?>
              </td>

              <td class="last">
                <input   id="Quantitypro<?php echo $v->id; ?>" name="no_item[<?php echo $v->id; ?>]" class="no_item no_item<?php echo $v->price;?>" type="number" value="1" min="1" data-price="<?php echo $v->price;?>"  data-id="<?php echo $v->id; ?>" >
              </td>

              <td> 
                <div class="mb-price pricCon">
                  <p class="priceText<?php echo $v->id; ?> <?= ($i == 1)?"  ":" text-disabled " ?>">US $<span class="totalPriceCon<?php echo $v->id; ?> itemPrice"><?php echo $v->price;?></span></p>
                  <input   id="item_prices<?php echo $v->id; ?>" name="item_prices[<?php echo $v->id; ?>]"  type="text"  value="<?php echo $v->price;?>">
                 </div>
              </td>
            </tr>
            <?php  $i++; 

            $payment_gross = $payment_gross+$v->price;

          }

            ?>
            <tr>
              <td colspan="3">
                <p style="font-size: 12px;">

                  We automatically bill your Payment Method each term on the calendar day corresponding to the commencement of your paying subscription if you select auto renewal.You will be informed via email 5 days prior to auto renewal. You may cancel the subscription anytime by writing to us at <a href="mailto:support@Driver Repair 24x7 .com">support@Driver Repair 24x7 .com</a>. We do not provide refunds or credits for any partial-term subscription periods except for a period of 14 days from the initial date of purchase of subscription. All <a href="<?= base_url('refund-policy')?>">Refund</a> & <a href="<?= base_url('terms-of-use#scroll-9')?>">cancellations</a> shall be governed as per our policies.

                </p>
              </td>
              <td class="total">
                <span><strong>Total:</strong></span>
                <input type="hidden" name="totalammount" id="totalammount" value="<?php echo $total;?>" /> 
                <span>US $<span class="totalammount"><?php echo (isset($total))?$total:''; ?></span></span>
              </td>
            </tr>
          </table>
          </div>
          <!-- =====================2st themeBgBox ==========================-->
          <div class="themeBgBox paymentDetailsCon">
            <div class="row">
              <div class="col-sm-12">
                <div class="headdingDiv">
                  <h3 class="themeHeadingText" >Enter your details and payment info</h3>
                </div>  
              </div>
            </div>
            <!-- Billing Details -->
            <div class="row px-2 ">
              <div class="col-sm-6">
                  <div class="payment-status"></div>
                  <div class="billingDetailsDiv">
                      <div class="form-group has-feedback">
                       <div class="row"> 
                          <div class="col-sm-6"> 
                            <input type="text" class="form-control outer validateCheck" placeholder="  First Name"  name="firstname"      value="<?php echo (!isset($userData))?'':$userData['fname'];?>"  required="required" />
                          </div>
                          <div class="col-sm-6 com_wrap"> 
                            <input type="text" class="form-control outer validateCheck" placeholder="  Last Name" name="lastname"       value="<?php echo (!isset($userData))?'':$userData['lname'];?>"  required="required" />
                           </div> 
                         </div>
                      </div>
                       
                      <div class="form-group has-feedback">
                        <div class="row">
                          <div class="col-sm-6">
                            <input type="email" class="form-control outer validateCheck" placeholder="  Email" name="email" id="emailCheck"    value="<?php echo (!isset($userData))?'':$userData['email'];?>"  required="required" />
                              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                              <p class="text-danger" ><small id="mailFieldMsg"></small> </p>
                          </div>
                          <!-- confirm email-->
                          <div class="col-sm-6">
                            <input type="email" class="form-control outer validateCheck" placeholder="Confirm Email" name="email2" id="emailCheck2"   autocomplete="off" onpaste="return false;"  required="required" />
                              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                              <p class="text-danger" style="position: absolute;"><small id="mail2FieldMsg"></small> </p>
                          </div> 
                        </div><!-- row-->
                      </div>
                        
                     <style type="text/css">.selectInput {height: 33px!important}</style>
                     <div class="form-group has-feedback">
                      <div class="row"> 
                        <div class="col-sm-3">
                          <select name="countryCode" class="form-control selectInput"  required="required" >
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                            <option value="+91">+91</option>
                            
                          </select>
                        </div> 
                        <div class="col-sm-9"> 
                          <input type="phone" class="form-control phonenumber" minlength="10"  maxlength="15"  placeholder="Phone Number " name="phone" id="phone"  value="<?php echo (!isset($userData))?'':$userData['phone'];?>"   required="required" />
                        </div><!-- oninvalid="setCustomValidity('Only 10 Digit Phone Number Accepted.')" -->
                      </div>
                     </div>

                     <div class="form-group has-feedback">
                       <input type="text" class="form-control outer validateCheck" placeholder=" Street Addrress" name="street"   value="<?php echo (!isset($userData))?'':$userData['street'];?>"  required="required" />
                     </div>

                     <div class="form-group has-feedback">
                        <div class="row"> 
                          <div class="col-sm-6"> 
                            <select class="form-control outer validateCheck" placeholder="  Country" name="country" id="country"   required="required" >
                                <option value="" data-contry="">Country</option>
                                <?php foreach($country as $k=>$v ){ ?>
                                  <option value="<?php echo $v->name;?>" <?php echo (isset($userData) && $userData['country'] == $v->name)?' selected ':'';?> data-contry="<?php echo $k;?>" ><?php echo $v->name;?></option>
                                <?php }?>
                              </select>
                            
                          </div>
                          <div class="col-sm-6 com_wrap"> 
                            <!-- <input type="text" class="form-control outer validateCheck" placeholder=" State" name="state"   value="<?php echo (!isset($userData))?'':$userData['state'];?>" /> -->

                            <select class="form-control outer" placeholder="State" name="state" id="state"   required="required" >
                              <option value="">State</option>
                              <!-- <option value="">States</option>
                              <?php foreach($states as $k=>$v ){ ?>
                              <option value="<?php echo $v->name;?>" <?php echo (isset($userData) && $userData['state'] == $v->name)?' selected ':'';?> data-county="<?php echo $v->countryId ?>"  ><?php echo $v->name;?> - <?php echo $country[$v->countryId]->code;?></option>
                              <?php }?> -->
                              
                            </select>

                            
                          </div>
                        </div>  
                      </div> 
                      <div class="form-group has-feedback">
                        <div class="row"> 
                          <div class="col-sm-6"> 
                             <input type="text" class="form-control outer validateCheck" placeholder="  City" name="city"   value="<?php echo (!isset($userData))?'':$userData['city'];?>"  required="required" />
                            </div>
                            <div class="col-sm-6 com_wrap"> 
                              <input type="text" class="form-control outer validateCheck" minlength="5" maxlength="8" placeholder="  Zip code" name="zipcode"   value="<?php echo (!isset($userData))?'':$userData['zipcode'];?>" autocomplete="off"   required="required" />
                            </div>  
                        </div>  
                      </div>

                    
                   </div><!--// billingDealisCon-->
                </div><!--// col-6-->

            <!-- Card Details -->
            <div class="col-sm-6 ">
              <input type="hidden" name="subscr_plan" value="1"/>
              <?php $this->load->view('front/cardvalidation2');?>
               

              <div class="termsandConditionsCon">
                <label><input type="checkbox" id="terms" name="terms"  value="1"   required="required" /> <small>I have read and agree to the website <a href="<?php echo base_url();?>privacy-policy" target="_blank"><u>Privacy Policy</u></a> & <a href="<?php echo base_url();?>terms-of-use" target="_blank"> <u> T&C</u></a></small>
                </label>
                
                  <br/>
              </div>
             <div class="row mt-3">
                <div   class="col-md-12">
                   <div class="form-group">
                      <button type="submit" id="payBtn" class="nav-link btn-grad">Buy Now</button>
                      
                    </div>
                 </div>
                 <div class="col-md-2 col-sm-3 col-3 pt-3">
                   <div class="form-group">
                      <!-- DigiCert Seal HTML -->
                      <!-- Place HTML on your site where the seal should appear -->
                      <div id="DigiCertClickID_0aprU8-T"></div>

                      <!-- DigiCert Seal Code -->
                      <!-- Place with DigiCert Seal HTML or with other scripts -->
                      <script type="text/javascript">
                      var __dcid = __dcid || [];__dcid.push(["DigiCertClickID_0aprU8-T", "15", "s", "black", "0aprU8-T"]);(function(){var cid=document.createElement("script");cid.async=true;cid.src="//seal.digicert.com/seals/cascade/seal.min.js";var s = document.getElementsByTagName("script");var ls = s[(s.length - 1)];ls.parentNode.insertBefore(cid, ls.nextSibling);}());
                      </script>
                    </div>
                 </div>
              </div>

<!-- 
               <div class="row mt-3  " id="checkoutBtnStipe">
                <div class="col-md-12">
                   <div class="form-group">
                      <input type="hidden" id="pay_amount" name="pay_amount" value="<?php echo $total;?>" />
                      <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="<?php echo $stripe['publishable_key']; ?>"
                      data-name="driverfixerDriver"
                      data-description="Updater 01 Year Subscription"
                      data-email="info@Driver Repair 24x7 logyllc.com"
                      data-amount="<?php echo $total*100;?>"
                      data-image = "<?php echo base_url();?>assets/images/favicon.png"
                      data-locale="auto"></script>
                    </div>
                 </div>
              </div>  -->

            </div>

          </div> 
           
        </div> 
    </div>
  </div>
  </div>
</div>
    
     
</div>
  </div>
  </form>
</section>




<!-- end -->


<script type="text/javascript">
    // total count

    $(".no_item").change(function(){


      var id = $(this).attr("data-id");
      var price = parseFloat($(this).attr("data-price")).toFixed(2);
      var no_item = $(this).val();

       
      
      
        
        var totalItemPrice = (price*no_item).toFixed(2);
          $(".totalPriceCon"+id).html(totalItemPrice);
          $("#item_prices"+id).val(totalItemPrice);
          var totalAmmount = 0.00;
          $(".itemPrice").each(function(){
              temp = parseFloat($(this).html()).toFixed(2);
              totalAmmount = (parseFloat(totalAmmount)+parseFloat(temp));
          }); 
       
      
      // check radio checked conditons
       var totalPrice = 0;
      var totalPrices = 0;


        $(".radioBtn").each(function(){
           

          if($(this).is(':checked'))
          {
             
            var proId = $(this).attr("data-productId");
             totalPrice = $(".totalPriceCon"+proId).html();
             $(".priceText"+proId).removeClass("text-disabled");
             totalPrices =  totalPrices +  (totalPrice*1) ;
              
           }
      });

     /* $(".totalammount").html(totalPrice);*/
     $(".totalammount").html((totalPrices).toFixed(2));
      $("#totalammount").val((totalPrices).toFixed(2)) ;
       
      //alert(totalItemPrice);

    });

   // cheange radio (button select plan)
   $(".radioBtn").click(function(){
      $(".pricCon p").addClass("text-disabled");
      var totalPrice = 0;
      var totalPrices = 0;
        $(".radioBtn").each(function(){
           

          if($(this).is(':checked'))
          {
             
            var proId = $(this).attr("data-productId");
            totalPrice = $(".totalPriceCon"+proId).html();
            $(".priceText"+proId).removeClass("text-disabled");
            totalPrices =  totalPrices +  (totalPrice*1 ) ;
              

             
          }
      });
      $(".totalammount").html((totalPrices));
      $("#totalammount").val((totalPrices)) ;
   });

 </script>
<!-- Only Number and dot -->


  <script src="https://js.stripe.com/v2/"></script>
    <script>
    // Set your publishable key
    Stripe.setPublishableKey('<?php echo $stripe['publishable_key']; ?>');

    // Callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // Enable the submit button
            $('#payBtn').removeAttr("disabled");
            // Display the errors on the form
            //alert(response.error.message);
            $(".payment-status").html('<p style="font-size: 14px;color: #ec0808;">'+response.error.message+'</p>');
        } else {
            var form$ = $("#paymentFrm");
            // Get token id
            var token = response.id;
            // Insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");

            // Submit form to the server
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        // On form submit
        $("#paymentFrm").submit(function() {
            //validate email
            var email = $("#emailCheck").val();
            var email2 = $("#emailCheck2").val();
            
            if(email != email2){
              $("#mail2FieldMsg").html("Email Address mismatched");
              //alert("Email Address mismatched");
              return false;
            }else{
              $("#mail2FieldMsg").html("");
            }
            


            // Disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");
        
            // Create single-use token to charge the user
            Stripe.createToken({
                number: $('#card_number').val(),
                exp_month: $('#card_exp_month').val(),
                exp_year: $('#card_exp_year').val(),
                cvc: $('#card_cvc').val()
            }, stripeResponseHandler);
        
            // Submit from callback
            return false;
        });
    });
  </script>
<script type="text/javascript">
    $('#phone').keypress(function(event) {
        var code = event.which ;
        
        if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
                $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    }).on('paste', function(event) {
        event.preventDefault();
    });
</script>
<!-- //Only Number and dot--> 

  <script type="text/javascript">
    // when change country
    $(document).ready(function(){
      $("#country").change(function(){
        //var statesList = "<?=$statesList?>";
        var id = $(this).find(':selected').attr('data-contry')
        if(id =='' ){
          $("#state").html('');
          $("#state").append('<option value="">Select State</option>');
        }else{
          $.ajax(
            {
              type:"POST",
              url:'<?=base_url()?>cart/getstates',
              data:"id="+id,
              success:function(returnVal)
              {
                if(returnVal == ''){

                }else{
                  var stateList = $.parseJSON(returnVal);
                  $("#state").html('');
                  $.each( stateList, function( k, v ) {
                    $("#state").append('<option value="'+v['name']+'" >'+v['name']+'</option>');
                  });
                }
              }
            });
        }
      });
    });
    </script>
    