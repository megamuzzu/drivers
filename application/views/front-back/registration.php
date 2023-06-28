  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1>  REGISTRATION </h1>
    </div>
    </div>
  </section>
  
  <section class="body-contact">
    <div class="container">
        <div class="row">
        <!-- Registraion Page -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4" >

        <div class="main-form">
                    <div class="from-area">
                    <h4>Registration Form
                    </h4>
                    </div>
                      <div class="from-box">
                         <!-- Codigniter alert-->
                           <div class="row">
                                <div class="">
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
                           <!-- Form start-->
                          <form id="registration_form" method="post" action="<?php echo base_url();?>front/registration/insertnow" role="form" >
                              <div class="controls">
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
                                            <select class=" form-control" id="form_user_type" name="user_type" placeholder="Mr/Mrs/Miss" required="required">
                                                <option value=""> Mr/Mrs/Miss </option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>                                                
                                              </select>
                                          </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                            <input id="form_first_name" type="text" name="first_name" class="form-control form-control1" placeholder=" First name *" required="required" data-error="First Name is required.">
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                            <input id="form_last_name" type="text" name="last_name" class="form-control form-control1" placeholder=" Last name *" required="required" data-error="Last Name is required.">
                                              <div class="help-block with-errors"></div>
                                          </div>
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                   
                                              <input id="form_email" type="email" name="email" class="form-control form-control1" placeholder="email *" required="required" data-error="email is required.">
                                            
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
                                             
                                                 <select class=" form-control" id="form_country" name="country_id" placeholder="Select Country" required="required">
                                                <option value="" > -- Select Country-- </option>
                                                <?php foreach($country_list as $id=>$name){?>
                                                <option value="<?php echo $id;?>" ><?php echo $name;?></option>
                                                <?php } ?>
                                              </select>
                                          
                                                
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                              <input id="form_password" type="password" name="password" class="form-control form-control1" placeholder="Create Password *" required="required" data-error="Password is required.">
                                                
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                        
                                                  <input id="form_re_password" type="password" name="re_password" class="form-control form-control1" placeholder="Re-Enter Password *" required="required" data-error="Re Enter Password is required.">
                                                
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                <script src='https://www.google.com/recaptcha/api.js'></script>
                                                <div class="g-recaptcha" data-sitekey="6LfISlAUAAAAAFDu-79xzjhvFG4TTknW5liU0oRy"></div>
                                              </div>  
                                          </div>
                                      </div>        
                                      

                                  <div class="row">
                                      <div class="col-md-12">
                                          <input type="submit" name="submit" id="submit" class="btn btn-success btn-send" value="Submit">
                                          <a href="<?php echo base_url();?>front/login" class="text-white pull-right">Login Now</a>
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
    $("#registration_form").submit(function(){
       
        var form_id = '#registration_form';
        var return_data = form_validation(form_id);
        if(return_data == 0)
        {
            return false;
        }
        if (grecaptcha.getResponse() == ""){
              alert("Captcha Not Validate");
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
                else if(type == 'email' )
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
                // Select Box Testing 
                 $(form_id+" select").each(function(){
                  
                    var value = $(this).val();
                    var required = $(this).attr("required");
                    if(required == 'required')
                    {
                        if(value == '')
                        {
                            var placeholder = $(this).attr("placeholder");
                            $(this).css('border','1px solid red');
                            $("#alert_con").removeClass("hidden").html(placeholder);
                            status = 0;
                        }
                        else
                        {
                            $(this).css('border','1px solid');
                        }
                    }    
                    
                 }); 
                // Phone

                if(id == 'form_phone' && status == 1)
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

                // Password Match
                if(id == 'form_password' && status == 1)
                {
                    var password_lenght = $(this).val().length;
                    var password = $(this).val();
                    var re_password = $("#form_re_password").val();
                    
                    if (password_lenght >= 5 ) {
                        if(password == re_password)
                        {
                            $(this).css('border','1px solid');
                            $("#alert_con").addClass("hidden");
                        }
                        else
                        {
                            $(this).css('border','1px solid red');
                            $("#alert_con").removeClass("hidden").html("* Password Not Match.");
                            status = 0; 
                        }
                    }
                    else
                    {
                        $(this).css('border','1px solid red');
                        $("#alert_con").removeClass("hidden").html("* Password length Minimum 5 Char .");
                        status = 0;
                    }
                }

            }    
        });

  return status;
}
</script>