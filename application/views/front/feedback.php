<!-- feedback page strt here -->

<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<section>
 <div class="container-fluid">  
   <div class="row br-header">
     <img src="<?php echo base_url();?>assets/images/index/cookies-policy.jpg" class="img-fluid">

    <div class="col-md-12">
    <div class="wrap-content-main text-center text-white">
  <h1><span style="font-weight:700;"></span><span style="color:#ffffff; font-weight:700;">Feedback</span></h1>

  </div>
  </div>
   </div>

 </div>
</section>




<section>


<div class="container wrap-container">
 <div class="row">


   <div class="col-md-6 pt-5 pb-5 mar-al">

      <!-- flash alert messages-->
      
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
            
      <!--// flash alert messages-->



      <p class="text-center">We are sorry to see you go. Before you go, please share your feedback</p>
<div class="modal-content">

      <div class="modal-body">
        <form id="form2" name="form2" method="post" action="<?php echo base_url('feedback/sendfeedback');?>">
               <div id="error1"></div>
          <div class="form-group">
                <label class="" for="name">Name.</label>
              <div class="input-group">
            <!--     <div class="input-group-addon addon-bg"><spna><i class="icon-fr  fa fa-pencil"></i></spna></div> -->
                <input type="text" placeholder="" id="name" name="name" class="form-control input" autocomplete="off" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="" for="email">Email.</label>
                <div class="input-group">
                 <!--  <div class="input-group-addon addon-bg"><span><i class=" icon-fr  fa fa-envelope "></i></span></div> -->
                  <input id="email" name="email" placeholder="" class="form-control input" autocomplete="off" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="" for="number">Contact Number.</label>
                <div class="input-group">
                  <!-- <div class="input-group-addon addon-bg"><span><i class=" icon-fr-2 fa fa-mobile mb-form" style="font-size: 20px;"></i></span></div> -->


                  <input type="text" placeholder="" id="phone" name="phone" class="form-control input"  minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" required="required">
                </div>
              </div>
              <div class="form-group">
                <label class="" for="meassge">Message.</label>
                <div class="input-group">
                 <!--  <div class="input-group-addon addon-bg"><span><i class="icon-fr fa fa-comment"></i></span></div> -->
                  <textarea placeholder="" id="message" name="message" class="form-control message-fm" autocomplete="off" required="required"></textarea>
                </div>
              </div>
              <input type="hidden" name="token" id="token" value="#">
              
              <!--<div class="form-group g-recaptcha" data-sitekey="6LdI_50UAAAAAK2tc-76S1I2eLUI1M0qCwQ3RjBh"></div>-->
              <button type="submit" id="contct_submit1" class="btn fr-btn-submit btn-block btn-lg al-btn submit-driver-installation"><strong>SUBMIT</strong></button>
              
        </form>
      </div>
    </div>

   </div>


 </div>
</div>



</section>




<!-- end -->



