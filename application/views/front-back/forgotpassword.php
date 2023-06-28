  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1> Forgot Password </h1>
    </div>
    </div>
  </section>
  
  
  
  <section class="body-contact">
    <div class="container">
        <div class="row">
            <!-- Registraion Page -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4" >

                  <div class="login-box">
                    <label class="login-box-msg text-default">Enter Register Email Id</label>
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
                    
                    <form action="<?php echo base_url(); ?>front/login/resetPasswordUser" method="post">
                      <div class="form-group has-feedback">
                          <input type="email" class="form-control" placeholder="Email" name="login_email" required />
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 mt-md">    
                          <input type="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />     
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