  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1> Questions & Answers </h1>
    </div>
    </div>
  </section>
  
  
  
  <section class="faqs_area">
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
        <!-- containt start-->
        <div class="row">
          <div class="col-sm-8 col-xs-12">
              <h3>We Are Usually Asked About</h3>
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      What is Lorem Ipsum?
                    </a>
                   </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                     <div class="panel-body">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                     </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                   <h4 class="panel-title">
                   <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                   Why do we use it?
                   </a>
                   </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making</p>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                   <h4 class="panel-title">
                   <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Where does it come from?
                   </a>
                   </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                   <div class="panel-body">
                      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
                   </div>
                  </div>
                </div>
              </div><!--./panel-group-->
          </div>
          <div class="col-sm-4 col-xs-12">
            <h3>Didn’t Find the Answer?</h3>
            <form method="post" class="faqs_form" action="<?php echo base_url();?>front/faqs/mail_question" >
              <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" class="form-control" required />
              </div>
              <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control" required/>
              </div>
              <div class="form-group">
                <textarea rows="4" name="message" placeholder="Questions" class="form-control" required="required"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="btn_send_question" >Send Question</button>
              </div>
            </form>
          </div>
      </div>
    </div>
  
  </section>



 <!-- banner end -->


<!-- section start -->

<!-- section end -->

