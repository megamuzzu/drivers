  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1> Reset Password </h1>
    </div>
    </div>
  </section>
  
  
  
  <section class="body-contact">
    <div class="container">
        <div class="row">
            <!-- Registraion Page -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4" >

                  <div class="login-box">
                    <label class="login-box-msg text-default">Reset New Password</label>
                    <?php $this->load->helper('form'); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                    <?php
                    $this->load->helper('form');
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
                    
                    <form id="reset_pass_form" action="<?php echo base_url(); ?>front/login/resetpassword_save" method="post">
                      <div class="form-group has-feedback">
                        <div id="alert_con" class="form-group text-white bg-alert p-1  hidden">
                           Form Not Found
                        </div> 
                      </div>
                      <div class="form-group has-feedback">
                          <input id="email" type="email" class="form-control" placeholder="Enter Register Email Id" name="email" required="required" />
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                          <input id="form_password" type="password" class="form-control" placeholder="Create New Password" name="password" required="required" />
                          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                          <input id="form_re_password" type="password" class="form-control" placeholder="Re-Enter Password" name="re_password" required="required" />
                          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 mt-md">  
                          <input type="hidden" name="otp" value="<?php echo $otp; ?>" /> 
                          <input type="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />     
                        </div><!-- /.col -->
                      </div>
                    </form>

                    <!--<a href="<?php echo base_url() ?>forgotPassword">Forgot Password</a><br>-->
                    
                  </div><!-- /.login-box-body -->
                </div><!-- /.login-box -->      

            </div>   
        </div>
    </div>
  
  </section>



 <!-- banner end -->


<!-- section start -->

<!-- section end -->

<script>
$(document).ready(function(){
    $("#reset_pass_form").submit(function(){
       
        var form_id = '#reset_pass_form';
        var return_data = form_validation(form_id);
        if(return_data == 0)
        {
            return false;
        }
        
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
                               if(returnVal == 1)
                               {
                                 status = 0;
                                 $("#alert_con").removeClass("hidden").html("* Email Id Not Match.");
                               }
                              
                            }
                        });

                       
                    }
                }

              
                // Password Match
                if(id == 'form_password')
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