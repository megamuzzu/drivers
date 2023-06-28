<!--driver_installation_instruction -->
<section>
	
<div class="container">
 <div class="row">
   <div class="col-md-12 text-center">
   	 <h1 class="head  pt-5">Almost done!</h1>
   	 <h5 class="pt-2"><strong>Follow these<span style="font-size: 26px; color: #e31e24;"> 3 easy steps </span>to complete your installation</strong></h5>
     <?php if(isset($pagetype) && $pagetype == 'DownloadInstructions'){ ?>
      <h6 class="mt-4 notice"><strong>Note:</strong> If your download did not start automatically, please <a href="<?php echo base_url('trial-driver-download');?>" class="click-com"> click here.</a></h6>
    <?php } ?>
    <!-- <h2 style="font-size:20px;" class="mt-2" >For any Query/Help Contact Us <br/><br/><strong><span>Call : 1-888-999-7777 <br/> Email : support@driverrepair24x7.com</span></strong></h2> -->
   </div>
 </div>
 
   <div class="row">
    <div class="col-md-4 text-center pt-5">
     <div class="almost-bg">
      <h5><strong>Step 1: Run the installer</strong></h5>
       <img src="<?php echo base_url();?>assets/images/step11.png" class="img-fluid pb-3">

       <h6 class="pt-5">Click "Save File" to download the software.</h6>


    </div>
   </div>



 <div class="col-md-4 text-center pt-5">
     <div class="almost-bg">
      <h5><strong>Step 2: Confirm installation</strong></h5><br>
       <img src="<?php echo base_url();?>assets/images/step2.png" class="img-fluid pb-3">

       <h6 class="pt-5">Click "Yes" on the system dialog window to confirm your installation</h6>

    </div>
   </div>

     <div class="col-md-4 text-center pt-5">
     <div class="almost-bg">
      <h5><strong>Step 3: Complete setup</strong></h5>

      <img src="<?php echo base_url();?>assets/images/index/install.jpg" class="img-fluid pb-3">

       <h6 class="pt-5">Follow the easy installation wizard and start optimizing!</h6>

    </div>
   </div>
  </div>


<!--    <div class="row">
     <div class="offset-md-3 col-md-9">
     	<div class="op-bt">

       <a href="<?php echo base_url();?>" class=" btn optimie-btn">How to Update & Optimize your PC <i class="fa fa-external-link"></i></a>
      </div>
     </div>

   </div> -->

  <div class="row">
     <div class="col-md-12 mt-5">
        <p class="text-center hw">All rights reserved Driver Repair 24x7 (Driver Repair 24x7 PC Cleaner And Driver Repair 24x7 Driver Updater) support, the Driver Repair 24x7 (Driver Repair 24x7 PC Cleaner And Driver Repair 24x7 Driver Updater) logo and Driver Repair 24x7.COM are trademarks of Driver Repair 24x7 and its affiliated companies. All third party products, brands or trademarks listed above are the sole property of their respective owner. No affiliation or endorsement is intended or implied. You may uninstall Driver Repair 24x7 Driver Updater at any time, using the standard uninstall procedures as offered with your computer's Operation System, by accessing the computer's "Control Panel>Add/Remove Programs" folder, selecting 'Driver Repair 24x7 Driver Updater' from the list of installed applications, and clicking the "Uninstall" button. OPERATING SYSTEMS: Compatible with 32/64 bit versions of Windows 10, 8, 7, & Vista. REQUIREMENTS: 25MB of hard disk space available, 256MB of RAM and at least a 300Mhz processor. *Driver Repair 24x7 Driver Updater full functionality requires subscription of $4.99/month (Prices and offers are subject to change) and provides accurate drivers in an easy and convenient method. Without a subscription, Driver Updater can assist your search for drivers at the respective manufacturers' website for free.</p>
   
     </div>
  </div>
</div>
</section>


<!-- <section class="<?php echo (isset($pagetype) && ($pagetype == 'trynow' ) )?"hidden":''; ?>"> -->
<section class="hidden">
<div class="container-fluid">
 <div class="row">
 <div class="col-md-6 arrow-icon  bounce2">
  <img src="<?php echo base_url();?>assets/images/index/down-arrow2.png" class="img-fluid ">


 </div>
 </div>
  </div>
</section>

<!-- Modal -->
<div class="tryNowModalSec  <?php echo (isset($pagetype) && ($pagetype == 'DownloadInstructions' OR $pagetype == 'instructions' ) )?"hidden":''; ?> ">
    <div class="row">

      <div class="col-md-6 offset-md-3 bg-white tryNowInner ">
        <img src="<?php echo  base_url("images/close-btn.png"); ?>" class="closeModelBtn hidden"  width="40" height="40" style="position: absolute;right: -11px;top: -14px;cursor: pointer;" >
        <div class="step1 text-center">
          <p style="font-size: 1rem;">Please enter your email ID to receive to download link in your Inbox </p>
          <form id="downloadform" method="post" action="" >
            <div class="form-group text-center">
              <input type="email" class="form-control" name="email" id="email" equired="required"  style="width: 80%;margin-left: 10%;" />
            </div>
            <div class="form-group">
              <button type="submit" name="submit" id="submit" class="btn btn-success submit-driver-installation">Submit</button> 
            </div>

          </form>
        </div><!--/step-1-->
        <div class="step2 text-center hidden">
          <img src="<?php echo base_url("assets/images/spiner/spin3.gif"); ?>">
          <p>Processing...</p>
        </div><!--// step-2-->
        <div class="step3 text-center py-5 hidden">
          <img src="<?php echo base_url("assets/images/payment-success.png"); ?>" width="150px" >
          <!-- <h4 style="font-size:18px;"> Please check your email account Inbox for Driver Repair 24x7 Driver Updater download link.</h4> -->
          <h4 style="font-size:18px;"> A link has been sent to your email to download Driver Repair 24x7 Driver Updator.</h4>
        </div><!--// step-3-->

      </div> 
    </div>
</div>
<!--// Modal -->


<!-- Download Modal Button  New Changes  -->
 <div class="modal ComModal" id="downloadModal"  tabindex="-1">
  <div class="modal-dialog my-dialog">
    <div class="modal-content mContent">

      <div class="modal-body mBody py-5 text-center">
        <label for="readTerms" class="ComLabel"><input type="checkbox" name="readTerms" id="readTerms" value="yes"> Please Accept <a href="<?=base_url("terms-of-use")?>" target="_blannk" > Terms & Conditions</a> of Driver Repair 24x7 Driver Updater to Download the Software.</label>
      </div>
      <div class="modal-footer wp-modalFooter text-center mFooter">
        <a href="<?=base_url("download")?>" class="btn btn-danger my-danger" >Close</a>
        <button type="button" id="downloadModalBtn"  class="btn btn-dark my-dark " disabled download="exe" >Download Now</button>
      </div>
    </div>
  </div>
</div>
<!-- end -->
<!-- css -->



<!-- end -->


<!-- New css Click To call -->

<style type="text/css">
  
  .slide-top {
  -webkit-animation: slide-top 3s cubic-bezier(0.250, 0.460, 0.450, 0.940) infinite alternate-reverse both;
          animation: slide-top 3s cubic-bezier(0.250, 0.460, 0.450, 0.940) infinite alternate-reverse both;
}
@-webkit-keyframes slide-top {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
}
@keyframes slide-top {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-30px);
            transform: translateY(-30px);
  }
}


@media only screen and (max-width: 600px) {

  .mybounce{
    display: none!important;



  }
}
</style>





<?php if(isset($pagetype) && $pagetype == 'DownloadInstructions'){ ?>
<script type="text/javascript">
 

  var pathname = window.location.pathname;
  setTimeout(function(){
    //window.location.href = ""; 
    

  }, 1000);
</script>  
<?php } ?>

<script type="text/javascript">
  // sent url
  $("#downloadform").submit(function(){                 // Video Uploade submit

    $(".step1").addClass("hidden");
    $(".step2").removeClass("hidden");
    var emailId = $("#email").val();
    var url = "<?php echo base_url('Driver_installation_instruction/sendDownloadLink');?>";
     $.ajax(
      {
        type:"POST",
        url:url,
        data:'email='+emailId,
        success:function(returnVal)
        {
          //alert(returnVal);
          $(".step2").addClass("hidden");
          $(".step3").removeClass("hidden");
          $(".closeModelBtn").removeClass("hidden");

          
        }
      });
    return false;
  });

  $(".closeModelBtn").click(function(){
     $(".tryNowModalSec").addClass("hidden");
  });
</script>



<!-- end