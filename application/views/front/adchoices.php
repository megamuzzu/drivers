<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<section>
 <div class="container-fluid">  
   <div class="row br-header">
     <img src="<?php echo base_url();?>assets/images/index/ad.jpg" class="img-fluid">

         <div class="col-md-12">
    <div class="wrap-content-main text-center text-white">
  <h1><span style="font-weight:700; color:#18c3c2">Adchoices</span> <span style="color:red; font-weight:700;"></span></h1>

  </div>
  </div>
   </div>

 </div>
</section>


<section class="bg-privacy">
<div class="container spacem wrapper-container">
 <div class="row pb-4">
 <div class="col-md-12">
     <div id="scroll-1">
      <div class="rt-bg  scroll-2">
   <h5><strong>Adchoices</strong></h5>

   </div>
    <div class="policy-content pt-5">
   <p>Some of the ads you receive on Web pages are customized based on predictions about your interests generated from your visits to different Websites in your browser and on other devices you may use. This type of ad customization is sometimes called “online behavioral” or “interest-based” advertising. Such online advertising helps support the free content, products and services you get online. The DAA Principles apply to interest-based advertising and other applicable uses of Web viewing data collected over time and across nonaffiliated Web sites and on other devices.</p>
<p>Using this browser tool, you can control the collection and use of Web viewing data for interest-based advertising and other applicable uses on this browser, by some or all of the participating companies.</p>
<p>See all the participating companies in this WebChoices (check) tool and learn more about their practices.</p>
<p>Also find out which participating companies have currently enabled customized ads for your browser.</p>
<p>Check whether you&rsquo;ve already set controls previously from participating companies.</p>
<p>Exercise choice with some or all participating companies to store your preferences for your browser, using opt-out cookies or other technologies.</p>
<p>Deleting browser cookies may remove your opt-out preferences, so you should visit this page periodically to review your opt-out preferences, or update your choices to include new participating companies.</p>
<p>Use the &ldquo;OPT OUT OF ALL&rdquo; feature to control data collection and use covered by the DAA from all currently participating companies in one step.</p>
<p>You may still receive other types of online advertising from participating companies, and these companies may still collect information for other purposes consistent with the DAA Principles.</p>
    
     </div>

     
   </div>
  </div>

</section>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>


<script>
$(".scrollBtn").click(function(){

    var link = $(this).attr('data-href');
    
    $('html, body').animate({
      scrollTop: $(link).offset().top-100}, 200);
    return false;
    

});


// Sticky right
  // sticky header 
  $(window).scroll(function(){
  var sticky2 = $('.sticky2'),
      scroll2 = $(window).scrollTop();
      var height = $("body").height(); 
     // alert(scroll2 +"<>"+(height-700))
    if (scroll2 >= 300) sticky2.addClass('fixedLeftCol');
    else sticky2.removeClass('fixedLeftCol');

    if ((height-1000) < scroll2 ) sticky2.removeClass('fixedLeftCol');
    

  });
</script>


