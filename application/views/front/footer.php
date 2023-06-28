<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<?php
                  $logos = "logo-footer.png";

                    if(isset($page) && $page =='driver_scanner')
                  {
                    $logos = "logo-footer.png";
                  }else if(isset($page) && $page =='driver_fixer')
                  {
                    $logos = "logo-footer.png";
                  }else
                  {
                    $logos = "logo-footer.png";
                  }
              ?>
              
<footer class="bg-section-3<?php echo isset($printPage)?'hidden':''; ?> siteFooter">
  <div class="container footer-padding">
    <div class="row" style="width: 100%;padding: 0 15px;">
      <div class="col-md-4 footer-heading">
        <ul class="bull-block ftr-list">
          <li class="ftr-hrading">
            <a class="navbar-brand" href="<?php echo base_url();?>">
              <img src="<?php echo base_url();?>assets/images/<?php echo $logos;?>" class="img-fluid footer-logo">
            </a>
          </li>
          <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;3180 Scotch Creek Rd unit 106 Coppell TX - 75019 USA</li>
          <li><a href="mailto:support@driverrepair24x7.com"><i class="fa fa-envelope"></i>&nbsp;&nbsp;support@driverrepair24x7.com</a></li>
          
          <li><a href="tel:+19452177400"><i class="fa fa-phone"></i>&nbsp;&nbsp;(+1) 945-217-7400</a></li>
          
        <li><small>Driver Repair 24x7 is a brand owned by</small></li>
        
         <li style=" margin-top: 10px;"><img src="<?php echo base_url();?>assets/images/micro-huv.png" class="img-fluid" style="width: 75%;"></li>
        
        
        </ul>
      </div>
      <div class="col-md-2 footer-heading">
        <h2 class="text-center"></h2>
          <ul class="bull-block ftr-list">
            <li class="ftr-hrading">Products</li>
            <li><a href="<?php echo base_url('download');?>">Try Now</a></li>
            <li><a href="<?php echo base_url('cart');?>">Buy Now</a></li>
            <li><a href="<?php echo base_url();?>support">Support</a></li>
          </ul>
      </div>
      <div class="col-md-3 footer-heading">
        <h2 class="text-center"></h2>
          <ul class="bull-block ftr-list driverfixer_up">
            <li class="ftr-hrading">About Us</li>
            <li><a href="<?php echo base_url();?>about">About Us</a></li>
            <li><a href="<?php echo base_url();?>uninstall-instructions">Uninstall Instructions</a></li>
            <li><a href="<?php echo base_url();?>eula">EULA</a></li>
            <li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
          </ul>
      </div>
      <div class="col-md-3 footer-heading">
        <h2 class="text-center"></h2>
          <ul class="bull-block ftr-list">
            <li class="ftr-hrading">Policies</li>
            <li><a href="<?php echo base_url();?>software-principles">Software Principles</a></li>
            <li><a href="<?php echo base_url();?>privacy-policy">Privacy Policy</a></li>
            <li><a href="<?php echo base_url();?>refund-policy">Refund Policy</a></li>
            <li><a href="<?php echo base_url();?>terms-of-use">Terms of Use</a></li>
            <li><a href="<?php echo base_url();?>cookies-policy">Cookies Policy</a></li>
            <li><a href="<?php echo base_url();?>dmca">DMCA</a></li>
            <li><a href="<?php echo base_url();?>adchoices "> Adchoices</a></li>
            
              
          <li><img src="<?php echo base_url();?>assets/images/payment-2.webp" class="img-fluid"></li>
            
          </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid ">
    <div class="row copy-bg">
      <div class="col-12 text-center ">
        <p class="copyright">Copyright © Driver Repair 24x7 2021 All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>



<script type="text/javascript">
    // sticky header 
    $(window).scroll(function() {
        var sticky = $('.sticky'),
            scroll = $(window).scrollTop();

        if (scroll >= 300) sticky.addClass('fixed2ndMenu').removeClass("hidden");
        else sticky.removeClass('fixed2ndMenu').addClass("hidden");
    });
</script>



<?php if(isset($chatStatus) && $chatStatus == "on" ){ ?>
<!-- Start of Zendesk Chat Script -->
<!-- <script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?58wwYZnZ5qu38SFYw1Wc90elVHujtDyd";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script> -->
<!-- End of Zendesk Chat Script-->
<?php } ?>

</body>

</html>