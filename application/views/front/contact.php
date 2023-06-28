<!--===============================================================================================-->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/contact/css/main.css">
<!--===============================================================================================-->
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<section>
   <div class="container-fluid">
      <div class="row br-header">
         <img src="<?php echo base_url();?>assets/images/index/ftr.jpg" class="img-fluid">
         <div class="col-md-12">
            <div class="wrap-content-main text-center text-white">
               <h1><span style="font-weight:700;">Contact</span><span style="color:#18c3c2; font-weight:700;"> Us</span></h1>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container-fluid text-center">
      <div class="contact1">
         <div class="container-contact1">
            <div class="contact1-pic js-tilt" data-tilt>
               <img src="<?php echo base_url()?>assets/contact/images/contact.png" alt="IMG">
            </div>
            <form class="contact1-form validate-form">
               <span class="contact1-form-title">
               Get in touch
               </span>
               <div class="wrap-input1 validate-input" data-validate = "Name is required">
                  <input class="input1" type="text" name="name" placeholder="Name">
                  <span class="shadow-input1"></span>
               </div>
               <div class="wrap-input1 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                  <input class="input1" type="text" name="email" placeholder="Email">
                  <span class="shadow-input1"></span>
               </div>
               <div class="wrap-input1 validate-input" data-validate = "Subject is required">
                  <input class="input1" type="text" name="subject" placeholder="Subject">
                  <span class="shadow-input1"></span>
               </div>
               <div class="wrap-input1 validate-input" data-validate = "Message is required">
                  <textarea class="input1" name="message" placeholder="Message"></textarea>
                  <span class="shadow-input1"></span>
               </div>
               <div class="container-contact1-form-btn">
                  <button class="btn-grad">
                  <span>
                  Send Email
                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </span>
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>
<!--===============================================================================================-->
<script src="<?php echo base_url()?>assets/contact/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url()?>assets/contact/vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo base_url()?>assets/contact/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url()?>assets/contact/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url()?>assets/contact/vendor/tilt/tilt.jquery.min.js"></script>
<script >
   $('.js-tilt').tilt({
   	scale: 1.1
   })
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());
   
   gtag('config', 'UA-23581568-13');
</script>
<!--===============================================================================================-->
<script src="<?php echo base_url()?>assets/contact/js/main.js"></script>