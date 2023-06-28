<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
<section>
  <div class="container-fluid">
    <div class="row  br-header"> <img src="<?php echo base_url();?>assets/images/index/eula.jpg" class="img-fluid">
      <div class="col-md-12">
        <div class="wrap-content-main text-center text-white">
          <h1>Update <span style="color:#18c3c2; font-weight:700;">Drivers</span></h1> </div>
      </div>
    </div>
  </div>
</section>
<section>
   <div class="container">
      <div class="row mt-5">
         <div class="download-area">
            <?php if(isset($downloadFor) && !empty($downloadFor) ){?>
            <h2 class="pt-3 text-uppercase" ><strong><?= str_replace("-", " ", $downloadFor)?> Driver Download</strong></h2>
            <?php }else{?>
            <h2 class="pt-3"><strong>Update Drivers For Microsoft Windows</strong></h2>
            <?php }?>
            <p class="pt-3"><strong>Drivers for all your devices</strong></p>
            <p>Driver Repair 24x7  is source of driver updates directly from the manufacturers (such as DELL, MICROSOFT, HP, ACER, LENOVO, BROTHER and many more. This ensures you get the correct drivers for your specific make & model Windows PC. Additional functionality and services include enhanced app experiences, deceptive software protection, system cleanup, and assisted support.</p>
            <h2 class="text-center pb-3" style="color: #18c3c2;">Get Started, Select Your Windows Version to Download</h2>
         </div>
      </div>
   </div>
</section>
<section class="download-section">
   <div class="download-arrow"></div>
   <div class="container">
      <div class="row" style="position: relative;top: 31px; display: none;" id="show-box" data-delay="5.1s" >
         <div class="col-sm-4 offset-sm-4">
            <div id="show-box">
               <div class="popup-box download-box">
                  <img class="downloaderGif" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/downloader.gif?v=1.0.0.52">
                  <p class="text-center">Your download will begin in a moment...</p>
               </div>
            </div>
         </div>
      </div>
      <!-- // row-->
      <div class="row" style="position: relative;top: 31px;" id="hide-box">
         <div class="col-sm-4">
            <div class="version-box download-box">
               <h2 class="version-boxheader">Windows <b>7</b></h2>
               <div class="version-divider"></div>
               <input type="button" class="downloadBtn" name="showBtn" id="showBtn" value="SELECT" onclick="showDiv(); Onceclick(); "/>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="version-box download-box">
               <h2 class="version-boxheader">Windows <b>8</b></h2>
               <div class="version-divider"></div>
               <input type="button" class="downloadBtn" name="showBtn" id="showBtn" value="SELECT" onclick="showDiv(); Onceclick(); "/>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="version-box download-box">
               <h2 class="version-boxheader">Windows <b>10</b></h2>
               <div class="version-divider"></div>
               <input type="button" class="downloadBtn" name="showBtn" id="showBtn" value="SELECT" onclick="showDiv(); Onceclick(); "/>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
   <div class="row pt-5 pb-5 text-center">
      <small>
      Driver Repair 24x7  is an independent service provider for software products. It is a tool to help identify out-of-date or missing device drivers. Software Principles. By downloading you accept the Privacy Policy and Terms and Conditions. Full functionality requires $9.99 monthly subscription. Use of names and trademarks are for reference only and no affiliation is implied with any named third-party companies.
      </small>
   </div>
   <h2 class="text-center">Get Started Updating Drivers In 3 Easy Steps</h2>
   <div class="row wrap-box pt-5">
      <div class="col-sm-4">
         <div href="#" class="step-box ui-box">
            <h3 class="step-header">STEP 1</h3>
            <div class="step-footer">
               <img class="step-img" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/downloadIcon.png?v=1.0.0.52">
               <p class="step-text">Download</p>
               <p class="step-subtext">(click to start download)</p>
            </div>
         </div>
         <img class="step-arrow" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/rightArrow.png?v=1.0.0.52">
      </div>
      <div class="col-sm-4">
         <div href="#" class="step-box ui-box">
            <h3 class="step-header">STEP 2</h3>
            <div class="step-footer">
               <img class="step-img" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/scanIcon.png?v=1.0.0.52">
               <p class="step-text">Purchase & Scan</p>
               <p class="step-subtext">(click to start download)</p>
            </div>
         </div>
         <img class="step-arrow" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/rightArrow.png?v=1.0.0.52">
      </div>
      <div class="col-sm-4">
         <div href="#" class="step-box ui-box">
            <h3 class="step-header">STEP 3</h3>
            <div class="step-footer">
               <img class="step-img" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/fixIcon.png?v=1.0.0.52">
               <p class="step-text">Fix & Optimize*</p>
               <p class="step-subtext">(click to start download)</p>
            </div>
         </div>
      </div>
      <img class="pt-5" src="https://d3ti88jhu7fk5j.cloudfront.net/Content/themes/falcon/images/divider.png?v=1.0.0.52">
   </div>
</section>
<section class="pb-3">
   <div class="container">
      <h3>Common Problems With Drivers</h3>
      <ul class="pt-3">
         <li>Driver is out-of-date</li>
         <li>Previous attempt to update driver failed</li>
         <li>The current driver is the incorrect driver for the device</li>
         <li>The device is damaged and needs to be replaced or repaired (drivers cannot fix hardware issues)</li>
      </ul>
      <p>Installing the most current and accurate driver will typically fix most problems that are experienced while operating Windows hardware devices. The original driver for any given hardware device often has been updated many times by the manufacturer to fix bugs and improve efficiency. Many users experience problems with older Windows devices for this reason.</p>
      <p>There are many challenges when updating drivers. Finding the correct driver for all the devices in your Windows computer can be a hassle and installation can sometimes be tedious at best. You simply want your hardware to work and with the best performance!</p>
   </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
   function showDiv()
   {
    document.getElementById('show-box').style.display = "block";
    document.getElementById('hide-box').style.display = "none";
   }
	/* function force_download()
	{
		$.ajax({url: "<?php echo base_url()?>installation/force_download", 
                        success: function(result) {
                    $("#h11").html(result);
                }});
	} */
   function installation(){
	  
	window.location ='driver-install?download=True';
   }   
   
   function redirect(){
	  
	window.location ='driver-install';
   }
   
   function Onceclick(){
   setTimeout('installation()', 5000);
   setTimeout('redirect()', 6000);
   }
</script>