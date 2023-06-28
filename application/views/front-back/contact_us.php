  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1>  CONTACT US </h1>
    </div>
    </div>
  </section>
  
  
  
  <section class="body-contact">
    <div class="container">
         <!-- alert-->
        <div class="row">
            <?php $this->load->helper('form'); ?>
            
            <div class="col-md-12">
                
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
          
            <?php
            //$this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>                    
                </div>
            <?php }
            $success = $this->session->flashdata('success');
            if($success)
            {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $success; ?>                    
                </div>
            <?php } ?>
        </div>
        <!-- Form -->
        <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
          <div class="hedding-txt">
           <h2>We Are Open to Discuss</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br />
            Lorem Ipsum has been the industry's</p>
           </div>
 
            <div class="contact-dlts">

            <div class="col-lg-4 center">
              <div  class="main-icon">
              <i class="fa fa-map-marker"></i>
              </div >
              <div class="address">
                <h2>Our Address</h2>
                <p>
                Lorem Ipsum text<br />
                Sit a mit no. 999
                </p>
              </div>
            </div>

            <div class="col-lg-4 center">
              <div  class="main-icon">
              <i class="fa fa-envelope-o"></i>
              </div >
              <div class="address">
              <h2>Our E-Mail </h2>
          
              <a href="mailto:support@zenostrategics.com ">support@zenostrategics.com </a><br />
              <a href="mailto:info@zenostrategics.com">info@zenostrategics.com </a>
           

              </div>
            </div>

            <div class="col-lg-4 center">
                <div class="main-icon">
                <i class="fa fa-users"></i>
                </div>
                <div class="address">
                    <h2>Feel Free to Contact us
                    </h2>
                    <p>
                    (+321) 000 00 0000<br />
                    (+321) 000 000 0000
                    </p>
                </div>

            </div>
          </div>
  
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

        <div class="main-form">
        
                    <div class="from-area">
                    <h4>Get in touch with us
                    </h4>
                    </div>
                      <div class="from-box">
                          <!-- form start-->
                          <form id="contact-form" method="post" action="<?php echo base_url();?>front/contact/insertnow" role="form">
                              <div class="controls">
                                <!-- Require fields error con-->
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div id="alert_con" class="form-group text-white bg-alert p-1  hidden">
                                            alert
                                          </div>  
                                      </div>
                                   </div>

                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                           
                                              <input id="form_name" type="text" name="name" class="form-control form-control1" placeholder=" Your name *" required="required" data-error="Name is required.">
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                      
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                   
                                              <input id="form_email" type="text" name="email" class="form-control form-control1" placeholder="email *" required="required" data-error="email is required.">
                                            
                                          </div>
                                      </div>
                                      </div>
                                           <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                   
                                              <input id="form_phone" type="text" name="phone" class="form-control form-control1" placeholder="Phone *" required="required" data-error="phone is required.">
                                            
                                          </div>
                                      </div>
                                      </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <textarea id="form_message" name="message" class="form-control" placeholder="Message *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <input type="submit" class="btn btn-success btn-send" value="Send message">
                                      </div>
                                  </div>
                                  
                              </div>

                          </form>

                      </div>
        
        </div>

        </div>
      </div>
    </div>
  
  </section>



 <!-- banner end -->


<!-- section start -->

<!-- section end -->

<script>
$(document).ready(function(){
    $("#contact-form").submit(function(){
       
        var form_id = '#contact-form';
        var return_data = form_validation(form_id);
        if(return_data == 0)
        {
            return false;
        }
    });

     $("#form_phone").on("keypress", function(){
        var node = $(this);
        node.val(node.val().replace(/[a-zA-Z\-\(\)\s]+/g,'') );
        //var length = $(this).length();
     });

});

// Function Form Validation
function form_validation(form_id){
    var status = 1;
    $(form_id+" input").each(function(){
            var type = $(this).attr('type');
            var id = $(this).attr('id');
            var value = $(this).val();
            var required = $(this).attr("required");

            if(required == 'required')
            {
                if(type == 'text')
                {
                    if(value == '')
                    {
                        $(this).css('border','1px solid red');
                        status = 0;
                    }
                    else
                    {
                        $(this).css('border','1px solid');
                        $("#alert_con").addClass("hidden");
                    }
                }
                else if(type == 'email')
                {
                    
                    var atpos = value.indexOf("@");
                    var dotpos = value.lastIndexOf(".");
                    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=value.length) {
                        $(this).css('border','1px solid red');
                        status = 0;
                        $("#alert_con").removeClass("hidden").html("* Email Id Not Valide .");
                    }
                    else
                    {
                        $(this).css('border','1px solid');
                        $("#alert_con").addClass("hidden");
                        $.ajax(
                        {
                            type:"POST",
                            url:"<?php echo base_url();?>front/registration/check_email?email="+value,
                            data:'',
                            success:function(returnVal)
                            {
                               if(returnVal != 1)
                               {
                                 status = 0;
                                 $("#alert_con").removeClass("hidden").html("* Email Id Already Registered.");
                               }
                              
                            }
                        });

                       
                    }
                }
                
                // Phone

                if(id == 'form_phone')
                {
                    
                    var phone_length = $(this).val().length;
                    if (phone_length <= 10 && phone_length>=8 ) {
                        $(this).css('border','1px solid');
                        $("#alert_con").addClass("hidden");
                    }
                    else
                    {
                        $(this).css('border','1px solid red');
                        $("#alert_con").removeClass("hidden").html("* Phone number between 8 to 14 char .");
                        status = 0;
                    }
                }

              
            }    
        });

  return status;
}
</script>