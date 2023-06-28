<a href="#" id="scroll" style="display: none;"><span></span></a>
<footer> 

<div class="footer-top">
  <div class="container">
<div class="row">
<div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
  <div class="footer-box">
    <img src="<?php echo base_url();?>assets/front/images/footer-logo.png" class="img-responsive" alt=""  />
    <p>Let's start by saying there isn't another company that can get anywhere near us on this item. Let's start by saying there isn't another company that can </p>
    <ul class="list-inline social">
      <li><a href="#"><i class="fa fa-youtube"></i></a></li>    
      <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
    </ul>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
  <div class="footer-box">
    <h2>USEFULL LINKS</h2>
    <div class="footer-bdr"></div>
    <ul>
      <li><a class="link-1" href="<?php echo base_url('front/index_page');?>"><i class="fa fa-angle-double-right"></i>Home</a></li>
      <li><a class="link-1" href="<?php echo base_url('front/about');?>"><i class="fa fa-angle-double-right"></i>About Us</a></li>
      <li><a class="link-1" href="#"><i class="fa fa-angle-double-right"></i>Services</a></li>
      <li><a class="link-1" href="<?php echo base_url('front/contact');?>"><i class="fa fa-angle-double-right"></i>Contact Us</a></li>
    </ul>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
  <div class="footer-box">
    <h2> SERVICES</h2>
    <div class="footer-bdr"></div>
    <ul>
      <li><a class="link-1" href="<?php echo base_url('front/services/service_manual_trading');?>"><i class="fa fa-angle-double-right"></i>Manual Trading</a></li>
      <li><a class="link-1" href="<?php echo base_url('front/services/zeno_trading_stragegy');?>"><i class="fa fa-angle-double-right"></i>Zeno Trading Strategy</a></li>
    </ul>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-md-3 col-xs-12">
  <div class="footer-box">
    <h2> GET IN TOUCH</h2>
    <div class="footer-bdr"></div>
    <form id="footer_form" method="post" action="<?php echo base_url();?>front/index_page/footer_get_tuch">
      <div class="form-group">
        <input type="name" placeholder="Name" class="form-control" id="footer_name" name="get_tuch_user" >
      </div>
       <div class="form-group">
        <input type="text" placeholder="Number" class="form-control" id="footer_phone_number" name="get_tuch_number" maxlength="13" />
      </div>
      <div class="form-group">
        <input type="email" placeholder="Email" class="form-control" id="footer_email" name="get_tuch_email">
      </div>

      <button type="submit" id="btn_get_tuch" class="btn2 btn2-default">Get In Touch</button>
    </form>
  </div>
</div>
</div>
</div>
</div>


<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <p>Design by <a href="#">Delimp.com</a></p>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="copyright-para">
          <p>Copyright @ 2010 to 2018 Zeno strategics Ltd </p>
        </div>
      </div>
    </div>
  </div>
</div>
</footer>





<script src="<?php echo base_url();?>assets/front/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/front/js/jquery.min.js"></script>

<script type="text/javascript">
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 16) {
        $(".clearHeader").addClass("darkHeader");
    } else {
        $(".clearHeader").removeClass("darkHeader");
    }
});

</script>
<script type="text/javascript">

$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 1700); 
        return false; 
    }); 
});
</script>

<!-- for menu active class-->
<script type="text/javascript">
   var windowURL = window.location.href;
    pageURL = windowURL;//.substring(0, windowURL.lastIndexOf('/'));
    
    var x= $('a[href="'+pageURL+'"]');
        x.addClass('active');
        //x.parent().addClass('active');
        //alert(JSON.stringify(x));
    var y= $('a[href="'+windowURL+'"]');
        y.addClass('active');
        y.parent().addClass('active');
</script>
<script>
  $(document).ready(function(){

      $("#footer_phone_number").on("keypress", function(){
          var node = $(this);
          node.val(node.val().replace(/[a-zA-Z\-\(\)\s]+/g,'') );
       });

  });
</script>









<!-- ================
 Home Page Banner Slider Js
================== -->

<script src='<?php echo base_url();?>assets/front/js/slick.min.js'></script>
<script type="text/javascript">
  if ( $('.product__slider-main').length ) {
        var $slider = $('.product__slider-main')
            .on('init', function(slick) {
                $('.product__slider-main').fadeIn(1000);
            })
            .slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
                lazyLoad: 'ondemand',
                autoplaySpeed: 3000,
                asNavFor: '.product__slider-thmb'
            });

    var $slider2 = $('.product__slider-thmb')
            .on('init', function(slick) {
                $('.product__slider-thmb').fadeIn(1000);
            })
            .slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                lazyLoad: 'ondemand',
                asNavFor: '.product__slider-main',
                dots: false,
                centerMode: false,
                focusOnSelect: true
            });

 //remove active class from all thumbnail slides
 $('.product__slider-thmb .slick-slide').removeClass('slick-active');

 //set active class to first thumbnail slides
 $('.product__slider-thmb .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 $('.product__slider-main').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
  var mySlideNumber = nextSlide;
  $('.product__slider-thmb .slick-slide').removeClass('slick-active');
  $('.product__slider-thmb .slick-slide').eq(mySlideNumber).addClass('slick-active');
});
  
  
  // init slider
require(['js-sliderWithProgressbar'], function(slider) {

    $('.product__slider-main').each(function() {

        me.slider = new slider($(this), options, sliderOptions, previewSliderOptions);

        // stop slider
        //me.slider.stop();

        // start slider
        //me.slider.start(index);

        // get reference to slick slider
        //me.slider.getSlick();

    });
});
  var options = {
    progressbarSelector    : '.bJS_progressbar'
    , slideSelector        : '.bJS_slider'
    , previewSlideSelector : '.bJS_previewSlider'
    , progressInterval     : ''
        // add your own progressbar animation function to sync it i.e. with a video
        // function will be called if the current preview slider item (".b_previewItem") has the data-customprogressbar="true" property set
    , onCustomProgressbar : function($slide, $progressbar) {}
}

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
var sliderOptions = {
    slidesToShow   : 1,
    slidesToScroll : 1,
    arrows         : false,
    fade           : true,
    autoplay       : true
}

    // slick slider options
    // see: https://kenwheeler.github.io/slick/
var previewSliderOptions = {
    slidesToShow   : 3,
    slidesToScroll : 1,
    dots           : false,
    focusOnSelect  : true,
    centerMode     : true
}
}
</script>

</body>
</html>
